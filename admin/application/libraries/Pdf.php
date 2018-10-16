<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once APPPATH . '/third_party/mpdf/src/Mpdf.php';

class pdf {
    private $paramsLibrary = '"en-GB-x","A4","","",10,10,10,10,6,3';
    private $pdfLibrary;

    public function __construct() {
    }
    
    public function getParamsLibrary(){
        return $this->paramsLibrary;
    }
    
    public function setParamsLibrary($newParamsLibrary){
        $this->paramsLibrary = $newParamsLibrary;
        return true;
    }
    
    public function getPdfLibrary(){
        return $this->pdfLibrary;
    }
    
    public function setPdfLibrary(){
        $this->pdfLibrary = new \Mpdf\Mpdf($this->paramsLibrary);
        return true;
    }
}