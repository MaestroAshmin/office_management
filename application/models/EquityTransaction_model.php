<?php 
defined('BASEPATH')OR exit('No direct script access');

class EquityTransaction_model extends CI_model{

    public function add_transaction($data){
        try{
            $insertData = [
                'english_date'=> $data['eng_date'],
                'nepali_date'=> $data['nepali_date'],
                'Depositor' => $data['depositor'],
                'Status' => $data['status'],
                'Amount' => $data['amount'],
                'Remarks' => $data['remarks']
            ];
            $this->db->insert('tbl_equity_data',$insertData);
            $result_status = array('status' => 'success', 'message' =>"Successfully added transaction");
        }
        catch(Exception $e){
            $result_status = array('status' => 'failed', 'message' => $e->getMessage());
        }
        return $result_status;
    }
    public function get_transactions(){
        $query = $this->db->select('*')->from('tbl_equity_data')->order_by('created_at', 'DESC')->get();
        if ($query) {
            $result = $query->result_array();
        } else {
            $result = array("Error" => $this->db->error());
        }
        return $result;
    }
    public function get_transaction($id){
        $query = $this->db->select('*')->from('tbl_equity_data')->where('ID',$id)->get(); 
        if ($query) {
            $result = $query->row_array();
        } else {
            $result = array("Error" => $this->db->error());
        }
        return $result;
    }
    public function update_transaction($update_data){
        try{
            $data = [
                'Depositor' => $update_data['depositor'],
                'Status' => $update_data['status'],
                'Amount' => $update_data['amount'],
                'Remarks' => $update_data['remarks']
            ];
            $this->db->where('ID',$update_data['id']);
            $query = $this->db->update('tbl_equity_data',$data);
            $result_status = array('status' => 'success', 'message' =>"Successfully Edited transaction");

        }
        catch (Exception $e){
            $result_status = array('status' => 'failed', 'message' => $e->getMessage());
        }
        return $result_status;
    }
    public function delete_transaction($id){
        try{
            $this->db->where('ID',$id);
            $query = $this->db->delete('tbl_equity_data');
            $result_status = array('status' => 'success', 'message' =>"Successfully Deleted transaction");
            return $result_status;
        }
        catch(Exception $e){
            $result_status = array('status' => 'failed', 'message' => $e->getMessage());
            return $result_status;
        }
    }  
}