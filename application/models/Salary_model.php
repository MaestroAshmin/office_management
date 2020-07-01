<?php
defined('BASEPATH') or exit('No direct Script Access Allowed');

class Salary_model extends CI_model{

    public function get_all_employees(){
        $query = $this->db->select('name,id')->from('tbl_users')->where('role',3)->get();
        if($query){
            $result = $query->result_array();
            return $result;
        }
        else{
            return false;
        }
    }
    public function get_employee_info($id){
        $condition = [
            'u.id'  =>  $id,
            'fy.current_fy'   =>  1,
        ];
        $this->db->distinct();
        $query = $this->db->select('u.name,e.emp_code,e.pan_no,e.marital_status, s.total_monthly,s.basic_salary,s.house_rent,s.food,s.conveyance,s.other,fy.fiscal_year')->from('tbl_employee_info as e')
                ->join('tbl_users as u','u.emp_code=e.emp_code')
                ->join('tbl_salary as s','s.emp_code=e.emp_code')
                ->join('tbl_fiscal_year as fy','fy.id=s.fy_id')
                ->where($condition)->get();
        if($query){
            $result = $query->result_array();
            return $result;
        }
        else{
            return false;
        }
    }
    public function get_tax_structure($id){
        $condition = [
            
            'fy.status'    =>  1,
            'fy.current_fy'   =>  1,
            't.status'      => 1
        ];
        $this->db->distinct();
        $query = $this->db->select('*')->from('tbl_tax_structure as t')
                            ->join('tbl_fiscal_year as fy','fy.id=t.fiscal_year_id')
                            ->join('tbl_salary as s','s.fy_id=fy.id')
                            ->join('tbl_employee_info as e','s.emp_code=e.emp_code')
                            ->join('tbl_users as u','u.emp_code=e.emp_code')
                ->where($condition)->get();
        if($query){
            $result = $query->result_array();
            return $result;
        }
        else{
            return false;
        }
    }
}