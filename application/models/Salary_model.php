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
        $query = $this->db->select('*')->from('tbl_employee_info as e')
                ->join('tbl_users as u','u.emp_code=e.emp_code')
                ->where('u.id',$id)->get();
        if($query){
            $result = $query->result_array();
            return $result;
        }
        else{
            return false;
        }
    }
}