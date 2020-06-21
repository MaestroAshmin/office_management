<?php 
defined('BASEPATH')OR exit('No direct script access');

class IncomeTransaction_model extends CI_model{

    public function add_transaction($data){

        try{
            $insertData = [
                'Heading' => $data['heading'],
                'english_date'=> $data['eng_date'],
                'nepali_date'=> $data['nepali_date'],
                'bill_invoice_no' => $data['bill_invoice_no'],
                'responsible_person' => $data['responsible_person'],
                'from_person' => $data['from'],
                'Amount' => $data['amount'],
                'Remarks' => $data['remarks'],
                'Details' => $data['details'],
                'Image' => $data['image'],
                'excel' => ($data['excel']!=''|| !empty($data['excel'])) ? $data['excel'] : ''
            ];

            $this->db->insert('tbl_income_data',$insertData);
            $result_status = array('status' => 'success', 'message' =>"Successfully added transaction");
        }
        catch(Exception $e){
            $result_status = array('status' => 'failed', 'message' => $e->getMessage());
        }
        return $result_status;
    }
    public function get_transactions(){
        $query = $this->db->select('*')->from('tbl_income_data')->order_by('created_at', 'DESC')->get();
        if ($query) {
            $result = $query->result_array();
        } else {
            $result = array("Error" => $this->db->error());
        }
        return $result;
    }
    public function get_transaction($id){
        $query = $this->db->select('*')->from('tbl_income_data')->where('ID',$id)->get(); 
        if ($query) {
            $result = $query->row_array();
        } else {
            $result = array("Error" => $this->db->error());
        }
        return $result;
    }
    public function update_transaction($update_data){
        try{
            if(isset($update_data['image_name'])){
                $data=array(
                    'Heading' => $update_data['heading'],
                    'bill_invoice_no' => $update_data['bill_invoice_no'],
                    'responsible_person' => $update_data['responsible_person'],
                    'from_person' => $update_data['from'],
                    'Amount' => $update_data['amount'],
                    'Remarks' => $update_data['remarks'],
                    'Details' => $update_data['details'],
                    'Image' => $update_data['image_name']
                );
            }
            else{
                $data=array(
                    'Heading' => $update_data['heading'],
                    'bill_invoice_no' => $update_data['bill_invoice_no'],
                    'responsible_person' => $update_data['responsible_person'],
                    'from_person' => $update_data['from'],
                    'Amount' => $update_data['amount'],
                    'Remarks' => $update_data['remarks'],
                    'Details' => $update_data['details'],
                );
            }
            $this->db->where('ID',$update_data['id']);
            $query = $this->db->update('tbl_income_data',$data);
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
            $query = $this->db->delete('tbl_income_data');
            $result_status = array('status' => 'success', 'message' =>"Successfully Deleted transaction");
            return $result_status;
        }
        catch(Exception $e){
            $result_status = array('status' => 'failed', 'message' => $e->getMessage());
            return $result_status;
        }
    }  
    public function update_status($id){
        try{
            $this->db->where('ID',$id);
        $data = array(
            'Status' => 1
        );
        $query = $this->db->update('tbl_income_data',$data);
        $result_status = array('status' => 'success', 'message' =>"Transaction Approved");
        return $result_status;
        }
        catch(Exception $e){
            $result_status = array('status' => 'failed', 'message' => $e->getMessage());
            return $result_status;
        }
    }
}