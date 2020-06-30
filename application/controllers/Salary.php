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
}