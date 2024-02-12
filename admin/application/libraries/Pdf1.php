<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

use Dompdf\DOMPDF;
require_once(dirname(__FILE__) . '/dompdf1/autoload.inc.php');
class pdf1  {

    // public function __construct(){
    //     parent::__construct();
    // }

    function createPDF($html, $filename='', $download=TRUE, $paper='A4', $orientation='portrait'){
        $dompdf = new DOMPDF();
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        if($download)
            $dompdf->stream($filename.'.pdf', array('Attachment' => 1));
        else
            $dompdf->stream($filename.'.pdf', array('Attachment' => 0));
    }


}