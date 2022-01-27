<?php

class part_m extends CI_Model
{

    private $table = 'tm_part';

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

	public function get_data_parts_by_part_no($id) {
        return $this->db->query("SELECT * FROM $this->table WHERE FLG_DEL = 0 AND ID = '$id'")->row();
	}

    public function get_data() {
        return $this->db->query("SELECT * FROM $this->table WHERE FLG_DEL = 0")->result();
    }
    
    public function get_data_parts() {
        return $this->db->query("SELECT * FROM $this->table WHERE FLG_DEL = 0");
    }
	
	public function check_redudance($partno){
		$data = $this->db->query("SELECT * FROM $this->table WHERE FLG_DEL = 0 AND PART_NO = '$partno'");

		if($data->num_rows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}

    
}
