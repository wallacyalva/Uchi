<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Empresa extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model('empresa_model', "empresaModel");
        $this->load->model('login_model', "loginModel");
        $this->load->model('Formulario_model', "formularioModel");
        $this->load->model('user_model', "usuarioModel");

    }
    
    public function index() {

        if($this->loginModel->isLoggedIn()) {

            $this->perfil();

        } else {

            redirect("login");

        }
    }
    
      public function perfil($emp_id = null) {



        if(!$this->session->userdata("is_user")) {

            $idempresa = $this->session->userdata("bs_user_id");
            $data = array();
            if($idempresa == $emp_id) {
                redirect(base_url("Empresa"));
            }
            if($emp_id){
                $data['emp'] = $this->usuarioModel->getUserCompleteData($idempresa);
                $data['usuario'] = $this->empresaModel->getEmpresaCompleteData($emp_id);
                $data['vagas'] = $this->empresaModel->getAllVagasByEmpresa($emp_id);
                $data['cases'] = $this->empresaModel->getAllCasesById($emp_id);
                $data['pedidos'] = $this->usuarioModel->getUserPedidos($idempresa);
                $data['notificacoes'] = $this->usuarioModel->getUserNotificacoes($idempresa);
                $data['mensagens'] = $this->usuarioModel->getUserMensagens($idempresa);
                $data['estadoAmizade'] = $this->usuarioModel->getUserEstadoAmizade($emp_id,$idempresa);                            
                $data['amizades'] = $this->usuarioModel->getAmizades($emp_id);
                $data['recomendacoes'] = $this->usuarioModel->getRecomendacoes($emp_id);




                $this->load->view('template/header_view', $data);
                $this->load->view('empresa/geral_perfil_empresa');
                $this->load->view('template/footer_view');
            }else{
                
                $data['user'] =  $this->empresaModel->getEmpresaCompleteData($idempresa);
                $data['emp'] = $data['empresa'] = $this->empresaModel->getEmpresaCompleteData($idempresa);
                $data['usuarios'] = $this->usuarioModel->getAllUsuarios();
                $data['vagas'] = $this->empresaModel->getAllVagasByEmpresa($idempresa);
                $data['cases'] = $this->empresaModel->getAllCasesById($idempresa);
                // $data['ramos'] = $this->empresaModel->getAllRamos();
                $data['ramos'] = $this->formularioModel->getAreas();
                $data['pedidos'] = $this->usuarioModel->getUserPedidos($idempresa);
                $data['notificacoes'] = $this->usuarioModel->getUserNotificacoes($idempresa);
                $data['mensagens'] = $this->usuarioModel->getUserMensagens($idempresa);
                
                $this->load->view('template/header_view', $data);
                $this->load->view('empresa/empresa_perfil_view');
                $this->load->view('template/footer_view');
            }
                
        } else {
            if($emp_id){
                
                $usuarioId = $this->session->userdata("bs_user_id");

                $data['user'] = $this->usuarioModel->getUserCompleteData($usuarioId);
                $data['usuario'] = $this->empresaModel->getEmpresaCompleteData($emp_id);
                $data['vagas'] = $this->empresaModel->getAllVagasByEmpresa($emp_id);
                $data['cases'] = $this->empresaModel->getAllCasesById($emp_id);
                $data['pedidos'] = $this->usuarioModel->getUserPedidos($usuarioId);
                $data['notificacoes'] = $this->usuarioModel->getUserNotificacoes($usuarioId);
                $data['mensagens'] = $this->usuarioModel->getUserMensagens($usuarioId);
                $data['estadoAmizade'] = $this->usuarioModel->getUserEstadoAmizade($emp_id,$usuarioId);                            
                $data['amizades'] = $this->usuarioModel->getAmizades($emp_id);
                $data['recomendacoes'] = $this->usuarioModel->getRecomendacoes($emp_id);




                $this->load->view('template/header_view', $data);
                $this->load->view('empresa/geral_perfil_empresa');
                $this->load->view('template/footer_view');


            }else{
                redirect("usuario");
            }

        }
    }
    public function getRankedUsers() {
        $pdata = array();
        $pdata = $this->input->post();
        $result = $this->formularioModel->getRankedUsers($pdata);
        $be_remove  = array();
        $j = -1;
        foreach ($result as $i => $pd) {
            if($pd->ranking == null){
                $j++;
                $be_remove[$j] = $i;
            }
        }
        foreach ($be_remove as $rem) {
            unset($result[$rem]);
        }
        
        echo json_encode($result);
        // echo json_encode($pdata);
    }

    public function editarInfo() {
        $sobre = $this->input->post("sobre");
        $criacao = $this->input->post("criacao");
        $local = $this->input->post("local");
        $phone = $this->input->post("phone");
        $contato = $this->input->post("contato");
        $site = $this->input->post("site");

        $empresaId = $this->session->userdata("bs_user_id");

        $result = $this->empresaModel->updateEmpresaData($sobre, $criacao, $local, $phone, $contato, $site, $empresaId);
        if($result){
            redirect("empresa");
        } else {
            echo $esult;
        }
    }

    public function deletarVaga($id_vaga) {
        if(!$this->session->userdata("is_user")) {

            $idempresa = $this->session->userdata("bs_user_id");
            $result = $this->empresaModel->deleteVaga($id_vaga, $idempresa);
            redirect(base_url()."empresa");

        } else  {

            redirect(base_url()."usuario");

        }
    }

    public function cadastrarVaga() {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('titulo', 'Título', 'required');
        $this->form_validation->set_rules('salario', 'Sálario', 'required');
        $this->form_validation->set_rules('local', 'Local', 'required');
        $this->form_validation->set_rules('area', 'Area', 'required');
        $this->form_validation->set_rules('descricao', 'Descrição', 'required');

        if($this->form_validation->run() == TRUE) {
            $post = $this->input->post();
            $empresaId = $this->session->userdata("bs_user_id");
            $result = $this->empresaModel->insertVaga($empresaId, $post);
            if($result) {
                redirect(base_url()."empresa");
            } else {
                echo "Um erro ocorreu:";
                print_r($result);
            }
        } else {
            redirect(base_url()."empresa");
        }
    }
    public function responderVaga($id_vaga,$id_empresa){
        $userId = $this->session->userdata("bs_user_id");
        $this->empresaModel->responderVaga($id_vaga,$userId,$id_empresa);
        redirect("usuario");
    }

    public function alterarVaga() {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('titulo', 'Título', 'required');
        $this->form_validation->set_rules('salario', 'Sálario', 'required');
        $this->form_validation->set_rules('local', 'Local', 'required');
        $this->form_validation->set_rules('area', 'Area', 'required');
        $this->form_validation->set_rules('descricao', 'Descrição', 'required');

        if($this->form_validation->run() == TRUE) {
            $post = $this->input->post();
            $empresaId = $this->session->userdata("bs_user_id");
            $result = $this->empresaModel->updateVaga($empresaId, $post);
            if($result) {
                redirect(base_url()."empresa");
            } else {
                echo "Um erro ocorreu:";
                print_r($result);
            }
        } else {
            redirect(base_url()."empresa");
        }
    }
    public function cadastrarCases() {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('titulo', 'Título', 'required');
        $this->form_validation->set_rules('texto', 'Texto', 'required');

        if($this->form_validation->run() == TRUE) {
            $post = $this->input->post();
            $usuarioId = $this->session->userdata("bs_user_id");
            $result = $this->empresaModel->insertCase($usuarioId, $post);
            if($result) {
                redirect(base_url()."empresa");
            } else {
                echo "Um erro ocorreu:";
                print_r($result);
            }
        } else {
            redirect(base_url()."empresa");
        }
    }

    public function recomendar($recomendado){
        $recomendando = $this->session->userdata("bs_user_id");
        $estrelas = $this->input->post("estrelas");
        $texto = $this->input->post("Recomendacao");
        $this->usuarioModel->recomendar($recomendando,$recomendado,$estrelas,$texto);
        redirect("empresa/perfil/".$recomendado);
    }


    public function enviarMensagem($de,$para){
        $mensagem = $this->input->post("mensagem");
        $this->usuarioModel->enviarSms($de,$para,$mensagem);
        redirect("empresa/perfil/".$para);
    }

    public function carregarMunicipios() {
        $post = $this->input->post();
        echo json_encode($this->formularioModel->Municipios($post["id_pai"]));
    }
}