<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class machine_c extends CI_Controller {

	public $layout = '/template/contains';

	public function __construct() {
        parent::__construct();
		$this->load->model('machine_m');
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

		$data['data'] = $this->machine_m->get_data();
		$data['msg'] = $msg;

		$session = $this->session->all_userdata();
		$role = $session['ROLE'];

		$data['menu_dashboard'] = $this->role_module_m->get_dashboard_module_by_role($role);
        $data['menu_master'] = $this->role_module_m->get_master_module_by_role($role);
		$data['menu_report'] = $this->role_module_m->get_report_module_by_role($role);

        $data['content'] = 'machine/master_machine';
		$data['title'] = 'Master machines';

		$this->load->view($this->layout, $data);
		
	}

	public function save_machine(){

		$machine_code = $this->input->post('machine_code');
		$machine_name = $this->input->post('machine_name');
		$location = $this->input->post('location');
		$password = $this->input->post('password');

		$session = $this->session->all_userdata();
		$user = $session['USERNAME'];
		$role = $session['ROLE'];
		$datenow = date('Ymd');
		$timenow = date('His');

		$this->form_validation->set_rules('machine_code', 'Machine Code', 'callback_machine_code_check');
		$this->form_validation->set_rules('machine_name', 'Machine Name', 'required');
		$this->form_validation->set_rules('location', 'Location', 'required');
		$this->form_validation->set_rules('password', 'Pin Reset Counter', 'required|min_length[4]|max_length[4]|numeric');

		if ($this->form_validation->run() == FALSE){

			$data['menu_dashboard'] = $this->role_module_m->get_dashboard_module_by_role($role);
			$data['menu_master'] = $this->role_module_m->get_master_module_by_role($role);
			$data['menu_report'] = $this->role_module_m->get_report_module_by_role($role);
			
			$data['data'] = $this->machine_m->get_data();
			$data['msg'] = NULL;
			$data['content'] = 'machine/master_machine';
			$data['title'] = 'Master machines';
			$this->load->view($this->layout, $data);
		}else{
			$data_insert = array(
				'MACHINE_CODE' => $machine_code,
				'MACHINE_NAME' => $machine_name,
				'PASSWORD' => $password,
				'LOCATION' => $location,
				'CREATED_BY' => $user,
				'CREATED_DATE' => $datenow,
				'CREATED_TIME' => $timenow
			);
			$id = $this->machine_m->save($data_insert);

			$data_log = array(
				'ACTIVITY' => 'save_machine',
				'CPU' => gethostbyaddr($_SERVER['REMOTE_ADDR']),
				'OBJECT' => implode("|",$data_insert),
				'CREATED_BY' => $user,
				'CREATED_DATE' => $datenow,
				'CREATED_TIME' => $timenow
			);
			$this->log_m->save($data_log);

			redirect('machine_c/index/'.$id.'/1');
		}
		
	}

	public function machine_code_check($machine_code){
		$status_redudance = $this->machine_m->check_redudance($machine_code);

        if ($status_redudance) {
            $this->form_validation->set_message('machine_code_check', 'Machine Code already input');
            return FALSE;
        }else{
            return TRUE;
        }
    }

	public function update_machine(){

		$id = $this->input->post('id');
		$machine_code = $this->input->post('machine_code');
		$machine_name = $this->input->post('machine_name');
		$location = $this->input->post('location');
		$password = $this->input->post('password');

		$session = $this->session->all_userdata();
		$user = $session['USERNAME'];
		$role = $session['ROLE'];
		$datenow = date('Ymd');
		$timenow = date('His');

		$this->form_validation->set_rules('machine_name', 'Machine Name', 'required');
		$this->form_validation->set_rules('location', 'Location', 'required');
		$this->form_validation->set_rules('password', 'Pin Reset Counter', 'required|min_length[4]|max_length[4]|numeric');

		if ($this->form_validation->run() == FALSE){
			$data['menu_dashboard'] = $this->role_module_m->get_dashboard_module_by_role($role);
			$data['menu_master'] = $this->role_module_m->get_master_module_by_role($role);
			$data['menu_report'] = $this->role_module_m->get_report_module_by_role($role);
			
			$data['data'] = $this->machine_m->get_data();
			$data['msg'] = NULL;
			$data['content'] = 'machine/master_machine';
			$data['title'] = 'Master machines';
			$this->load->view($this->layout, $data);
		}else{
			$data_insert = array(
				'MACHINE_CODE' => $machine_code,
				'MACHINE_NAME' => $machine_name,
				'PASSWORD' => $password,
				'LOCATION' => $location
			);
			$this->machine_m->update($data_insert, $id);
	
			$data_log = array(
				'ACTIVITY' => 'update_machine',
				'CPU' => gethostbyaddr($_SERVER['REMOTE_ADDR']),
				'OBJECT' => implode("|",$data_insert),
				'CREATED_BY' => $user,
				'CREATED_DATE' => $datenow,
				'CREATED_TIME' => $timenow
			);
			$this->log_m->save($data_log);
	
			redirect('machine_c/index/2');
		}
	}

	public function delete_machine($id){
		$this->machine_m->delete($id);
		
		$session = $this->session->all_userdata();
		$user = $session['USERNAME'];
		$role = $session['ROLE'];
		$datenow = date('Ymd');
		$timenow = date('His');

		$data_log = array(
			'ACTIVITY' => 'delete_machine',
			'CPU' => gethostbyaddr($_SERVER['REMOTE_ADDR']),
			'OBJECT' => $id,
			'CREATED_BY' => $user,
			'CREATED_DATE' => $datenow,
			'CREATED_TIME' => $timenow
		);
		$this->log_m->save($data_log);

		redirect('machine_c/index/3');
	}

}
