<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard_c extends CI_Controller {

	public $layout = '/template/contains';

	public function index($msg = NULL)
	{

		$user_session = $this->session->all_userdata();
		
		if (!$user_session['USER_CODE']) {
            redirect(base_url('index.php/login_c'));
		}

		$this->load->model('role_module_m');
		$this->load->model('production_result_m');
		$this->load->model('part_m');
		$this->load->model('machine_m');

		$data['msg'] = $msg;
		$data['title'] = 'Dashboard';

		$session = $this->session->all_userdata();
		$role = $session['ROLE'];

		if($role == 1){
			$data['content'] = 'dashboard/admin_dashboard';
		}else if($role == 2){
			$data['content'] = 'dashboard/manager_dashboard';
		}else {
			$data['content'] = 'dashboard/supervisor_dashboard';
		}
		
		$data['menu_dashboard'] = $this->role_module_m->get_dashboard_module_by_role($role);
        $data['menu_master'] = $this->role_module_m->get_master_module_by_role($role);
		$data['menu_report'] = $this->role_module_m->get_report_module_by_role($role);

		$data['data_parts'] = $this->part_m->get_data_parts()->num_rows();
		$data['data_machines'] = $this->machine_m->get_data_machines()->num_rows();

		$data['qty_parts_permonth'] = $this->production_result_m->get_qty_parts_monthly();
		$data['qty_parts_perweek'] = $this->production_result_m->get_qty_parts_weekly();
		$data['qty_machines_permonth'] = $this->production_result_m->get_qty_machines_monthly();
		$data['qty_machines_perweek'] = $this->production_result_m->get_qty_machines_weekly();

		$this->load->view($this->layout, $data);
		
	}
}
