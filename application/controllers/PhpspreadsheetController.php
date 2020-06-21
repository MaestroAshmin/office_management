<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class PhpspreadsheetController extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('import');
    }
    public function index(){
        $this->load->view('spreadsheet');   
    }
    public function export(){
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');
        $writer = new Xlsx($spreadsheet);
        $filename = 'name-of-the-generated-file';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output'); // download file
    }
    public function import(){
        if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}
		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
        $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        if(isset($_FILES['upload_file']['name']) && in_array($_FILES['upload_file']['type'], $file_mimes)) {
            $arr_file = explode('.', $_FILES['upload_file']['name']);
            $extension = end($arr_file);
            if('csv' == $extension){
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            $insertData=[];
            for($i=4;$i<count($sheetData);$i++){
                if($sheetData[$i][0]== '' || empty($sheetData[$i][0])){
                    continue;
                }
                else{
                    $insertData[] = $sheetData[$i];
                }
            }

            $result = $this->import->save_to_db($insertData,$user_id);
            if($result['status'] == 'success'){
				redirect('user', 'refresh');
			}
			if($result['status'] == 'failed'){
				redirect('user', 'refresh');
			}
        }
    }
}