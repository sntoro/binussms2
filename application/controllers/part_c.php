<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class part_c extends CI_Controller {

	public $layout = '/template/contains';

	public function __construct() {
        parent::__construct();
		$this->load->model('part_m');
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

		$data['data'] = $this->part_m->get_data();
		$data['msg'] = $msg;

		$session = $this->session->all_userdata();
		$role = $session['ROLE'];

        $data['menu_dashboard'] = $this->role_module_m->get_dashboard_module_by_role($role);
        $data['menu_master'] = $this->role_module_m->get_master_module_by_role($role);
		$data['menu_report'] = $this->role_module_m->get_report_module_by_role($role);
		
        $data['content'] = 'part/master_part';
		$data['title'] = 'Master Parts';

		$this->load->view($this->layout, $data);
		
	}

	public function save_part(){
		$session = $this->session->all_userdata();
		$role = $session['ROLE'];
		$user = $session['USERNAME'];
		$datenow = date('Ymd');
		$timenow = date('His');

		$part_no = $this->input->post('part_no');
		$part_name = $this->input->post('part_name');

		$this->form_validation->set_rules('part_no', 'Part No', 'callback_partno_check');
		$this->form_validation->set_rules('part_name', 'Part name', 'required');

		if ($this->form_validation->run() == FALSE){

			$data['menu_dashboard'] = $this->role_module_m->get_dashboard_module_by_role($role);
			$data['menu_master'] = $this->role_module_m->get_master_module_by_role($role);
			$data['menu_report'] = $this->role_module_m->get_report_module_by_role($role);
			
			$data['data'] = $this->part_m->get_data();
			$data['msg'] = NULL;
			$data['content'] = 'part/master_part';
			$data['title'] = 'Master Parts';
			$this->load->view($this->layout, $data);
		}else{
			$data_insert = array(
				'PART_NO' => $part_no,
				'PART_NAME' => $part_name,
				'CREATED_BY' => $user,
				'CREATED_DATE' => $datenow,
				'CREATED_TIME' => $timenow
			);
			$this->part_m->save($data_insert);

			$data_log = array(
				'ACTIVITY' => 'save_part',
				'CPU' => gethostbyaddr($_SERVER['REMOTE_ADDR']),
				'OBJECT' => implode("|",$data_insert),
				'CREATED_BY' => $user,
				'CREATED_DATE' => $datenow,
				'CREATED_TIME' => $timenow
			);
			$this->log_m->save($data_log);

			redirect('part_c/index/1');
		}
		
	}

	public function partno_check($partno){
		$status_redudance = $this->part_m->check_redudance($partno);

        if ($status_redudance) {
            $this->form_validation->set_message('partno_check', 'Part No already input');
            return FALSE;
        }else{
            return TRUE;
        }
    }

	public function update_part(){
		$session = $this->session->all_userdata();
		$user = $session['USERNAME'];
		$datenow = date('Ymd');
		$timenow = date('His');

		$id = $this->input->post('id');
		$part_no = $this->input->post('part_no');
		$part_name = $this->input->post('part_name');

		$data_insert = array(
			'PART_NO' => $part_no,
			'PART_NAME' => $part_name 
		);
		$this->part_m->update($data_insert, $id);
		
		$data_log = array(
			'ACTIVITY' => 'update_part',
			'CPU' => gethostbyaddr($_SERVER['REMOTE_ADDR']),
			'OBJECT' => implode("|",$data_insert),
			'CREATED_BY' => $user,
			'CREATED_DATE' => $datenow,
			'CREATED_TIME' => $timenow
		);
		$this->log_m->save($data_log);

		redirect('part_c/index/2');
	}

	public function delete_part($id){
		$this->part_m->delete($id);
		
		$session = $this->session->all_userdata();
		$user = $session['USERNAME'];
		$datenow = date('Ymd');
		$timenow = date('His');

		$data_log = array(
			'ACTIVITY' => 'delete_part',
			'CPU' => gethostbyaddr($_SERVER['REMOTE_ADDR']),
			'OBJECT' => $id,
			'CREATED_BY' => $user,
			'CREATED_DATE' => $datenow,
			'CREATED_TIME' => $timenow
		);
		$this->log_m->save($data_log);

		redirect('part_c/index/3');
	}

}
