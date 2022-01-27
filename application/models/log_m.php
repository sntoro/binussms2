<?php

class log_m extends CI_Model
{

    private $table = 'tt_log';

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
	
    public function get_data() {
        return $this->db->query("SELECT * FROM $this->table WHERE FLG_DEL = 0")->result();
	}
    
}
