<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pagamentos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Carregando model
        $this->load->model('anuncio_model', 'anuncioModel');
        $this->load->model('usuario_model', 'usuarioModel');
        $this->load->model('qrcode_model', 'qrcodeModel');
        $this->load->model('pedidos_model', 'pedidosModel');
        $this->load->model('send_email_model', 'sendEmailModel');
    }

    public function reservar() {
        $result = array();
        if (!is_user_logged_in()) {
            $result["login"] = "login";
            $result["error"] = "Você deve fazer login antes de fazer uma reserva.";
            echo json_encode($result);
            die();
        }
        $ofertaAntiga = $this->session->userdata("oferta");
        if (!$ofertaAntiga) {
            $result["error"] = "Perdão, você demorou muito. Esta reserva foi inválidada, refaça sua reserva.";
            echo json_encode($result);
            die();
        }

        $this->form_validation->set_rules('anuncio', 'Anúncio', 'required|trim|numeric|strip_tags');
        $this->form_validation->set_rules('qtd', 'Quantidade', 'required|trim|numeric|strip_tags');
        if ($this->form_validation->run() === FALSE) {
            $result["error"] = "Houve uma inconsistência em sua compra. Por favor, refaça sua reserva.";
            echo json_encode($result);
            die();
        }
        $anuncioId = $this->input->post("anuncio");
        if ($ofertaAntiga["anuncio"] != $anuncioId) {
            $result["error"] = "Esta reserva foi invalidada. Você já deve ter tentado fazer outras reservas.";
            echo json_encode($result);
            die();
        }

        $valorDeVenda = $ofertaAntiga["valor"];

        $anuncio = $this->anuncioModel->getDadosAnuncio($anuncioId, array("id, usuario, qtdprodutos, valor_produto, titulo"));
        if (!$anuncio) {
            $result["error"] = "Este anúncio está inválido.";
            echo json_encode($result);
            die();
        }

        $usuarioId = $this->session->userdata("bs_user_id");
        $usuarioComprador = $this->usuarioModel->getDados($usuarioId, array("id, nome, email, documento"));
        $qtdReservada = getNumericValueOfString($this->input->post("qtd"));
        $totalReserva = number_format(($valorDeVenda * $qtdReservada), 2, ".", "");
        if ($qtdReservada <= 0) {
            $result["error"] = "A quantidade da reserva deve ser maior que zero";
            echo json_encode($result);
            die();
        }
        if ($anuncio->qtdprodutos < $qtdReservada) {
            if ($anuncio->qtdprodutos == 1) {
                $result["error"] = "Infelizmente a quantidade disponível é de " . $anuncio->qtdprodutos . " reserva";
            } else if ($anuncio->qtdprodutos > 1) {
                $result["error"] = "Infelizmente a quantidade disponível é de " . $anuncio->qtdprodutos . " reservas";
            } else {
                $result["error"] = "Infelizmente este anúncio acabou";
            }
            echo json_encode($result);
            die();
        }
        if (!$usuarioComprador) {
            $result["error"] = "O usuário comprador não foi encontrado";
            echo json_encode($result);
            die();
        }

        $usuarioVendedor = $this->usuarioModel->getDados($anuncio->usuario, "email");
        if (!$usuarioVendedor) {
            $result["error"] = "O usuário vendedor não foi encontrado";
            echo json_encode($result);
            die();
        }
        //inicia transacao
        $this->db->trans_start();
        $orderId = $this->anuncioModel->reservarAnuncio($usuarioId, $anuncio->id, $totalReserva, $qtdReservada);
        //complete transaction
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            //algum erro ocorreu! 
            $result["error"] = "Não foi possível realizar a transação. Por favor, tente novamente";
            echo json_encode($result);
            die();
        }
        //retorna ID do anuncio
        $descricaoReserva = 'Você está adquirindo  ' . $qtdReservada . " reserva(s) de " . $anuncio->titulo;
        //carrega lib de boletos
        $this->load->library("Boletos/CobreGratis", "bank_billet");
        $boletoFields = array('amount' => $totalReserva,
            'expire_at' => date("Y-m-d", strtotime("+3 days", strtotime(date("Y-m-d H:i:s")))),
            'name' => $usuarioComprador->nome,
            'customer_email' => $usuarioComprador->email,
            'save_customer' => true,
            'notify_payment' => true,
            'description' => "$descricaoReserva",
            'send_email_on_creation' => true,
            'meta' => "ecomm_" . $orderId
        );
        if ($usuarioComprador->documento != "none" || strlen($usuarioComprador) <= 14) {
            $boletoFields["cnpj_cpf"] = str_replace(array(",", ".", "-"), "", $usuarioComprador->documento);
        } else {
            $boletoFields["cnpj_cpf"] = str_replace(array(",", ".", "/", "-"), "", $usuarioComprador->documento);
        }
        $this->bank_billet = new BankBillet($boletoFields);
        $this->bank_billet->user = "LmJzf35MNU9qegC3wzNf";
        $this->bank_billet->password = "w201976";
        $resultado = $this->bank_billet->save();
        if ($resultado && !$resultado->error) {
            $linkBoleto = $resultado->__get("external_link");
            $this->anuncioModel->updateBoletoLink($orderId, $linkBoleto);
            //se nao houve erro no post, envia os dados e redireciona ao boleto
            $data["success"] = $linkBoleto;
        } else {
            $data["error"] = $resultado->error;
        }
        echo json_encode($data);
    }

    public function notificacao_boleto() {
        //post recebido
        $codigoSeguranca = $this->input->post("code");
        $orderId = $this->input->post("meta");
        $totalPago = $this->input->post("paid_amount");
        $paymentStatus = $this->input->post("status"); // (draft, opened, cancelled, paid)
        //TEST
//        $codigoSeguranca = "bsf_boletos_bsf";
//        $orderId = "ecomm_" . 70;
//        $totalPago = 3750;
//        $paymentStatus = "paid"; // (draft, opened, cancelled, paid)
        //END TESTE
        if ($paymentStatus == "cancelled") {
            $paymentStatus = "Cancelado";
        } elseif ($paymentStatus == "opened") {
            $paymentStatus = "Em Aberto";
        }
        if ($codigoSeguranca == "bsf_boletos_bsf") {
            //verifica se é uma notificacao de ticket/pacote ou de ativacao do binario mensal ou ecommerce
            if (strpos($orderId, "ecomm_") !== FALSE) {
                //notificacao do ecommerce
                $orderId = (int) str_replace("ecomm_", "", $orderId);
                if ($orderId) {
                    $order = $this->pedidosModel->getOrder($orderId);
                    if ($order) {
                        $status = array("em_aberto" => 0, "paid" => 1, "cancelado" => 2);
                        $this->db->trans_start();
                        if ($paymentStatus == "paid" && $order->disponivel == 0) {
                            if ($order->valor_total == $totalPago) {
                                $this->pedidosModel->updateOrder($orderId, $paymentStatus, $status[strtolower(str_replace(" ", "_", $paymentStatus))]);
                                if ($paymentStatus == "paid") {
                                    $reservas = $this->pedidosModel->getReservasByOrderId($order->id);
                                    $QRcodes = array();
                                    foreach ($reservas as $reserva) {
                                        $QRcode = $this->qrcodeModel->geraQr($order->usuario, $reserva->id, $order->id, $reserva->codigo);
                                        $QRcodes[] = array("reserva" => $reserva->codigo, "qrcode" => $QRcode);
                                        $this->pedidosModel->updateReservaQRcode($reserva->id, $QRcode);
                                    }
                                    $user = $this->usuarioModel->getUsuario($order->usuario);
                                    $this->sendEmailModel->enviarEmailNotificacaoQRcodes($QRcodes, $user);
                                }
                            }
                        } else if ($order->disponivel != 1) {
                            $this->pedidosModel->updateOrder($orderId, $paymentStatus, $status[strtolower(str_replace(" ", "_", $paymentStatus))]);
                        }
                        $this->db->trans_complete();
                    }
                }
            }
        }
    }

}
