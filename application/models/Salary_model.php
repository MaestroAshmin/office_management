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
    public function get_tax_structure($id, $marital_status){
        $condition = [
            'fy.status'     =>  1,
            'fy.current_fy' =>  1,
            't.status'      =>  1,
            'fy.id'         => $id,
            't.marital_status'  =>  $marital_status
        ];
        $this->db->distinct();
        $query = $this->db->select('*')->from('tbl_tax_structure as t')
                            ->join('tbl_fiscal_year as fy','fy.id=t.fiscal_year_id')
                ->where($condition)->get();
        if($query){
            $result = $query->result_array();
            return $result;
        }
        else{
            return false;
        }
    }
    public function get_employee($id){
        $query = $this->db->select('name')->from('tbl_users')->where('id',$id)->get();
        if($query){
            $result = $query->row_array();
            return $result;
        }
        else{
            return false;
        }
    }
    public function salary_sheet($data){
        $insertData = [
            'user_id'   =>  $data['employee'],
            'fiscal_year_id'    =>   $data['fiscal_year'],
            'month'      =>   $data['month'],
            'pan_no'            =>   $data['pan_no'],
            'emp_code'          =>   $data['emp_code'],
            'marital_status'    =>   $data['marital'],
            'insurance'         =>   $data['insurance'],
            'cit'               =>   $data['cit'],
            'pf'                =>   $data['pf'],
            'ss'                =>   $data['ss'],
            'total_exemption'             =>   $data['te'],
            'taxable_for_month' =>   $data['taxable_for_month'],
            'basic_salary'      =>   $data['basic_salary'],
            'house_rent'        =>   $data['house_rent'],
            'food'              =>   $data['food'],
            'conveyance'        =>   $data['conveyance'],
            'other'             =>   $data['other'],
            'monthly_total'     =>   $data['monthly_total'],
            'monthly_tax'        =>   $data['monthly_tax'],
            'total_payable'     => $data['total_payable'],
            'working_days'      =>  $data['wd'],
            'unpaid_leaves'     =>  $data['ul'],
            'previous_advance'  =>  $data['pa'],
            'deductions'        =>  $data['deductions']
        ];
        $query = $this->db->insert('tbl_salary_sheet',$insertData);
        if ($query) {
            $result_status = array('status' => 'success', 'message' =>"Successfully Created Salary Sheet");
        } else {
                $result_status = array('status' => 'failed', 'message' => $e->getMessage());
        }
        return $result_status;
    }
    public function get_salary_details(){
        $query = $this->db->select('ss.id,fy.fiscal_year,ss.month,u.name,d.Designation,ss.monthly_total,ss.total_exemption,ss.monthly_tax,ss.previous_advance,ss.deductions,ss.total_payable')->from('tbl_salary_sheet as ss')
                            ->join('tbl_fiscal_year as fy','fy.id=ss.fiscal_year_id')
                            ->join('tbl_users as u','u.id=ss.user_id')
                            ->join('tbl_designation as d', 'd.id=u.des_id')
                            ->order_by('ss.created_at','DESC')->get();
        if($query){
            $result = $query->result_array();
            return $result;
        }
        else{
            return false;
        }
    }

    public function get_salary_details_by_id($data){
        $query = $this->db->select('ss.id,fy.fiscal_year,ss.month,u.name,d.Designation,ss.monthly_total,ss.basic_salary,ss.house_rent, ss.food,ss.conveyance,ss.other,ss.total_exemption,ss.monthly_tax,ss.deductions,ss.total_payable,ss.previous_advance')->from('tbl_salary_sheet as ss')
                            ->join('tbl_fiscal_year as fy','fy.id=ss.fiscal_year_id')
                            ->join('tbl_users as u','u.id=ss.user_id')
                            ->join('tbl_designation as d', 'd.id=u.des_id')
                            ->where('ss.id IN ('.$data['id'].')')
                            ->order_by('ss.created_at','DESC')->get();
        if($query){
            $result = $query->result_array();
            return $result;
        }
        else{
            return false;
        }
    }
}