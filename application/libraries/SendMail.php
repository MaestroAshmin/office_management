<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SendMail{

    public function sendEmail($toEmail, $subject, $message){
      
        $CI = & get_instance();
        $CI->load->library('email');
        $CI->email->initialize(array(
          'mailtype' => 'html',
          'protocol' => 'smtp',
          'smtp_host' => 'smtp-relay.sendinblue.com',
          'smtp_user' => 'info@buskoticket.com',
          'smtp_pass' => 'WNbzFAp6xhrk1tXD',
          'smtp_port' => 587,
          'crlf' => "\r\n",
          'newline' => "\r\n"
      ));
      $CI->email->set_mailtype("html");
      $CI->email->set_newline("\r\n");
    
      $CI->email->from('noreply@unicom.net.np', 'Bonjour Management Pvt. Ltd.');
      $CI->email->to($toEmail);
      $CI->email->subject($subject);
      $CI->email->message($message);
      $CI->email->send();
    }
}
