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
	
	public function get_monthly_target($check_date, $user_id){
		$condition = array(
			't.check_date' => $check_date,
			'u.id' => $user_id	
		);
			$query = $this->db->select('*')->from('tbl_target as t')->join('tbl_users as u','u.id = t.assigned_to')
					->where($condition)
					->get();
		if($query){
			$result = $query->row_array();
			return $result;
		}
		else{
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

	public function get_current_year_equity($year){
		$result= $this->db->select("SUM(amount) as amount")->from('tbl_equity_data')
                    -> where("nepali_date like '".$year."%'")
                    ->get()
       				-> result_array();
       	if(!empty($result)){
       		return $result;
       	}else{
       		return false;
		}
    }
	public function get_total_year_equity(){
		$result= $this->db->select("SUM(amount) as amount")->from('tbl_equity_data')
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

	public function get_live_seats($date,$user_id)
	{
		$query = $this->db->select("SUM(c.live_seat) as live_seat")->from('csv_data as c')->where("f.date like '".$date."%' && Status = 'LIVE' && c.uploaded_by = '".$user_id."'")
				->join('tbl_follow_up as f', 'c.id = f.csv_data_id')
				->get();
		if($query){
			$result = $query->row_array();
			return $result['live_seat'];
		}
		else{
			return false;
		}
	}
	public function get_follow_ups($date,$user_id){
		$query = $this->db->select("COUNT(f.id) as follow_up_count")->from('csv_data as c')->where("f.date like '".$date."%' && c.uploaded_by = '".$user_id."'")
				->join('tbl_follow_up as f', 'c.id = f.csv_data_id')
				->get();
		if($query){
			$result = $query->row_array();
			return $result['follow_up_count'];
		}
		else{
			return false;
		}
	}
	public function get_signed_contracts($date,$user_id){
		$query = $this->db->select("COUNT(c.id) as signed_contract_count")->from('csv_data as c')->where("f.date like '".$date."%' && Status = 'CONTRACT SIGNED' && c.uploaded_by ='".$user_id."'")
				->join('tbl_follow_up as f', 'c.id = f.csv_data_id')
				->get();	
		if($query){
			$result = $query->row_array();
			return $result['signed_contract_count'];
		}
		else{
			return false;
		}
	}
	public function get_new_contacts($date,$user_id){
		$query = $this->db->select("COUNT(c.id) as new_contact")->from('csv_data as c')->where("f.date like '".$date."%' && new_contact = 'YES' && (Status ='NEGOTIATION' || Status = 'LEAD') && c.uploaded_by ='".$user_id."'")
				->join('tbl_follow_up as f', 'c.id = f.csv_data_id')
				->get();
		if($query){
			$result = $query->row_array();
			return $result['new_contact'];
		}
		else{
			return false;
		}
	}
	public function get_marketing_employee($user_role,$user_id,$is_head){
		if($user_role == 1 || $is_head[0]['is_head']==1){
			$query = $this->db->select('id,name')->from('tbl_users')->where('dept_id =' , 2)->get();
			if($query){
				$result = $query->result_array();
				return $result;
			}
			else{
				return false;
			}
		}
		else{
			$query = $this->db->select('id,name')->from('tbl_users')->where('id=' , $user_id)->get();	
			if($query){
				$result = $query->result_array();
				return $result;
			}
			else{
				return false;
			}	
	 	}
	}
}

