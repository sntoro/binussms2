<?php

class production_result_m extends CI_Model
{

    private $table = 'tr_production_result';

    public function __construct()
    {
        parent::__construct();
    }

    public function save($data) {
        $this->db->insert($this->table, $data);
	}
	
    public function update($data, $id) {
		
        $this->db->where('ID', $id);
        $this->db->update($this->table, $data);
	}
	
	public function delete($id) {
        $data = array('FLG_DEL' => 1);

        $this->db->where('ID', $id);
        $this->db->update($this->table, $data);
    }

    public function get_data() {
        return $this->db->query("SELECT M.MACHINE_NAME, P.PART_NAME, M.LOCATION, SUM(PR.QTY) QTY FROM $this->table PR 
		INNER JOIN tm_machine M ON M.MACHINE_CODE = PR.MACHINE_CODE
		INNER JOIN tm_part P ON P.PART_NO = PR.PART_NO
		WHERE P.FLG_DEL = 0 AND M.FLG_DEL = 0
		GROUP BY PR.MACHINE_CODE, PR.PART_NO")->result();
	}
    
    public function get_qty_parts_monthly(){
        $period = date('m');

        $query = $this->db->query("SELECT COUNT(PART_NO) TOTAL_PART FROM $this->table
        WHERE CREATED_DATE LIKE '$period%' AND FLG_DEL = 0");

        if($query->num_rows() > 0){
            return $query->row()->TOTAL_PART;
        }else{
            return 0;
        }

    }

    public function get_qty_machines_monthly(){
        $period = date('m');

        $query = $this->db->query("SELECT COUNT(MACHINE_CODE) TOTAL_MACHINE FROM $this->table
        WHERE CREATED_DATE LIKE '$period%' AND FLG_DEL = 0");

        if($query->num_rows() > 0){
            return $query->row()->TOTAL_MACHINE;
        }else{
            return 0;
        }
    }

    public function get_qty_parts_weekly(){
        return 0;
    }

    public function get_qty_machines_weekly(){
        return 0;
    }
    
}
