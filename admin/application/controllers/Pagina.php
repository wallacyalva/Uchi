<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pagina extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usuario_model', "usuarioModel");
        $this->load->model('cliente_model', "clienteModel");
        $this->load->model('pagina_model', "paginaModel");
    }

    public function new(){
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();

        $userId = $this->session->userdata("bs_user_id");
        $user = $this->usuarioModel->getUserCompleteData($userId);

        $data = array();
       
        $data = $this->input->post();

        if ($this->input->post()) {

            $this->form_validation->set_rules('titulo', 'Titulo', 'required|strip_tags');

            $errors = false;
           
                // $codigoPromocao = $this->promocaoModel->insertPromocao($data);
                $codigoPagina = $this->paginaModel->insertPagina($data);

                if($codigoPagina){
                    $this->session->set_flashdata("msg", array("tipo" => "1", "texto" => "<strong>Muito Bem!!!</strong> Pagina inserida com sucesso." ));        
                    redirect("pagina/new");
                }else{
                    $this->session->set_flashdata("msg", array("tipo" => "2", "texto" => "<strong>Ops!!!</strong> Erro ao tentar inserir pagina!" ));        
                    redirect("pagina/new");
                }
        
        }
        $data['user'] = $user;

        $this->load->view('template/header_view');
        $this->load->view('pagina/nova_pagina_view', $data);
        $this->load->view('template/footer_view');
    }
    public function editar(){
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();

        $idUser = $this->session->userdata("bs_user_id");
        $idPagina = $this->uri->segment(3);
        
        $postArray = $this->input->post();
        $data = array();

        if ($this->input->post()) {
            
            $this->form_validation->set_rules('titulo', 'Titulo', 'required|strip_tags');
           
            if ($this->form_validation->run() != FALSE) {
                  $this->paginaModel->updatePagina($idPagina, $postArray);
                  $this->session->set_flashdata("msg", array("tipo" => "1", "texto" => "<strong>Muito Bem!!!</strong> Pagina atualizada com sucesso." ));        
                  redirect("pagina/editar/".$this->uri->segment(3));
            }
        }

        $data['pagina']=$this->paginaModel->getPagina($idPagina);

        $userId = $this->session->userdata("bs_user_id");
        $user = $this->usuarioModel->getUserCompleteData($userId);
        $data['user'] = $user;
        
        $this->load->view('template/header_view');
        $this->load->view('pagina/editar_pagina_view', $data);
        $this->load->view('template/footer_view');
    }

    public function paginas(){
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();
        $idUser = $this->session->userdata("bs_user_id");
        $data   = array();

        if ($this->input->post('pagina_to_remove')){
            $idpagina = $this->input->post('pagina_to_remove');
            $this->paginaModel->deletePagina($idpagina);
        }

        $data['paginas']=$this->paginaModel->getPagina();

        $userId = $this->session->userdata("bs_user_id");
        $user = $this->usuarioModel->getUserCompleteData($userId);
        $data['user'] = $user;
        
        $this->load->view('template/header_view');
        $this->load->view('pagina/minhas_paginas_view', $data);
        $this->load->view('template/footer_view');
    }
}