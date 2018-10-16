<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Financeiro extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Carregando model
        $this->load->model('financeiro_model', 'financeiroModel');
        $this->load->model('usuario_model', "usuarioModel");
        
    }

    public function index() {
        if (!is_user_logged_in()) {
            //usuario nao esta logado, redireciona para login
            redirect("login");
        }
        $data = array();
        $idUser = $this->session->userdata("bs_user_id");

     /**
      * 
      * Falta criar $data["mensalidades"] = $this->financeiroModel->getMensalidades($idCliente);
      * 
      * 
      */

      $user = $this->usuarioModel->getUserCompleteData($idUser);
      $data['user'] = $user;
      $this->load->view('template/header_view');
      $this->load->view('cliente/mensalidades_view', $data);
      $this->load->view('template/footer_view');
  }

  public function saques() {
      if (!is_user_logged_in()) {
          //usuario nao esta logado, redireciona para login
          redirect("login");
      }
      $data = array();
      $usuarioId = $this->session->userdata("bs_user_id");
      $data["saldoDisponivel"] = $this->financeiroModel->getSaldoUsuario($usuarioId)->disponivel;
      $data["saques"] = $this->financeiroModel->getSaques($usuarioId);
      $this->load->view('header_view');
      $this->load->view('financeiro/saques_view', $data);
      $this->load->view('footer_view');
  }
  
  public function recebimentos() {
      if (!is_user_logged_in()) {
          //usuario nao esta logado, redireciona para login
          redirect("login");
      }
      $data = array();
      $usuarioId = $this->session->userdata("bs_user_id");
      $data["saldoDisponivel"] = $this->financeiroModel->getSaldoUsuario($usuarioId)->disponivel;
      $data["recebimentos"] = $this->financeiroModel->getRecebimentos($usuarioId, 5);
      $this->load->view('header_view');
      $this->load->view('financeiro/recebimentos_view', $data);
      $this->load->view('footer_view');
  }

  public function sacar() {
      if (!is_user_logged_in()) {
          //usuario nao esta logado, redireciona para login
          redirect("login");
      }
      $data = array();
      $usuarioId = $this->session->userdata("bs_user_id");
      $data["saldoDisponivel"] = $this->financeiroModel->getSaldoUsuario($usuarioId)->disponivel;
      $data["saqueLiberado"] = true;
      $this->load->view('header_view');
      $this->load->view('financeiro/sacar_view', $data);
      $this->load->view('footer_view');
  }

  public function solicitar_saque() {
      $result = array();
      if (!is_user_logged_in()) {
          $result["error"] = "Você deve fazer login.";
          echo json_encode($result);
          die();
      }
      $this->form_validation->set_rules('saque', 'Valor de saque', 'trim|strip_tags|required');
      if ($this->form_validation->run() !== FALSE) {
          $valorSaque = getNumericValueOfString(getNumericValueOfString(str_replace(array("R$", "R$ "), "", $this->input->post("saque"))));
          $userId = $this->session->userdata("bs_user_id");
          $saldoDisponivel = $this->financeiroModel->getSaldoUsuario($userId)->disponivel;
          //verifica se o usuario tem saldo suficiente
          if ($saldoDisponivel >= $valorSaque) {
              //inicia transacao
              $this->db->trans_start();
              //atualiza saldo disponivel(-valor) e coloca valor bloqueado
              $this->financeiroModel->subtrairSaldoDisponivelAddBloqueado($userId, $valorSaque);
              //completa transaction
              $this->db->trans_complete();
              if ($this->db->trans_status() === FALSE) {
                  //operacao mal sucedida
                  $result["error"] = "A operação não pôde ser concluída. Por favor, tente novamente.";
              } else {
                  //operacao bem sucedida
                  $result["success"] = "<div>Operação de saque realizada com sucesso.</div><div>Seu saque será analisado e liberado assim que concluído.</div>";
                  $result["novoSaldo"] = number_format($saldoDisponivel - $valorSaque, 2, ',', ' ');
              }
          } else {
              $result["error"] = "Você não tem saldo suficiente para realizar esta operação.";
          }
      } else {
          //erros de validacao
          $error = '';
          foreach ($_POST as $key => $field) {
              if (form_error($key)) {
                  $error .= "<div>" . strip_tags(form_error($key)) . "</div>";
              }
          }
          $result["error"] = $error;
      }
      echo json_encode($result);
  }

public function allMounth($idUser = null){
    $this->usuarioModel->isLoggedIn();
    $userId = $this->session->userdata("bs_user_id");

    if(!$idUser){
        $idUser = $userId;
    } 
    
    $user = $this->usuarioModel->getUserCompleteData($userId);

    // ALGORITIMO //

    $dados = array();
    $dados = $this->financeiroModel->getClientesMounthlData($idUser);

    foreach($dados as $dado){
        $dataAtual = date("Y/m/d");
        $dataAtual = new DateTime($dataAtual);

        $dataComeco = $dado->data;
        $dataComeco = new DateTime($dataComeco);

        $dataUltimoPagamento = $dado->ultimo_pagamento;
        $dataUltimoPagamento = new DateTime($dataUltimoPagamento);

        $parcelasPagas = $dado->parcelas_pagas;

        $diaAtual = date("d");
        
        $diaVencimento = $dado->dia_vencimento;

        $diferencaDoComeco = date_diff($dataComeco,$dataAtual);

        $meses = floor($diferencaDoComeco->days / 30);

        $numeroProximaParcela = $meses + 1;
    
        $proximoVencimento = $dataComeco->modify("+".($numeroProximaParcela*30)." days");
        $dado->proximo_vencimento = $proximoVencimento;
        
        if($parcelasPagas >= $meses){
            $dado->status_pagamentos = true;
            $dado->meses_atrasados = "-";
        } else {
            $dado->status_pagamentos = false;
            $dado->meses_atrasados = $meses - $parcelasPagas;
        }
    }
    $data = array();
    $data['mensalidades'] = $dados;
    $data['user'] = $user;

    $this->load->view('template/header_view');
    $this->load->view('cliente/mensalidades_view', $data);
    $this->load->view('template/footer_view');
}
  
  public function fatura(){
      $this->usuarioModel->isLoggedIn();
      $idUser = $this->session->userdata("bs_user_id");
      $data   = array();

      $data['mensalidades'] =$this->financeiroModel->getClientesMounthlData($idUser);
      $userId = $this->session->userdata("bs_user_id");
      $user = $this->usuarioModel->getUserCompleteData($userId);
      $data['user'] = $user;
      $this->load->view('template/header_view');
      $this->load->view('usuario/fatura_view', $data);
      $this->load->view('template/footer_view');
  }
  
  public function edit_token(){
      //check user logged in or not
      $this->usuarioModel->isLoggedIn();

      $idUser = $this->session->userdata("bs_user_id");

      $user = $this->usuarioModel->getUserCompleteData($idUser);
      
      $data = array();


      if ($this->input->post()) {
        if ($this->input->post("token")) {
            $this->form_validation->set_rules('token', 'token', 'trim|required|strip_tags');
            if ($this->form_validation->run() != FALSE) {
                $userToken = $this->financeiroModel->getTokenUsuario($idUser);
                $data = $this->input->post();
                if($userToken) {
                    $this->financeiroModel->updateUserToken($idUser, $this->input->post("token"), $this->input->post("email_pagseguro"));
                    $this->session->set_flashdata("msg", array("tipo" => "1", "texto" => "Token atualizado com sucesso!" ));               
                } else {
                    $this->financeiroModel->insertUserToken($idUser, $this->input->post("token"));
                    $this->session->set_flashdata("msg", array("tipo" => "1", "texto" => "Token cadastrado com sucesso!" ));   
                }
            }
        }

        $user->token = $this->financeiroModel->getTokenUsuario($idUser);
          
      } else {
          $user->token = $this->financeiroModel->getTokenUsuario($idUser);
          if(!$user->token) {
            
          }
      }

      $userId = $this->session->userdata("bs_user_id");
      $data['user'] = $user;
      
      $this->load->view('template/header_view');
      $this->load->view('usuario/edit_token_view', $data);
      $this->load->view('template/footer_view');
  }
  
  public function minhasFaturas(){
    $this->usuarioModel->isLoggedIn();
 
    $userId = $this->session->userdata("bs_user_id");
    $user = $this->financeiroModel->getAllUserById($userId);
    $data = array();

    $data['user'] = $user;

    $this->load->view('template/header_view');
    $this->load->view('usuario/minhas_faturas_view', $data);
    $this->load->view('template/footer_view');
  }

  public function allUsers(){
       $this->usuarioModel->isLoggedIn();
 
       $userId = $this->session->userdata("bs_user_id");
       $user = $this->usuarioModel->getUserCompleteData($userId);
       $users = $this->usuarioModel->getAllUser();
       $data = array();

       $data['users'] = $users;
       $data['user'] = $user;

       $this->load->view('template/header_view');
       $this->load->view('usuario/empreendedores_view', $data);
       $this->load->view('template/footer_view');
  }

  public function baixa_pagamento(){
      //check user logged in or not
      $this->usuarioModel->isLoggedIn();

      $idUser = $this->session->userdata("bs_user_id");

      
      $data = array();


      if ($this->input->post()) {
        if ($this->input->post("cliente_id")) {

                    $this->financeiroModel->updatePayment($this->input->post("cliente_id"));
                    $this->session->set_flashdata("msg", array("tipo" => "1", "texto" => "Pagamento baixado com sucesso!" ));               
           
        }

        $user->token = $this->input->post("token");
          
      } else {
          $user->token = $this->financeiroModel->getTokenUsuario($idUser);
          if(!$user->token) {
            
          }
      }

      
      $data["user"] = $user;

      $userId = $this->session->userdata("bs_user_id");
      $data['user'] = $user;
      
      $this->load->view('template/header_view');
      $this->load->view('usuario/edit_token_view', $data);
      $this->load->view('template/footer_view');
  }
}