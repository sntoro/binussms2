<?php

class machine_m extends CI_Model
{

    private $table = 'tm_machine';

    public function __construct()
    {
        parent::__construct();
    }

    public function save($data) {
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
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

	public function get_data_machines_by_machine_code($id) {
        return $this->db->query("SELECT * FROM $this->table WHERE FLG_DEL = 0 AND ID = '$id'")->row();
	}
	
    public function get_data() {
        return $this->db->query("SELECT * FROM $this->table WHERE FLG_DEL = 0")->result();
	}

	public function get_top_data_machine(){
        return $this->db->query("SELECT  * FROM $this->table WHERE FLG_DEL = 0 ORDER BY ID LIMIT 1 ")->row();
	}
    
    public function get_data_machines() {
        return $this->db->query("SELECT * FROM $this->table WHERE FLG_DEL = 0");
	}


	public function check_redudance($machine_code){
		$data = $this->db->query("SELECT * FROM $this->table WHERE FLG_DEL = 0 AND MACHINE_CODE = '$machine_code'");

		if($data->num_rows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}

    
}
