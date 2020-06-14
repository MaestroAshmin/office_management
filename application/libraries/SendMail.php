<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SendMail{

    public function sendEmail($toEmail, $subject, $message){
      
        $CI = & get_instance();
        $CI->load->library('email');
        $CI->email->initialize(array(
          'mailtype' => 'html',
          'protocol' => 'smtp',
          'smtp_host' => 'smtp.sendgrid.net',
          'smtp_user' => 'santoshneupane',
          'smtp_pass' => 'nepal123#',
          'smtp_port' => 587,
          'crlf' => "\r\n",
          'newline' => "\r\n"
      ));
    
      $CI->email->from('noreply@unicom.net.np', 'Unified Communications');
      $CI->email->to($toEmail);
      $CI->email->subject($subject);
      $CI->email->message($message);
      $CI->email->send();
    }
}
