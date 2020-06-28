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

        return $result_status;
    }

    public function is_exists($data,$id=0){
        if($data['current_fy']=='1'){
            $query  =   $this->db->select('*')->from('tbl_fiscal_year')->where("current_fy=1 and id!=".$id)->get();
            
            if($query->num_rows() > 0 ){
                return true;
            }
        }

        $query2  =   $this->db->select('*')->from('tbl_fiscal_year')->where("fiscal_year=".$data['fiscal_year']." and id!=".$id)->get();
        if($query2->num_rows() > 0 ){
            return true;
        }
        else{
            return false;
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
    public function get_fiscal_year($id){
        $query = $this->db->select('*')->from('tbl_fiscal_year')->where('id',$id)->get();
        if($query){
            $result = $query->row_array();
            return $result;
        }
        else{
            return $false;
        }
    }

    public function edit_fiscal_year($data){
        $is_exists = $this->tax_model->is_exists($data,$data['id']);
        if(!$is_exists){
            try{
                $this->db->where('id',$data['id']);
                $query = $this->db->update('tbl_fiscal_year',$data);
                $result_status = array('status' => 'success', 'message' =>"Successfully added Fiscal Year");    
            }
            catch(Exception $e){
                $result_status = array('status'=> 'failed', 'message' => 'Fail to update Fiscal Year');
            }
        }
        else{
            $result_status = array('status'=> 'failed', 'message' => 'Fiscal Year Already Exists or Cannot have two active Fiscal Year at once');
        }
        return $result_status;
    }

    public function delete_fiscal_year($id)
    {
        try{
            $this->db->where('id', $id);
            $this->db->delete('tbl_fiscal_year');
            $result_status = array('status'=>'success','message'=>'Fiscal Year Deleted Successfully');

        }
        catch(Exception $e){
            $result_status = array('status'=>'falied','message'=>'Cannot Delete Fiscal Year');
        }
        return $result_status;
    }
    public function add_tax_structure($data)
    {  
        try{
            $insertData = [];
            for($i=0;$i<count($data['tax']);$i++){
                array_push($insertData[$i],'tax', $data['tax'][$i]);
                array_push($insertData[$i],'marital_status', $data['marital_status'][$i]);
                array_push($insertData[$i],'amount', $data['amount'][$i]);
            }
            echo '<pre>';print_r($insertData);exit;
        }
        catch(Exception $e){
            $result_status = array('status'=> 'failed','message' => 'Cannot Add Tax Structure');
        }
        return $result_status;
    }
}   