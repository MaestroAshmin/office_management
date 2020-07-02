<?php
defined('BASEPATH') OR exit('No direct Script Access');

class Salary extends CI_Controller{

    public function __construct(){

        parent::__construct();
        $this->load->library('session');
        $this->load->model('salary_model');
        $this->load->model('tax_model');

    }

       
    public function salary_table()
    {
        if($this->session->userdata('user_logged_in') != '1'){
            redirect('user', 'refresh');
        }
        $sess_data = $this->session->all_userdata();
        $user_id   = $sess_data['user_id'];
        $user_role  =   $sess_data['user_role'];
        $user_dept  =   $sess_data['user_dept'];
        $user_des  =   $sess_data['user_des'];
        $fiscal_years   =   $this->tax_model->get_fiscal_years();
        $employees = $this->salary_model->get_all_employees();
        $data = array(
            'title' 		=> 'Salary Table',
            'main_content'	=> 'salary_table',
            'role'          =>  $user_role,
            'dept'          =>  $user_dept,
            'des'           =>  $user_des,
            'fiscal_years'  =>  $fiscal_years,
            'employees'     =>  $employees 
        );
        $this->load->view('includes/template', $data);
    }

    public function get_employee_info(){
        $id = $this->input->post('id');
        $result = $this->salary_model->get_employee_info($id);
        print_r(json_encode($result));
    }
    public function calculate_tax(){
        $data = $this->input->post();
        echo '<pre>';print_r($data);
        $this->load->library('form_validation');
        $this->form_validation->set_rules("fiscal_year","Fiscal_Year","required",array("required"=>"Please Enter Fiscal Year"));
        $this->form_validation->set_rules("month","Month","required",array("required"=>"Please Select Month"));
        $this->form_validation->set_rules("employee","Employee","required",array("required"=>"Please Select Employee"));
        if($this->form_validation->run()==false){
            $this->session->set_flashdata('error',$this->form_validation->error_array());
            redirect('salary/salary_table');
        }
        if($data['marital_status']  == 'Married'){
            $marital_status     =   1;
        }
        else{
            $marital_status     =   0;
        }
        $data['marital']    =   $marital_status;
        $taxes = $this->salary_model->get_tax_structure($data['fiscal_year'],$marital_status);
        $employee = $this->salary_model->get_employee($data['employee']);
        $data['employee_name'] = $employee['name'];
        $rem = $data['taxable_for_month'] *12;
        $data['monthly_tax'] = $this->calculate_tax_by_recursion($monthly_tax = 0, $i = 0, $taxes, $rem);
        $result = $this->salary_model->salary_sheet($data);
        if($result['status'] == 'success'){
            redirect('salary/salary_table');
        }
        else{
            $this->session->set_flashdata('error',$result['message']);
            redirect('salary/salary_table');
        }
    }

    public function calculate_tax_by_recursion($monthly_tax, $i, $taxes,$remaining){
        $length = $i+1;
        if($length ==  count($taxes)){
            if($remaining <= $taxes[$i]['amount']){
                $monthly_tax = $monthly_tax + (($taxes[$i]['tax_percent']/100)* $remaining);
                return $monthly_tax/12;
            }
            else{
                $monthly_tax = $monthly_tax + (($taxes[$i]['tax_percent']/100)* $remaining);
                $remaining = $remaining -  $taxes[$i]['amount'];
                return $monthly_tax/12;
            }   
        }
        else{
            if($remaining <= $taxes[$i]['amount']){
                $monthly_tax = $monthly_tax + (($taxes[$i]['tax_percent']/100)* $remaining);
                return $monthly_tax/12;
            }
            else{
                $monthly_tax = $monthly_tax + (($taxes[$i]['tax_percent']/100)* $taxes[$i]['amount']);
                $remaining = $remaining -  $taxes[$i]['amount'];
                $i++;
                return $this->calculate_tax_by_recursion($monthly_tax,$i,$taxes,$remaining);
            }   
        }
    }
    public function get_tax_amount_yearly(){
        $data = $this->input->post();
        $this->load->library('form_validation');
        $this->form_validation->set_rules("fiscal_year","Fiscal_Year","required",array("required"=>"Please Enter Fiscal Year"));
        $this->form_validation->set_rules("month","Month","required",array("required"=>"Please Select Month"));
        $this->form_validation->set_rules("employee","Employee","required",array("required"=>"Please Select Employee"));
        if($this->form_validation->run()==false){
            $this->session->set_flashdata('error',$this->form_validation->error_array());
            redirect('salary/salary_table');
        }
        if($data['marital_status']  == 'Married'){
            $marital_status     =   1;
        }
        else{
            $marital_status     =   0;
        }
        $data['marital']    =   $marital_status;
        $taxes = $this->salary_model->get_tax_structure($data['fiscal_year'],$marital_status);
        $rem = $data['taxable_for_month'] *12;
        $data['monthly_tax'] = $this->calculate_tax_by_recursion($monthly_tax = 0, $i = 0, $taxes, $rem);
        print_r(json_encode($data['monthly_tax']));
    }
    public function view_salary_details(){
        if($this->session->userdata('user_logged_in') != '1'){
            redirect('user', 'refresh');
        }
        $sess_data = $this->session->all_userdata();
        $user_id   = $sess_data['user_id'];
        $user_role  =   $sess_data['user_role'];
        $user_dept  =   $sess_data['user_dept'];
        $user_des  =   $sess_data['user_des'];
        $salary_data    =   $this->salary_model->get_salary_details();
        $data = array(
            'title' 		=> 'View / Print Salary Details',
            'main_content'	=> 'view_salary_details',
            'role'          =>  $user_role,
            'dept'          =>  $user_dept,
            'des'           =>  $user_des,
            'salary_data'   =>  $salary_data
        );
        $this->load->view('includes/template', $data);
    }
}