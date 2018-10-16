<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Classificado extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usuario_model', "usuarioModel");
        $this->load->model('classificado_model', "classificadoModel");
    }

    public function classificados($where){
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();

        $idUser = $this->session->userdata("bs_user_id");

        $data   = array();
        if ($this->input->post('classificado_to_block')){
            $idClassidicado = $this->input->post('classificado_to_block');
            $this->classificadoModel->updateBlockClassidicado($idClassidicado);
        }
        if ($this->input->post('classificado_to_remove')){
            $idClassidicado = $this->input->post('classificado_to_remove');
            $this->classificadoModel->removeClassidicado($idClassidicado);
        }

        if($where == "all"){
            $data['classificados']=$this->classificadoModel->getAllClassificados();
        } else {
            $data['classificados']=$this->classificadoModel->getAllClassificadoByCity(urldecode($where));
        }

        $userId = $this->session->userdata("bs_user_id");
        $user = $this->usuarioModel->getUserCompleteData($userId);
        $data['user'] = $user;
        
        $this->load->view('template/header_view');
        $this->load->view('classificado/classificados_view', $data);
        $this->load->view('template/footer_view');
    }

    public function clientes(){
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();

        $data = array();

        $userId = $this->session->userdata("bs_user_id");
        $user = $this->usuarioModel->getUserCompleteData($userId);
        $data['user'] = $user;
        $data['clientes'] = $this->classificadoModel->getAllClientesClassificados();
        
        $this->load->view('template/header_view');
        $this->load->view('classificado/clientes_classificados_view', $data);
        $this->load->view('template/footer_view');
    }

}