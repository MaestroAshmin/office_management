<?php 
defined('BASEPATH')OR exit('No direct script access');

class BankAccount_model extends CI_model{

    public function add_account($data){
        try{
            $insertData = [
                'bank_name' => $data['bank_name'],
                'account_type' => $data['account_type'],
                'account_no' => $data['account_no'],
                'closing_balance' => $data['closing_balance']
            ];
            $this->db->insert('tbl_bank_account_data',$insertData);
            $result_status = array('status' => 'success', 'message' =>"Successfully added transaction");
        }
        catch(Exception $e){
            $result_status = array('status' => 'failed', 'message' => $e->getMessage());
        }
        return $result_status;
    }
    public function get_accounts(){
        $query = $this->db->select('*')->from('tbl_bank_account_data')->order_by('created_at', 'DESC')->get();
        if ($query) {
            $result = $query->result_array();
        } else {
            $result = array("Error" => $this->db->error());
        }
        return $result;
    }
    public function get_account($id){
        $query = $this->db->select('*')->from('tbl_bank_account_data')->where('ID',$id)->get(); 
        if ($query) {
            $result = $query->row_array();
        } else {
            $result = array("Error" => $this->db->error());
        }
        return $result;
    }
    public function check_account_no($data){
        $query = $this->db->select('*')->from('tbl_bank_account_data')->where('tbl_bank_account_data.account_no',$data["account_no"])->get();
        if ($query->num_rows()>0) {
               $result = true;
        } else {
               $result = false;
        }
        return $result;
    }
    public function update_account($update_data){
        try{
            $data = [
                'bank_name' => $update_data['bank_name'],
                'account_type' => $update_data['account_type'],
                'account_no' => $update_data['account_no'],
                'closing_balance' => $update_data['closing_balance']
            ];
            $this->db->where('ID',$update_data['id']);
            $query = $this->db->update('tbl_bank_account_data',$data);
            $result_status = array('status' => 'success', 'message' =>"Successfully Edited transaction");

        }
        catch (Exception $e){
            $result_status = array('status' => 'failed', 'message' => $e->getMessage());
        }
        return $result_status;
    }
    public function delete_account($id){
        try{
            $this->db->where('ID',$id);
            $query = $this->db->delete('tbl_bank_account_data');
            $result_status = array('status' => 'success', 'message' =>"Successfully Deleted transaction");
            return $result_status;
        }
        catch(Exception $e){
            $result_status = array('status' => 'failed', 'message' => $e->getMessage());
            return $result_status;
        }
    }  
}