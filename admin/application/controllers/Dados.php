<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dados extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usuario_model', "usuarioModel");
        $this->load->model('dados_model', "dadosModel");
    }

    // AREAS //
    public function areas() {
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();
        $data = array();
        $data['user'] = $this->usuarioModel->getUserCompleteData($this->session->userdata("bs_user_id"));
        $data['areas'] = $this->dadosModel->getAllAreas();
        $this->load->view('template/header_view');
        $this->load->view('dados/areas_view', $data);
        $this->load->view('template/footer_view');
    }
    public function deletarArea() {
        if($post = $this->input->post()) {
            return $this->dadosModel->deleteArea($post["id"]);
        } else {
            return false;
        }
    }
    public function inserirArea() {
        if($post = $this->input->post()) {
            $this->dadosModel->insertArea($post["nome"]);
            redirect(base_url()."dados/areas");
        } else {
            return false;
        }
    }
    public function alterarArea() {
        if($post = $this->input->post()) {
            $this->dadosModel->updatedArea($post["nome_modal"], $post["id_modal"]);
            redirect(base_url()."dados/areas");
        } else {
            return false;
        }
    }

    // IDIOMAS //
    public function idiomas() {
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();
        $data = array();
        $data['user'] = $this->usuarioModel->getUserCompleteData($this->session->userdata("bs_user_id"));
        $data['idiomas'] = $this->dadosModel->getAllIdiomas();
        $this->load->view('template/header_view');
        $this->load->view('dados/idiomas_view', $data);
        $this->load->view('template/footer_view');
    }
    public function deletarIdioma() {
        if($post = $this->input->post()) {
            return $this->dadosModel->deleteIdioma($post["id"]);
        } else {
            return false;
        }
    }
    public function inserirIdioma() {
        if($post = $this->input->post()) {
            $this->dadosModel->insertIdioma($post["nome"]);
            redirect(base_url()."dados/idiomas");
        } else {
            return false;
        }
    }
    public function alterarIdioma() {
        if($post = $this->input->post()) {
            $this->dadosModel->updatedIdioma($post["nome_modal"], $post["id_modal"]);
            redirect(base_url()."dados/idiomas");
        } else {
            return false;
        }
    }

    // FORMACOES //
    public function formacoes() {
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();
        $data = array();
        $data['user'] = $this->usuarioModel->getUserCompleteData($this->session->userdata("bs_user_id"));
        $data['formacoes'] = $this->dadosModel->getAllFormacoes();
        $this->load->view('template/header_view');
        $this->load->view('dados/formacoes_view', $data);
        $this->load->view('template/footer_view');
    }
    public function deletarFormacao() {
        if($post = $this->input->post()) {
            return $this->dadosModel->deleteFormacao($post["id"]);
        } else {
            return false;
        }
    }
    public function inserirFormacao() {
        if($post = $this->input->post()) {
            $this->dadosModel->insertFormacao($post["nome"]);
            redirect(base_url()."dados/formacoes");
        } else {
            return false;
        }
    }
    public function alterarFormacao() {
        if($post = $this->input->post()) {
            $this->dadosModel->updatedFormacao($post["nome_modal"], $post["id_modal"]);
            redirect(base_url()."dados/formacoes");
        } else {
            return false;
        }
    }

    // BIBLIOGRAFIAS //
    public function bibliografias() {
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();
        $data = array();
        $data['user'] = $this->usuarioModel->getUserCompleteData($this->session->userdata("bs_user_id"));
        $data['bibliografias'] = $this->dadosModel->getAllBibliografia();
        $this->load->view('template/header_view');
        $this->load->view('dados/bibliografias_view', $data);
        $this->load->view('template/footer_view');
    }
    public function deletarBibliografia() {
        if($post = $this->input->post()) {
            return $this->dadosModel->deleteBibliografia($post["id"]);
        } else {
            return false;
        }
    }
    public function inserirBibliografia() {
        if($post = $this->input->post()) {
            $this->dadosModel->insertBibliografia($post["nome"]);
            redirect(base_url()."dados/bibliografias");
        } else {
            return false;
        }
    }
    public function alterarBibliografia() {
        if($post = $this->input->post()) {
            $this->dadosModel->updatedBibliografia($post["nome_modal"], $post["id_modal"]);
            redirect(base_url()."dados/bibliografias");
        } else {
            return false;
        }
    }

    // PROFISSOES //
    public function profissoes() {
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();
        $data = array();
        $data['user'] = $this->usuarioModel->getUserCompleteData($this->session->userdata("bs_user_id"));
        $data['profissoes'] = $this->dadosModel->getAllProfissoes();
        $this->load->view('template/header_view');
        $this->load->view('dados/profissoes_view', $data);
        $this->load->view('template/footer_view');
    }
    public function deletarProfissao() {
        if($post = $this->input->post()) {
            return $this->dadosModel->deleteProfissao($post["id"]);
        } else {
            return false;
        }
    }
    public function inserirProfissao() {
        if($post = $this->input->post()) {
            $this->dadosModel->insertProfissao($post["nome"], $post["pai"]);
            redirect(base_url()."dados/profissoes");
        } else {
            return false;
        }
    }
    public function alterarProfissao() {
        if($post = $this->input->post()) {
            $this->dadosModel->updatedProfissao($post["nome_modal"], $post["pai_modal"], $post["id_modal"]);
            redirect(base_url()."dados/profissoes");
        } else {
            return false;
        }
    }

    // INFOMARTICA //
    public function informatica() {
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();
        $data = array();
        $data['user'] = $this->usuarioModel->getUserCompleteData($this->session->userdata("bs_user_id"));
        $data['informaticas'] = $this->dadosModel->getAllInformaticas();
        $this->load->view('template/header_view');
        $this->load->view('dados/informaticas_view', $data);
        $this->load->view('template/footer_view');
    }
    public function deletarInformatica() {
        if($post = $this->input->post()) {
            return $this->dadosModel->deleteInformatica($post["id"]);
        } else {
            return false;
        }
    }
    public function insertInformatica() {
        if($post = $this->input->post()) {
            $this->dadosModel->insertInformatica($post["nome"], $post["pai"]);
            redirect(base_url()."dados/informatica");
        } else {
            return false;
        }
    }
    public function alterarInformatica() {
        if($post = $this->input->post()) {
            $this->dadosModel->updatedInformatica($post["nome_modal"], $post["pai_modal"], $post["id_modal"]);
            redirect(base_url()."dados/informatica");
        } else {
            return false;
        }
    }

    // PREMIACAO //
    public function premiacao() {
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();
        $data = array();
        $data['user'] = $this->usuarioModel->getUserCompleteData($this->session->userdata("bs_user_id"));
        $data['premiacoes'] = $this->dadosModel->getAllPremiacoes();
        $this->load->view('template/header_view');
        $this->load->view('dados/premiacoes_view', $data);
        $this->load->view('template/footer_view');
    }
    public function deletarPremiacao() {
        if($post = $this->input->post()) {
            return $this->dadosModel->deletePremiacao($post["id"]);
        } else {
            return false;
        }
    }
    public function insertPremiacao() {
        if($post = $this->input->post()) {
            $this->dadosModel->insertPremiacao($post["nome"], $post["pai"]);
            redirect(base_url()."dados/premiacao");
        } else {
            return false;
        }
    }
    public function alterarPremiacao() {
        if($post = $this->input->post()) {
            $this->dadosModel->updatedPremiacao($post["nome_modal"], $post["pai_modal"], $post["id_modal"]);
            redirect(base_url()."dados/premiacao");
        } else {
            return false;
        }
    }
}