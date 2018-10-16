<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Empreendedor extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usuario_model', "usuarioModel");
    }

    public function index(){
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();
        $this->load->view('empreendedor/dashboard_view');
    }
}