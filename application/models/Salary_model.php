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
        ];
        $this->db->distinct();
        $query = $this->db->select(' u.name,e.emp_code,e.pan_no,e.marital_status,e.join_date, s.total_monthly,s.basic_salary,s.house_rent,s.food,s.conveyance,s.other,fy.fiscal_year,fy.id as fiscal_id')->from('tbl_employee_info as e')
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
    public function get_comparison_for_tax($data){
        $condition = [
            'marital_status' => $data['marital_status'],
            'fiscal_year_id'    =>$data['id']
        ];
        $query = $this->db->select('t.amount')->from('tbl_tax_structure as t')->where($condition)->get();
        if($query){
            $result = $query->row_array();
            return $result;
        }
        else{
            return false;
        }
    }
    public function get_tax_structure($id, $marital_status){
        $condition = [
            'fy.status'     =>  1,
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
        // echo '<pre>';print_r($data);exit;
        $salary_sheet_exists = $this->salary_sheet_exists($data['employee'],$data['fiscal_year'],$data['month']);
        if(!$salary_sheet_exists){
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
                'deductions'        =>  $data['deductions'],
                'total_months'      =>  $data['total_months'],
                'annual_taxable'    =>  $data['annual_taxable'],
                'tax_compare'       =>  $data['tax_compare']
            ];
            $query = $this->db->insert('tbl_salary_sheet',$insertData);
            if ($query) {
                $result_status = array('status' => 'success', 'message' =>"Successfully Created Salary Sheet");
            } else {
                    $result_status = array('status' => 'failed', 'message' => $e->getMessage());
            }
        }
        else{
            $result_status = array('status' => 'failed', 'message' => 'Salary Sheet already exists for the user for the selected month');
        }
        return $result_status;
    }
    public function salary_sheet_exists($user_id,$fiscal_year,$month){
        $condition = [
            'user_id' => $user_id,
            'fiscal_year_id' => $fiscal_year,
            'month' => $month
        ];
        $query = $this->db->select('*')->from('tbl_salary_sheet')->where($condition)->get();
        if($query->num_rows()>0){
            return true;
        }
        else{
            return false;
        }
    }
    public function get_single_salary($id){
        $query = $this->db->select('s.id,fy.fiscal_year,e.marital_status,s.annual_taxable,e.emp_code,e.pan_no,u.emp_code,s.tax_compare, s.fiscal_year_id,u.id as user_id, s.month,s.working_days,s.unpaid_leaves,s.previous_advance,s.insurance,s.cit,s.pf,s.ss,u.name,d.Designation,s.monthly_total,s.total_exemption,s.total_months,s.monthly_tax,s.previous_advance,s.deductions,s.total_payable,s.taxable_for_month,s.basic_salary,s.house_rent,s.food,s.conveyance,s.other,s.pan_no,s.emp_code,s.marital_status')->from('tbl_salary_sheet as s')
                            ->join('tbl_fiscal_year as fy','fy.id=s.fiscal_year_id')
                            ->join('tbl_users as u','u.id=s.user_id')
                            ->join('tbl_employee_info as e','u.emp_code=e.emp_code')
                            ->join('tbl_designation as d', 'd.id=u.des_id')
                            ->where('s.id',$id)->get();
        if($query){
            $result = $query->row_array();
            return $result;
        }
        else{
            return false;
        }
    }
    public function update_salary_sheet($data){
        // echo '<pre>';print_r($data);exit;
        try{
            $updateData = [
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
                'deductions'        =>  $data['deductions'],
                'total_months'      =>  $data['total_months'],
                'annual_taxable'    =>  $data['annual_taxable'],
                'tax_compare'       =>  $data['tax_compare']
            ];
            $this->db->where('id',$data['id']);
            $this->db->update('tbl_salary_sheet',$updateData);
            $result_status = array('status' => 'success', 'message' =>"Successfully Edited Salary Sheet");

        }
        catch (Exception $e){
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