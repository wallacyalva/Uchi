<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Formulario extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("usuario_model", "usuarioModel");
        $this->load->model("formulario_model", "formularioModel");
    }

    public function criarFormulario() {
        $this->usuarioModel->isLoggedIn();
        $data = array();
        if($input = $this->input->post()) {
            $obj = new \stdClass();
            $obj->nome = $input["titulo"];

            $camposCount = $input["meuIndice"];
            $camposFinalCount = 0;
            for($i = 1; $i <= $camposCount; $i++) {
                if(isset($input["campo_indice_$i"])) {
                    $camposFinalCount++;
                    $campo = new \stdClass();
                    $campo->titulo = $input["campo_titulo_$i"];
                    $campo->tipo = $input["campo_select_$i"];
                    $campo->opcoes = $input["campo_opcoes_$i"];
                    $campo->analitico = $input["campo_analitico_$i"];
                    $campo->criativo = $input["campo_criativo_$i"];
                    $campo->operacional = $input["campo_operacional_$i"];
                    $campo->relacional = $input["campo_relacional_$i"];
                    $campo->indice = $camposFinalCount;
                    $obj->campos[$i] = $campo;
                }
            }
            $obj->questoes = $camposFinalCount;
            $result = $this->formularioModel->insertForm($obj);

            redirect(base_url()."formulario/listarFormulario", "location");
        }
        $data['user'] = $this->usuarioModel->getUserCompleteData($this->session->userdata("bs_user_id"));

        $this->load->view('template/header_view');
        $this->load->view('formulario/criar_formulario_view', $data);
        $this->load->view('template/footer_view');
    }

    public function criarFormulario2() {
        $data = array();
        if($input = $this->input->post()) {
            $obj = new \stdClass();
            $obj->nome = $input["titulo"];

            $camposCount = $input["meuIndice"];
            $camposFinalCount = 0;
            for($i = 1; $i <= $camposCount; $i++) {
                if(isset($input["campo_indice_$i"])) {
                    $camposFinalCount++;
                    $campo = new \stdClass();
                    $campo->titulo = $input["campo_titulo_$i"];
                    $campo->tipo = $input["campo_select_$i"];
                    $campo->opcoes = $input["campo_opcoes_$i"];
                    $campo->analitico = $input["campo_analitico_$i"];
                    $campo->criativo = $input["campo_criativo_$i"];
                    $campo->operacional = $input["campo_operacional_$i"];
                    $campo->relacional = $input["campo_relacional_$i"];
                    $campo->indice = $camposFinalCount;
                    $obj->campos[$i] = $campo;
                }
            }
            $obj->questoes = $camposFinalCount;
            $result = $this->formularioModel->insertForm($obj);
        }
    }

    public function listarFormulario() {
        $this->usuarioModel->isLoggedIn();
        $data = array();

        $data['user'] = $this->usuarioModel->getUserCompleteData($this->session->userdata("bs_user_id"));
        $data['formularios'] = $this->formularioModel->getAllForms();

        $this->load->view('template/header_view');
        $this->load->view('formulario/listar_formulario_view', $data);
        $this->load->view('template/footer_view');
    }

}