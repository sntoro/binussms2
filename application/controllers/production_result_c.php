<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class production_result_c extends CI_Controller {

	public $layout = '/template/contains';

	public function __construct() {
        parent::__construct();
		$this->load->model('production_result_m');
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

		$data['data'] = $this->production_result_m->get_data();
		$data['msg'] = $msg;

		$role = $user_session['ROLE'];
		
		$data['menu_dashboard'] = $this->role_module_m->get_dashboard_module_by_role($role);
        $data['menu_master'] = $this->role_module_m->get_master_module_by_role($role);
		$data['menu_report'] = $this->role_module_m->get_report_module_by_role($role);

        $data['content'] = 'production_result/report_production_result';
		$data['title'] = 'Report Production Results';

		$this->load->view($this->layout, $data);
		
	}


}
