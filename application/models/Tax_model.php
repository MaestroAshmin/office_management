<?php
defined('BASEPATH') OR exit('No Direct Script Access Allowed');

class Tax_model extends CI_model
{
    public function add_fiscal_year($data){
        $is_exists = $this->tax_model->is_exists($data);
        if(!$is_exists){
            try{
                $query = $this->db->insert('tbl_fiscal_year',$data);
                $result_status = array('status' => 'success', 'message' =>"Successfully added Fiscal Year");    
            }
            catch(Exception $e){
                $result_status = array('status'=> 'failed', 'message' => 'Fail to add Fiscal Year');
            }
        }
        else{
            $result_status = array('status'=> 'failed', 'message' => 'Fiscal Year Already Exists or Cannot have two active Fiscal Year at once');
        }
    }
    public function is_exists($data){

        $query  =   $this->db->select('*')->from('tbl_fiscal_year')->where('current_fy',1)->get();
        if($query->num_rows > 0){
            return true;
        }
        else{
            $query2  =   $this->db->select('*')->from('tbl_fiscal_year')->where('fiscal_year',$data['fiscal_year'])->get();
            if($query2->num_rows() > 0 ){
                return true;
            }
            else{
                return false;
            }
        }
    }
    
    public function get_fiscal_years(){
        $query = $this->db->select('*')->from('tbl_fiscal_year')->get();
        if($query){
            $result = $query->result_array();
            return $result;
        }
        else{
            return $false;
        }
    }
}   