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
        $this->load->library('form_validation');
        $this->form_validation->set_rules("fiscal_year","Fiscal_Year","required",array("required"=>"Please Enter Fiscal Year"));
        $this->form_validation->set_rules("no_of_months","No_of_months","required",array("required"=>"Please Select No. of months"));
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
        $data['yearly_tax'] = $this->calculate_tax_by_recursion($yearly_tax = 0, $i = 0, $taxes, $data['annual_tax_exemption']);
        $result = $this->salary_model->salary_sheet($data);
        echo '<pre>'; print_r($data);
    }

    public function calculate_tax_by_recursion($yearly_tax, $i, $taxes,$remaining){
        $length = $i+1;
        if($length ==  count($taxes)){
            if($remaining <= $taxes[$i]['amount']){
                $yearly_tax = $yearly_tax + (($taxes[$i]['tax_percent']/100)* $remaining);
                return $yearly_tax;
            }
            else{
                $yearly_tax = $yearly_tax + (($taxes[$i]['tax_percent']/100)* $remaining);
                $remaining = $remaining -  $taxes[$i]['amount'];
                return $yearly_tax;
            }   
        }
        else{
            if($remaining <= $taxes[$i]['amount']){
                $yearly_tax = $yearly_tax + (($taxes[$i]['tax_percent']/100)* $remaining);
                return $yearly_tax;
            }
            else{
                $yearly_tax = $yearly_tax + (($taxes[$i]['tax_percent']/100)* $taxes[$i]['amount']);
                $remaining = $remaining -  $taxes[$i]['amount'];
                $i++;
                return $this->calculate_tax_by_recursion($yearly_tax,$i,$taxes,$remaining);
            }   
        }
    }
}