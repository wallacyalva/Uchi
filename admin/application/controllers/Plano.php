<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Plano extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usuario_model', "usuarioModel");
        $this->load->model('plano_model', "planoModel");
    }

    public function new(){
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();

        $userId = $this->session->userdata("bs_user_id");
        $user = $this->usuarioModel->getUserCompleteData($userId);

        $data = array();
       
  
        $data = $this->input->post();

        if ( $this->input->post()) {

            $this->form_validation->set_rules('plano', 'plano', 'required|strip_tags');
        
            /**
             * Insere a categoria e retorna a id da caetegoria
             * em caso de sucesso na transação.
             */
             $returnInsert = $this->planoModel->insertPlano($data);
            /**
             * Grava na variavel da sessiao a mensagem de erro ou exito
             */
            if($returnInsert){
                $this->session->set_flashdata("msg", array("tipo" => "1", "texto" => "<strong>Muito Bem!!!</strong> Dados inseridos com sucesso." ));        
                redirect("plano/new");
            }else{
                $this->session->set_flashdata("msg", array("tipo" => "2", "texto" => "<strong>Ops!!!</strong> Erro ao tentar Inserir Dados!" ));        
                redirect("plano/new");
            }

        }
      
        $data['user'] = $user;

        $this->load->view('template/header_view');
        $this->load->view('plano/novo_plano_view', $data);
        $this->load->view('template/footer_view');
    }
//END NEW

public function editar(){
    //check user logged in or not
    $this->usuarioModel->isLoggedIn();

    $userId = $this->session->userdata("bs_user_id");
    $user = $this->usuarioModel->getUserCompleteData($userId);
    $idPlano = $this->uri->segment(3);

    $data = array();
   

    $data = $this->input->post();

    if ( $this->input->post()) {
 
        $this->form_validation->set_rules('plano', 'Plano', 'required|strip_tags');
    
        /**
         * Insere a categoria e retorna a id da caetegoria
         * em caso de sucesso na transação.
         */
         $returnInsert = $this->planoModel->updatePlano($idPlano,$data);
        /**
         * Grava na variavel da sessiao a mensagem de erro ou exito
         */
        if($returnInsert){
            $this->session->set_flashdata("msg", array("tipo" => "1", "texto" => "<strong>Muito Bem!!!</strong> Dados atualizado com sucesso." ));        
            redirect("plano/editar/".$this->uri->segment(3)."");
        }else{
            $this->session->set_flashdata("msg", array("tipo" => "2", "texto" => "<strong>Ops!!!</strong> Erro ao tentar editar dados!" ));        
            redirect("plano/editar/".$this->uri->segment(3)."");
        }

    }
    
    $data['user'] = $user;
    $data['oneplano'] = $this->planoModel->getOnePlano($idPlano);
    $data['planos'] = $this->planoModel->getAll();


    $this->load->view('template/header_view');
    $this->load->view('plano/editar_plano_view', $data);
    $this->load->view('template/footer_view');
}

    public function planos(){
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();

        $idUser = $this->session->userdata("bs_user_id");
        $user = $this->usuarioModel->getUserCompleteData($idUser);
       
        $data = array();

        if ($this->input->post('plano_to_remove')){
            $idplano = $this->input->post('plano_to_remove');
            $this->planoModel->deletePlano($idplano);
        }


        $data['user'] = $user;
        $data['planos'] = $this->planoModel->getAll(1);

        $this->load->view('template/header_view');
        $this->load->view('plano/planos_view', $data);
        $this->load->view('template/footer_view');
    }

}