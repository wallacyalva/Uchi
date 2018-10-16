<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Formulario extends CI_Controller {

        public function __construct() {
           parent::__construct();
           $this->load->model('login_model', "loginModel");
           $this->load->model('Formulario_model', "formularioModel");
           $this->load->model('user_model', "usuarioModel");
        }
        
        public function educacional() {

            if($this->loginModel->isLoggedIn()) {
                $iduser = $this->session->userdata("bs_user_id");
                $data = array();
                $data['user'] = $data['usuario'] = $this->usuarioModel->getUserCompleteData($iduser);
                $data['formacoes'] = $this->formularioModel->getAllFormacoes();
                $data['idiomas'] = $this->formularioModel->getAllIdiomas();
                $data['informaticas'] = $this->formularioModel->getAllInformatica();
                $data['producoes'] = $this->formularioModel->getAllProducoes();
                $data['premiacoes'] = $this->formularioModel->getAllPremiacoes();
                $data['pedidos'] = $this->usuarioModel->getUserPedidos($iduser);
                $data['notificacoes'] = $this->usuarioModel->getUserNotificacoes($iduser);
                $data['mensagens'] = $this->usuarioModel->getUserMensagens($iduser);
                $this->load->view('template/header_view', $data);
                $this->load->view('template/usuario_top_info_view');
                $this->load->view('formularios/educacional_view');
                $this->load->view('template/footer_view');

            }
        }

        public function comportamental() {
            $iduser = $this->session->userdata("bs_user_id");
            $data = array();
            if($post_data = $this->input->post()) {
                $analitico = $criativo = $operacional = $relacional = 0;
                foreach($post_data as $item) {
                    switch ($item) {
                        case "C":
                            $analitico++;
                            break;
                        case "A":
                            $relacional++;
                            break;
                        case "O":
                            $operacional++;
                            break;
                        case "I":
                            $criativo++;
                            break;
                    }
                }
                $this->formularioModel->insertComputacional($iduser, $post_data);
                $this->usuarioModel->updateStats($iduser, $analitico, $criativo, $operacional, $relacional);
                redirect(base_url()."usuario");
            }
            $data['user'] = $data['usuario'] = $this->usuarioModel->getUserCompleteData($iduser);
            $data['pedidos'] = $this->usuarioModel->getUserPedidos($iduser);
            $data['notificacoes'] = $this->usuarioModel->getUserNotificacoes($iduser);
            $data['mensagens'] = $this->usuarioModel->getUserMensagens($iduser);
            $this->load->view('template/header_view', $data);
            $this->load->view('template/usuario_top_info_view');
            $this->load->view('formularios/comportamental_view');
            $this->load->view('template/footer_view');
        }

        public function profissional() {
            $iduser = $this->session->userdata("bs_user_id");
            $data = array();
            if($post_data = $this->input->post()) { 
                isset($post_data["viajar"])?$post_data["viajar"]=$post_data["viajar"] : $post_data["viajar"] = 3;
                isset($post_data["moradia"])?$post_data["moradia"]=$post_data["moradia"] : $post_data["moradia"] = 3;
                isset($post_data["vinculo"])?$post_data["vinculo"]=$post_data["vinculo"] : $post_data["vinculo"] = null;
                isset($post_data["atuacao"])?$post_data["atuacao"]=$post_data["atuacao"] : $post_data["atuacao"] = null;
                isset($post_data["internacional"])?$post_data["internacional"]=$post_data["internacional"] : $post_data["internacional"] = "nao";
                isset($post_data["sub_div"])?$post_data["sub_div"]=$post_data["sub_div"] : $post_data["sub_div"] = "nao";
                $this->formularioModel->insertProfissional($iduser, $post_data);
                redirect(base_url()."usuario");
            }
            $data['areas'] = $this->formularioModel->getAreas();
            $data['user'] = $data['usuario'] = $this->usuarioModel->getUserCompleteData($iduser);
            $data['pedidos'] = $this->usuarioModel->getUserPedidos($iduser);
            $data['notificacoes'] = $this->usuarioModel->getUserNotificacoes($iduser);
            $data['mensagens'] = $this->usuarioModel->getUserMensagens($iduser);
            $this->load->view('template/header_view', $data);
            $this->load->view('template/usuario_top_info_view');
            $this->load->view('formularios/profissional_view');
            $this->load->view('template/footer_view');
        }

        public function getSubAreas() {
            $post = $this->input->post();
            echo json_encode($this->formularioModel->subAreas($post["id_pai"]));
        }

        public function geral() {
            $iduser = $this->session->userdata("bs_user_id");
            $data = array();
            $post = $this->input->post();
            if(isset($post)){
                // FORMACAO
                if(isset($post["formacao_main_1"])) {
                    $formacao_array = array();
                    $while_keep = true;
                    $count = 1;
                    while($while_keep) {
                        $formacao_data = new \stdClass;
                        $formacao_data->main = $post["formacao_main_$count"];
                        if(isset($post["formacao_sub_$count"])) {
                            $formacao_data->sub = $post["formacao_sub_$count"];
                        } else {
                            $formacao_data->sub = 0;
                        }
                        $this->formularioModel->setFormacao($iduser, $formacao_data);
                        array_push($formacao_array, $formacao_data);
                        $count++;
                        if(!isset($post["formacao_main_$count"])){
                            $while_keep = false;
                        }  
                    }
                    $data["formacoes"] = $formacao_array;
                }
                // IDIOMA
                if(isset($post["idioma_main_1"])) {
                    $idioma_array = array();
                    $while_keep = true;
                    $count = 1;
                    while($while_keep) {
                        $idioma_data = new \stdClass;
                        $idioma_data->main = $post["idioma_main_$count"];
                        $idioma_data->le = $post["idioma_le_$count"];
                        $idioma_data->fala = $post["idioma_fala_$count"];
                        $idioma_data->escreve = $post["idioma_escreve_$count"];
                        $this->formularioModel->setIdioma($iduser, $idioma_data);
                        array_push($idioma_array, $idioma_data);
                        $count++;
                        if(!isset($post["idioma_main_$count"])){
                            $while_keep = false;
                        }  
                    }
                    $data["idiomas"] = $idioma_array;
                }
                // INFORMATICA
                if(isset($post["informatica_main_1"])) {
                    $informatica_array = array();
                    $while_keep = true;
                    $count = 1;
                    while($while_keep) {
                        $informatica_data = new \stdClass;
                        $informatica_data->main = $post["informatica_main_$count"];
                        if(isset($post["informatica_sub_$count"])) {
                            $informatica_data->sub = $post["informatica_sub_$count"];
                        } else {
                            $informatica_data->sub = 0;
                        }
                        $this->formularioModel->setInformatica($iduser, $informatica_data);
                        array_push($informatica_array, $informatica_data);
                        $count++;
                        if(!isset($post["informatica_main_$count"])){
                            $while_keep = false;
                        }  
                    }
                    $data["informaticas"] = $informatica_array;
                }
                // PRODUCAO
                if(isset($post["producao_main_1"])) {
                    $producao_array = array();
                    $while_keep = true;
                    $count = 1;
                    while($while_keep) {
                        $producao_data = new \stdClass;
                        $producao_data->main = $post["producao_main_$count"];
                        if(isset($post["producao_sub_$count"])) {
                            $producao_data->sub = $post["producao_sub_$count"];
                        } else {
                            $producao_data->sub = "0";
                        }
                        $this->formularioModel->setProducao($iduser, $producao_data);
                        array_push($producao_array, $producao_data);
                        $count++;
                        if(!isset($post["producao_main_$count"])){
                            $while_keep = false;
                        }  
                    }
                    $data["producoes"] = $producao_array;
                }
                // PREMIACAO
                if(isset($post["premiacao_main_1"])) {
                    $premiacao_array = array();
                    $while_keep = true;
                    $count = 1;
                    while($while_keep) {
                        $premiacao_data = new \stdClass;
                        $premiacao_data->main = $post["premiacao_main_$count"];
                        if(isset($post["premiacao_sub_$count"])) {
                            $premiacao_data->sub = $post["premiacao_sub_$count"];
                        } else {
                            $premiacao_data->sub = 0;
                        }
                        $this->formularioModel->setPremiacao($iduser, $premiacao_data);
                        array_push($premiacao_array, $premiacao_data);
                        $count++;
                        if(!isset($post["premiacao_main_$count"])){
                            $while_keep = false;
                        }  
                    }
                    $data["premiacoes"] = $premiacao_array;
                }
            }
            redirect(base_url()."usuario");
        }

        public function subInformatica() {
            echo json_encode($this->formularioModel->getSubInformatica($this->input->post("id_pai")));
        }
        public function subPremiacao() {
            echo json_encode($this->formularioModel->getSubPremiacoes($this->input->post("id_pai")));
        }

        public function getQuestionario() {

                $idArea = $this->input->post("id_pai");
                $data = array();

                $data['formulario'] = $this->formularioModel->getFormularioByIdArea($idArea);
                
                $data['questoes'] = $this->formularioModel->getQuestoesByFormularioId($data['formulario']->id);
                $return["html"] = $this->load->view('formularios/formulario_view', $data, true);
                echo json_encode($return);
        }

}