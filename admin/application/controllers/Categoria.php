<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usuario_model', "usuarioModel");
        $this->load->model('categoria_model', "categoriaModel");
    }

    public function new(){
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();

        $userId = $this->session->userdata("bs_user_id");
        $user = $this->usuarioModel->getUserCompleteData($userId);

        $data = array();
       
  
        $data = $this->input->post();

        if ( $this->input->post()) {
            /**
             * Caso for marcado que é uma categoria
             */
            if($this->input->post("anId1")){
                $data["pai"]="0";
            }else{
                $data["pai"]=$this->input->post("categoriaPrincipal");
            }
            $this->form_validation->set_rules('categoria', 'Categoria', 'required|strip_tags');
        
            /**
             * Insere a categoria e retorna a id da caetegoria
             * em caso de sucesso na transação.
             */
             $returnInsert = $this->categoriaModel->insertCategoria($data);
            /**
             * Grava na variavel da sessiao a mensagem de erro ou exito
             */
            if($returnInsert){
                $this->session->set_flashdata("msg", array("tipo" => "1", "texto" => "<strong>Muito Bem!!!</strong> Categoria Cadastrado com sucesso." ));        
                redirect("categoria/new");
            }else{
                $this->session->set_flashdata("msg", array("tipo" => "2", "texto" => "<strong>Ops!!!</strong> Erro ao tentar CriarCategoria!" ));        
                redirect("categoria/new");
            }

        }
      

        $data['user'] = $user;
        $data['categorias'] = $this->categoriaModel->getAll();

        $this->load->view('template/header_view');
        $this->load->view('categoria/novo_categoria_view', $data);
        $this->load->view('template/footer_view');
    }
//END NEW

public function editar_categoria(){
    //check user logged in or not
    $this->usuarioModel->isLoggedIn();

    $userId = $this->session->userdata("bs_user_id");
    $user = $this->usuarioModel->getUserCompleteData($userId);
    $idCategoria = $this->uri->segment(3);

    $data = array();
   

    $data = $this->input->post();

    if ( $this->input->post()) {
        /**
         * Caso for marcado que é uma categoria
         */
        if($this->input->post("anId1") AND $this->input->post("categoriaPrincipal")==""){
            $data["pai"]="0";
        }else{
            $data["pai"]=$this->input->post("categoriaPrincipal");
        }
        $this->form_validation->set_rules('categoria', 'Categoria', 'required|strip_tags');
    
        /**
         * Insere a categoria e retorna a id da caetegoria
         * em caso de sucesso na transação.
         */
         $returnInsert = $this->categoriaModel->updateCategoria($idCategoria,$data);
        /**
         * Grava na variavel da sessiao a mensagem de erro ou exito
         */
        if($returnInsert){
            $this->session->set_flashdata("msg", array("tipo" => "1", "texto" => "<strong>Muito Bem!!!</strong> Categoria Cadastrado com sucesso." ));        
            redirect("categoria/editar_categoria/".$this->uri->segment(3)."");
        }else{
            $this->session->set_flashdata("msg", array("tipo" => "2", "texto" => "<strong>Ops!!!</strong> Erro ao tentar CriarCategoria!" ));        
            redirect("categoria/editar_categoria/".$this->uri->segment(3)."");
        }

    }
    
    $data['user'] = $user;
    $data['onecategoria'] = $this->categoriaModel->getOneCategoria($idCategoria);
    $data['categorias'] = $this->categoriaModel->getAll();


    $this->load->view('template/header_view');
    $this->load->view('categoria/editar_categoria_view', $data);
    $this->load->view('template/footer_view');
}

    public function categorias(){
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();

        $idUser = $this->session->userdata("bs_user_id");
        $user = $this->usuarioModel->getUserCompleteData($idUser);
       
        $data = array();

        if ($this->input->post('categoria_to_remove')){
            $idCategoria = $this->input->post('categoria_to_remove');
            $this->categoriaModel->deleteCategoria($idCategoria);
        }


        $data['user'] = $user;
        $data['categorias'] = $this->categoriaModel->getAll(1);

        $this->load->view('template/header_view');
        $this->load->view('categoria/categorias_view', $data);
        $this->load->view('template/footer_view');
    }

}