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

    public function login()
    {
        $user_code = $this->input->post('user_code');
        $password = $this->input->post('password');

        if ($this->user_m->check_if_exist($user_code)) {
            if ($this->user_m->check_if_deleted($user_code)) {
                if ($this->user_m->check_if_on($user_code)) {
                    if ($this->user_m->check_password($user_code, $password)) {
                        if ($this->user_m->check_if_exp_password($user_code)) {
                            $this->user_m->set_session($user_code);
                            redirect('dashboard_c');
                        } else {
                            $this->index('5');
                        }
                    } else {
                        $this->index('4');
                    }
                } else {
                    $this->index('3');
                }
            } else {
                $this->index('2');
            }
        } else {
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
        $this->session->unset_userdata('ROLE');

        // unset all user data
        $this->session->sess_destroy();
        redirect('login_c');
    }
}
