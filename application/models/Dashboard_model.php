<?php 
defined('BASEPATH')OR exit('No direct script access');

class Dashboard_model extends CI_Model{

	public function get_monthly_expense($year){
		$result= $this->db->select("SUM(amount) as amount, nepali_date as date")->from('tbl_expense_data')
                    -> where("nepali_date like '".$year."%'")
                    -> group_by('nepali_date')->get()
       				-> result_array();
       	if(!empty($result)){
       		return $result;
       	}else{
       		return false;
           }
    }
}

