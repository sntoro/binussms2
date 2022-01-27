<?php

class role_module_m extends CI_Model
{

        private $table = 'tt_role_module';
        private $table_module = 'tm_module';

        public function __construct()
        {
                parent::__construct();
        }

        public function save($data)
        {
                $this->db->insert($this->table, $data);
        }

        public function update($data, $id)
        {

                $this->db->where('ID', $id);
                $this->db->update($this->table, $data);
        }

        public function delete($id)
        {
                $data = array('FLG_DEL' => 1);

                $this->db->where('ID', $id);
                $this->db->update($this->table, $data);
        }

        public function get_data()
        {
                return $this->db->query("SELECT * FROM $this->table WHERE FLG_DEL = 0")->result();
        }

        public function get_master_module_by_role($id)
        {
                return $this->db->query("SELECT * FROM $this->table_module M INNER JOIN $this->table RM ON M.ID = RM.ID_MODULE WHERE ID_ROLE = $id AND FLG_DEL = 0 AND FLG_MENU = 2")->result();
        }

        public function get_dashboard_module_by_role($id)
        {
                return $this->db->query("SELECT * FROM $this->table_module M INNER JOIN $this->table RM ON M.ID = RM.ID_MODULE WHERE ID_ROLE = $id AND FLG_DEL = 0 AND FLG_MENU = 1")->result();
        }

        public function get_report_module_by_role($id)
        {
                return $this->db->query("SELECT * FROM $this->table_module M INNER JOIN $this->table RM ON M.ID = RM.ID_MODULE WHERE ID_ROLE = $id AND FLG_DEL = 0 AND FLG_MENU = 3")->result();
        }

        public function check_redudance($machine_code)
        {
                $data = $this->db->query("SELECT * FROM $this->table WHERE FLG_DEL = 0 AND MACHINE_CODE = '$machine_code'");

                if ($data->num_rows() > 0) {
                        return TRUE;
                } else {
                        return FALSE;
                }
        }
}
