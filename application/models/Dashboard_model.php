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
    public function get_monthly_income($year){
		$result= $this->db->select("SUM(amount) as amount, nepali_date as date")->from('tbl_income_data')
                    -> where("nepali_date like '".$year."%'")
                    -> group_by('nepali_date')->get()
       				-> result_array();
       	if(!empty($result)){
       		return $result;
       	}else{
       		return false;
        }
	}
	
	public function get_current_year_expense($year){
		$result= $this->db->select("SUM(amount) as amount")->from('tbl_expense_data')
                    -> where("nepali_date like '".$year."%'")
                    ->get()
       				-> result_array();
       	if(!empty($result)){
       		return $result;
       	}else{
       		return false;
        }
    }
    public function get_current_year_income($year){
		$result= $this->db->select("SUM(amount) as amount")->from('tbl_income_data')
                    -> where("nepali_date like '".$year."%'")
                    ->get()
       				-> result_array();
       	if(!empty($result)){
       		return $result;
       	}else{
       		return false;
		}
    }
	public function get_total_year_expense(){
		$result= $this->db->select("SUM(amount) as amount")->from('tbl_expense_data')
                    ->get()
       				-> result_array();
       	if(!empty($result)){
       		return $result;
       	}else{
       		return false;
        }
    }
    public function get_total_year_income(){
		$result= $this->db->select("SUM(amount) as amount")->from('tbl_income_data')
                    ->get()
       				-> result_array();
       	if(!empty($result)){
       		return $result;
       	}else{
       		return false;
		}
	}
    public function get_yearly_income(){
		$result= $this->db->select("SUM(amount) as amount, nepali_date as date")->from('tbl_income_data')
                    -> group_by('nepali_date')->get()
       				-> result_array();
       	if(!empty($result)){
       		return $result;
       	}else{
       		return false;
        }
    }
    public function get_yearly_expense(){
		$result= $this->db->select("SUM(amount) as amount, nepali_date as date")->from('tbl_expense_data')
                    -> group_by('nepali_date')->get()
       				-> result_array();
       	if(!empty($result)){
       		return $result;
       	}else{
       		return false;
        }
	}
}

