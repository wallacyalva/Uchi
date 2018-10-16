<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Administrador extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('usuario_model', "usuarioModel");
        $this->load->model('administrador_model', "administradorModel");
        $this->load->model('ramos_model', "ramosModel");
    }

    public function deletar() {
        echo json_encode($this->administradorModel->deletarAdministrador($this->input->post("cliente_to_remove")));
    }

    public function listar() {
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();
        $data = array();
        $data['user'] = $this->usuarioModel->getUserCompleteData($this->session->userdata("bs_user_id"));
        $data['usuarios'] = $this->administradorModel->getAlladministradors();
        $this->load->view('template/header_view');
        $this->load->view('administrador/listar_administradores_view', $data);
        $this->load->view('template/footer_view');
    }

    public function editar($id_usuario = null) {
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();
        $data = array();
        $data['user'] = $this->usuarioModel->getUserCompleteData($this->session->userdata("bs_user_id"));

        if($input = $this->input->post()) {
            $this->form_validation->set_rules('name', "Nome", 'max_length[100]');
            $this->form_validation->set_rules('cnpj', "CNPJ", 'max_length[50]');
            $this->form_validation->set_rules('email', "Email", 'max_length[250]');
            $this->form_validation->set_rules('ramo', "Ramo", 'max_length[100]');
            $this->form_validation->set_rules('new_password', 'Nova Senha', 'trim|strip_tags|min_length[6]|max_length[50]|matches[confirm_new_password]');
            $this->form_validation->set_rules('confirm_new_password', 'Nova Senha', 'trim|strip_tags');

            if ($this->form_validation->run() != FALSE) {
                $this->administradorModel->updateAdministrador($input);     
                redirect(base_url()."administrador/listar");
            }
        }
        $data['usuario'] = $this->administradorModel->getadministradorCompleteData($id_usuario);
        $data['ramos'] = $this->ramosModel->getAllRamos();
        $this->load->view('template/header_view');
        $this->load->view('administrador/editar_administrador_view', $data);
        $this->load->view('template/footer_view');
    }

}