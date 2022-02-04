<?php

class user_m extends CI_Model
{

    private $table = 'tm_user';

    public function __construct()
    {
        parent::__construct();
    }

    public function save($data)
    {
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
	
	public function get_data_by_id($user_code){
		$query = $this->db->query("SELECT * FROM $this->table WHERE USER_CODE = '$user_code' AND FLG_DEL = 0");
		
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return 0;
		}

	}

	public function get_data() {
        return $this->db->query("SELECT *, CASE ID_ROLE WHEN 1 THEN 'Administrator' WHEN 2 THEN 'Manager' ELSE 'Supervisor' END AS STRING_ROLE FROM $this->table WHERE FLG_DEL = 0")->result();
	}
	
	public function check_redudance($user_code){
		$data = $this->db->query("SELECT * FROM $this->table WHERE FLG_DEL = 0 AND USER_CODE = '$user_code'");

		if($data->num_rows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	//check existing data user
	public function check_if_exist($user_code) {

		$this->db->where('USER_CODE', $user_code);
		$query = $this->db->get($this->table);
		
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
	}
	
    //check deleted data user
	public function check_if_deleted($user_code) {
        $this->db->where('USER_CODE', $user_code);
		$query = $this->db->get($this->table)->row();

        if ($query->FLG_DEL == '1') {
            return FALSE;
        } else {
            return TRUE;
        }
	}
	
    //check user is login in other machine or not
	public function check_if_on($user_code) {
        $this->db->where('USER_CODE', $user_code);
		$query = $this->db->get($this->table)->row();

        if ($query->FLG_LOG == '1') {

			if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
				//check for ip from share internet
				$ip = $_SERVER["HTTP_CLIENT_IP"];
			} elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
				// Check for the Proxy User
				$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
			} else {
				$ip = $_SERVER["REMOTE_ADDR"];
			}
	
            if (trim($ip) == trim($query->IP)) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return TRUE;
        }
    }

    //check password true or not
	public function check_password($user_code, $pass) {
		$this->db->where('USER_CODE', $user_code);
		$query = $this->db->get($this->table)->row();

        if (trim($pass) == trim($query->PASSWORD)) {
            return TRUE;
        } else {
            return FALSE;
        }
	}

    //check expire password 
	public function check_if_exp_password($user_code) {
        $this->db->where('USER_CODE', $user_code);
		$query = $this->db->get($this->table)->row();

		$now = date('Ymd');
		
        if ($query->EXP_DATE < $now) {
            return FALSE;
        } else {
            return TRUE;
        }
	}
	
    //create session for user login
	public function set_session($user_code) {
        $this->db->where('USER_CODE', $user_code);
		$query = $this->db->get($this->table)->row();

		$this->db->where('USER_CODE', $user_code);
		$this->db->update($this->table, array('FLG_LOG' => 0));
		
        $user_session = array(
            'USER_CODE' => $user_code,
            'USERNAME' => trim($query->USERNAME),
            'ID_ROLE' => $query->ID_ROLE,
            'IP' => $query->IP,
            'REGIS_DATE' => $query->REGIS_DATE,
            'EXP_DATE' => $query->EXP_DATE,
            'VAL' => true
        );
        $this->session->set_userdata($user_session);
	}
	
	function update_user_login($user_code, $data){
		
		$this->db->where('USER_CODE', $user_code);
		$this->db->update($this->table, $data);
	}
	
    public function get_data_user_by_id($user_code){
        $this->db->where('USER_CODE', $user_code);
		return $this->db->get($this->table)->row();
    }
}
