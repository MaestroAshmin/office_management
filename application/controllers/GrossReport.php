<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GrossReport extends CI_controller{

    public function __construct(){
		parent:: __construct();
		$this->load->library('session');
		$this->load->model('grossreport_model');
	}

    public function gross_report(){

        if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}
		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
        $user_role = $sess_data['user_role'];
        $reports = $this->grossreport_model->get_grossreport();
		$data = array(
			'title' 		=> 'Gross Report',
			'main_content'	=> 'gross_report',
            'role' 			=> $user_role,
            'reports'       => $reports
		);
		$this->load->view('includes/template', $data);
    }
}