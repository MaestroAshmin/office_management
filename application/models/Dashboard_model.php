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
			$query = $this->db->select('*')->from('tbl_target as t')
					->where('t.check_date =', $check_date)		
					->get();
		if($query){
			$result = $query->result_array();
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

	public function get_live($date, $user_id)
	{
		if($user_id == 1){
			$query = $this->db->select("SUM(c.live_seat) as live_seat, c.uploaded_by")->from('csv_data as c')->where("f.date like '".$date."%' && Status = 'LIVE'")
					->join('tbl_follow_up as f', 'c.id = f.csv_data_id')
					->group_by('c.uploaded_by')
					->get();
		}
		else{
			$query = $this->db->select('COUNT(c.live_seat) as live_seat, c.uploaded_by')->from('csv_data as c')->where("f.date like '".$date."%' && Status = 'LIVE' && c.uploaded_by = '".$user_id."%'")
					->join('tbl_follow_up as f', 'c.id = f.csv_data_id')->group_by('c.uploaded_by')->get();
		}
			
		if($query){
			$result = $query->result_array();
			return $result;
		}
		else{
			return false;
		}
	}
	public function get_follow_up($date, $user_id)
	{
		if($user_id == 1){
			$query = $this->db->select("COUNT(f.id) as follow_up_count, c.uploaded_by")->from('csv_data as c')->where("f.date like '".$date."%'")
					->join('tbl_follow_up as f', 'c.id = f.csv_data_id')
					->group_by('c.uploaded_by')
					->get();
		}
		else{
			$query = $this->db->select('COUNT(f.id) as follow_up_count, c.uploaded_by')->from('csv_data as c')->where("f.date like '".$date."%' && c.uploaded_by = '".$user_id."%'")
					->join('tbl_follow_up as f', 'c.id = f.csv_data_id')->group_by('c.uploaded_by')->get();
		}
			
		if($query){
			$result = $query->result_array();
			return $result;
		}
		else{
			return false;
		}
	}
	public function get_contract_signed($date, $user_id)
	{
		if($user_id == 1){
			$query = $this->db->select("COUNT(c.id) as signed_contract_count, c.uploaded_by")->from('csv_data as c')->where("f.date like '".$date."%' && Status = 'CONTRACT SIGNED'")
					->join('tbl_follow_up as f', 'c.id = f.csv_data_id')
					->group_by('c.uploaded_by')
					->get();
		}
		else{
			$query = $this->db->select('COUNT(c.id) as signed_contract_count, c.uploaded_by')->from('csv_data as c')->where("f.date like '".$date."%' && Status = 'CONTRACT SIGNED' && c.uploaded_by = '".$user_id."%'")
					->join('tbl_follow_up as f', 'c.id = f.csv_data_id')->group_by('c.uploaded_by')->get();
		}
			
		if($query){
			$result = $query->result_array();
			return $result;
		}
		else{
			return false;
		}
	}
	public function get_new_contact($date, $user_id)
	{
		if($user_id == 1){
			$query = $this->db->select("COUNT(c.id) as new_contact, c.uploaded_by")->from('csv_data as c')->where("f.date like '".$date."%' && new_contact = 'YES' && (Status ='NEGOTIATION' || Status = 'LEAD')")
					->join('tbl_follow_up as f', 'c.id = f.csv_data_id')
					->group_by('c.uploaded_by')
					->get();
		}
		else{
			$query = $this->db->select('COUNT(c.id) as new_contact, c.uploaded_by')->from('csv_data as c')->where("f.date like '".$date."%' && new_contact = 'YES' && c.uploaded_by = '".$user_id."%'")
					->join('tbl_follow_up as f', 'c.id = f.csv_data_id')->group_by('c.uploaded_by')->get();
		}
		if($query){
			$result = $query->result_array();
			return $result;
		}
		else{
			return false;
		}
	}
}

