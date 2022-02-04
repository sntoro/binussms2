<?php
defined('BASEPATH') or exit('No direct script access allowed');

class login_c extends CI_Controller
{

    public $layout = '/template/contains';
    public $layout_login = '/template/login';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_m');
        // $this->load->model('role_m');
    }

    public function index($msg = null)
    {
        $data['content'] = 'login';
        $data['title'] = 'Welcome';

        switch ($msg) {

            case '1':
                $data['msg'] = '<p>
                <div class="alert alert-danger text-center">
                <strong>Sign in failed!</strong> Your account doesn\'t exist.
                </div>';
                break;
            case '2':
                $data['msg'] = '<p>
                <div class="alert alert-info text-center">
                <strong>Too bad!</strong> Your account was deleted.
                </div>';
                break;
            case '3':
                $data['msg'] = '<p>
                <div class="alert alert-warning text-center">
                You have abnormally logged off. 
                Try sign in on your last computer.
                </div>';
                break;
            case '4':
                $data['msg'] = '<p>
                <div class="alert alert-warning text-center">
                <strong>Sign in failed!</strong> Your password appear to be invalid. Please try again.
                </div>';
                break;
            case '5':
                $data['msg'] = '<p>
                <div class="alert alert-danger text-center">
                Your password has expired and must be changed.
                </div>';
                break;
            default:
                $data['msg'] = NULL;
                break;
        }

        $this->load->view($this->layout_login, $data);
    }

    //function untuk Login
    public function login()
    {
        //inputan dari user (dari view)
        $user_code = $this->input->post('user_code');
        $password = $this->input->post('password');

        //check existing data user
        if ($this->user_m->check_if_exist($user_code)) {
            //check deleted data user
            if ($this->user_m->check_if_deleted($user_code)) {
                //check user is login in other machine or not
                if ($this->user_m->check_if_on($user_code)) {
                    //check password true or not
                    if ($this->user_m->check_password($user_code, $password)) {
                        //check expire password 
                        if ($this->user_m->check_if_exp_password($user_code)) {
                            //create session for user login
                            $this->user_m->set_session($user_code);
                            //login success - show dashboard for spesific user role
                            redirect('dashboard_c');
                        } else {
                            //show error message - user password was expired
                            $this->index('5');
                        }
                    } else {
                        //show error message - password not same/valid
                        $this->index('4');
                    }
                } else {
                    //show error message - user login in other machine
                    $this->index('3');
                }
            } else {
                //show error message - user has been deleted
                $this->index('2');
            }
        } else {
            //show error message - data user not exist
            $this->index('1');
        }
    }

    public function logoff()
    {
        $user_session = $this->session->all_userdata();

        if (!$user_session['USER_CODE']) {
            redirect(base_url('index.php/login_c'));
        }

        $data = array(
            'FLG_LOG' => 0
        );

        $this->user_m->update_user_login($user_session['USER_CODE'], $data);

        $this->session->unset_userdata('USER_CODE');
        $this->session->unset_userdata('USERNAME');
        $this->session->unset_userdata('IP');
        $this->session->unset_userdata('REGIS_DATE');
        $this->session->unset_userdata('EXP_DATE');
        $this->session->unset_userdata('ID_ROLE');

        // unset all user data
        $this->session->sess_destroy();
        redirect('login_c');
    }
}
