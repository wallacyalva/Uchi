<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();
  
    }

    public function index($indica = false) {
        // if (is_user_logged_in()) {
        //     redirect("account");
        // }
        
        $this->load->view('cliente/cadastro_empresa_view');
        
        
    }

}
