<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('usuario_model', "usuarioModel");
        $this->load->model('empresa_model', "empresaModel");
        $this->load->model('ramos_model', "ramosModel");
    }

    public function deletar() {
        echo json_encode($this->empresaModel->deletarEmpresa($this->input->post("cliente_to_remove")));
    }

    public function listar() {
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();
        $data = array();
        $data['user'] = $this->usuarioModel->getUserCompleteData($this->session->userdata("bs_user_id"));
        $data['usuarios'] = $this->empresaModel->getAllEmpresas();
        $this->load->view('template/header_view');
        $this->load->view('empresa/listar_empresas_view', $data);
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
                $this->empresaModel->updateEmpresa($input);     
                redirect(base_url()."empresa/listar");
            }
        }
        $data['usuario'] = $this->empresaModel->getEmpresaCompleteData($id_usuario);
        $data['ramos'] = $this->ramosModel->getAllRamos();
        $this->load->view('template/header_view');
        $this->load->view('empresa/editar_empresa_view', $data);
        $this->load->view('template/footer_view');
    }

}