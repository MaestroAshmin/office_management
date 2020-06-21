<?php 
defined('BASEPATH')OR exit('No direct script access');

class Dashboard_model extends CI_Model{

	public function get_monthly_expense(){
		$result= $this->db->select('id, name, email,role')->from('tbl_users')
					-> where('email', $email)
					-> where('password', $password)
       				-> limit(1)
                                   -> get()
       				-> row_array();
       	if(!empty($result)){
       		return $result;
       	}else{
       		return false;
       	}	
	}
	public function get_monthly_performance(){
		$query = $this->db->select('*')->from('csv_data')->get();
		exit;
	}
}