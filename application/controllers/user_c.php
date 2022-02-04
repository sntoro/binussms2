<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user_c extends CI_Controller {

	public $layout = '/template/contains';

	public function __construct() {
        parent::__construct();
		$this->load->model('user_m');
		$this->load->model('role_module_m');
		$this->load->model('log_m');
		
	}
	
	public function index($msg = NULL){

		$user_session = $this->session->all_userdata();
		if (!$user_session['USER_CODE']) {
            redirect(base_url('index.php/login_c'));
		}

		if ($msg == 1) {
            $msg = "<div class = 'alert alert-success'><button type = 'button' class = 'close' data-dismiss = 'alert'>×</button><strong>Creating success </strong> The data is successfully created </div >";
        } elseif ($msg == 2) {
            $msg = "<div class = 'alert alert-success'><button type = 'button' class = 'close' data-dismiss = 'alert'>×</button><strong>Updating success </strong> The data is successfully updated </div >";
        } elseif ($msg == 3) {
            $msg = "<div class = 'alert alert-success'><button type = 'button' class = 'close' data-dismiss = 'alert'>×</button><strong>Deleted success </strong> The data is successfully deleted </div >";
        } 

		$data['data'] = $this->user_m->get_data();
		$data['msg'] = $msg;

		$session = $this->session->all_userdata();
		$role = $session['ID_ROLE'];
		
		$data['menu_dashboard'] = $this->role_module_m->get_dashboard_module_by_role($role);
        $data['menu_master'] = $this->role_module_m->get_master_module_by_role($role);
		$data['menu_report'] = $this->role_module_m->get_report_module_by_role($role);

        $data['content'] = 'user/master_user';
		$data['title'] = 'Master users';

		$this->load->view($this->layout, $data);
		
	}

	public function save_user(){

		$user_code = $this->input->post('user_code');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$role = $this->input->post('role');

		$this->form_validation->set_rules('user_code', 'NPK', 'required|min_length[4]|max_length[6]|trim|callback_user_code_check');
		$this->form_validation->set_rules('username', 'User name', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[10]|trim');
		$this->form_validation->set_rules('repeat_password', 'Password Confirmation', 'required|matches[password]|callback_password_check');
		$this->form_validation->set_rules('role', 'Role', 'required');
		
		$session = $this->session->all_userdata();
		$user = $session['USERNAME'];
		$datenow = date('Ymd');
		$timenow = date('His');
		$expdate = date('Ymd', strtotime("+90 day"));

		if ($this->form_validation->run() == FALSE){

			$session = $this->session->all_userdata();
			$role = $session['ID_ROLE'];

			$data['menu_dashboard'] = $this->role_module_m->get_dashboard_module_by_role($role);
			$data['menu_master'] = $this->role_module_m->get_master_module_by_role($role);
			$data['menu_report'] = $this->role_module_m->get_report_module_by_role($role);
			
			$data['data'] = $this->user_m->get_data();
			$data['msg'] = NULL;
			$data['content'] = 'user/master_user';
			$data['title'] = 'Master users';
			$this->load->view($this->layout, $data);
		}else{
			$data_insert = array(
				'USER_CODE' => $user_code,
				'USERNAME' => $username,
				'PASSWORD' => $password,
				'ID_ROLE' => $role,
				'REGIS_DATE' => $datenow,
				'EXP_DATE' => $expdate,
				'CREATED_BY' => $user,
				'CREATED_DATE' => $datenow,
				'CREATED_TIME' => $timenow
			);
			$this->user_m->save($data_insert);

			$data_log = array(
				'ACTIVITY' => 'save_user',
				'CPU' => gethostbyaddr($_SERVER['REMOTE_ADDR']),
				'OBJECT' => implode("|",$data_insert),
				'CREATED_BY' => $user,
				'CREATED_DATE' => $datenow,
				'CREATED_TIME' => $timenow
			);
			$this->log_m->save($data_log);

			redirect('user_c/index/1');
		}
		
	}

	public function password_check($str) {
        if (!preg_match('/[A-Z]/', $str)) {
            $this->form_validation->set_message('password_check', 'Sorry, This Password must be contain at least one uppercase character');
            return false;
        } if (!preg_match('/[a-z]/', $str)) {
            $this->form_validation->set_message('password_check', 'Sorry, This Password must be contain at least one lowercase character');
            return false;
        } if (!preg_match('/[0-9]/', $str)) {
            $this->form_validation->set_message('password_check', 'Sorry, This Password must be contain at least one number');
            return false;
//        } if (!preg_match('/[!._@#$%`~*&^%$(){}?]/', $str)) {
//            $this->form_validation->set_message('password_check', 'Sorry, This Password must be contain at least one special character');
//            return false;
        } else {
            return true;
        }
    }

	public function user_code_check($user_code){
		$status_redudance = $this->user_m->check_redudance($user_code);

        if ($status_redudance) {
            $this->form_validation->set_message('user_code_check', 'NPK already input');
            return FALSE;
        }else{
            return TRUE;
        }
    }

	public function prepare_change_profile($msg = null){
		$user_session = $this->session->all_userdata();
		if (!$user_session['USER_CODE']) {
            redirect(base_url('index.php/login_c'));
		}

		if ($msg == 1) {
            $msg = "<div class = 'alert alert-success'><button type = 'button' class = 'close' data-dismiss = 'alert'>×</button><strong>Creating success </strong> The data is successfully created </div >";
        } elseif ($msg == 2) {
            $msg = "<div class = 'alert alert-success'><button type = 'button' class = 'close' data-dismiss = 'alert'>×</button><strong>Updating success </strong> The data is successfully updated </div >";
        } elseif ($msg == 3) {
            $msg = "<div class = 'alert alert-success'><button type = 'button' class = 'close' data-dismiss = 'alert'>×</button><strong>Deleted success </strong> The data is successfully deleted </div >";
        } 

		$data['data_user'] = $this->user_m->get_data_user_by_id($user_session['USER_CODE']);
		$data['msg'] = $msg;

		$role = $user_session['ID_ROLE'];
		
		$data['menu_dashboard'] = $this->role_module_m->get_dashboard_module_by_role($role);
        $data['menu_master'] = $this->role_module_m->get_master_module_by_role($role);
		$data['menu_report'] = $this->role_module_m->get_report_module_by_role($role);

        $data['content'] = 'user/profile_user';
		$data['title'] = 'Master users';

		$this->load->view($this->layout, $data);
		
	}

	public function update_user(){

		$id = $this->input->post('id');
		$user_code = $this->input->post('user_code');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$role = $this->input->post('role');
		
		$session = $this->session->all_userdata();
		$user = $session['USERNAME'];
		$datenow = date('Ymd');
		$timenow = date('His');
		
		$data_insert = array(
			'USER_CODE' => $user_code,
			'USERNAME' => $username,
			'PASSWORD' => $password,
			'ID_ROLE' => $role
		);
		$this->user_m->update($data_insert, $id);

		$data_log = array(
			'ACTIVITY' => 'update_user',
			'CPU' => gethostbyaddr($_SERVER['REMOTE_ADDR']),
			'OBJECT' => implode("|",$data_insert),
			'CREATED_BY' => $user,
			'CREATED_DATE' => $datenow,
			'CREATED_TIME' => $timenow
		);
		$this->log_m->save($data_log);

		redirect('user_c');
	}

	public function delete_user($id){
		$this->user_m->delete($id);
		
		$session = $this->session->all_userdata();
		$user = $session['USERNAME'];
		$datenow = date('Ymd');
		$timenow = date('His');

		$data_log = array(
			'ACTIVITY' => 'delete_user',
			'CPU' => gethostbyaddr($_SERVER['REMOTE_ADDR']),
			'OBJECT' => $id,
			'CREATED_BY' => $user,
			'CREATED_DATE' => $datenow,
			'CREATED_TIME' => $timenow
		);
		$this->log_m->save($data_log);

		redirect('user_c');
	}

}
