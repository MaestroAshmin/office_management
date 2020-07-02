<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once("./vendor/dompdf/dompdf/src/Autoloader.php");

use Dompdf\Dompdf;

class Pdfgenerator {

  public function generate($html, $filename='', $stream=TRUE, $paper = 'A4', $orientation = "portrait")
  {
    $dompdf = new DOMPDF();
    $dompdf->loadHtml($html);
    $dompdf->setPaper($paper, $orientation);
    $dompdf->set_option('defaultMediaType','all');
    $dompdf->set_option('isFontSubsettingEnabled', true);
    $dompdf->set_option('isRemoteEnabled',true);  

    $dompdf->render();
    if ($stream) {
        $dompdf->stream($filename.".pdf");
    } else {
        return $dompdf->output();
    }
  }
}