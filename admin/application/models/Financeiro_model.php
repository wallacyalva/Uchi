<?php

class Financeiro_model extends CI_Model {

    function getRecebimentos($userId, $limit = false) {
        $this->db->select("para_usuario as recebedor, titulo, valor, nome as nome_pagador, extratos_pagamentos.data");
        $this->db->join("anuncios", "extratos_pagamentos.anuncio = anuncios.id", "left");
        $this->db->join("usuarios", "extratos_pagamentos.de_usuario = usuarios.id", "left");
        $this->db->where("para_usuario", $userId);
        $this->db->order_by("extratos_pagamentos.data DESC");
        if ($limit) {
            $this->db->limit($limit, 0);
        }
        return $this->db->get("extratos_pagamentos")->result();
    }

    function getSaques($userId, $limit = false) {
        $this->db->where("usuario", $userId);
        $this->db->order_by("data DESC");
        if ($limit) {
            $this->db->limit($limit, 0);
        }
        return $this->db->get("extratos_saques")->result();
    }
    
    function getAllUserById($id) {
        $this->db->select("*, financeiro_usuarios.id_f_user as financeiro_id, usuarios_enderecos.id as id_usuarios_enderecos");
        $this->db->join("financeiro_usuarios", "usuarios.id = financeiro_usuarios.user_id", "left");
        $this->db->join("usuarios_enderecos", "usuarios.id = usuarios_enderecos.usuarios_id", "left");
        $this->db->where("usuarios.id", $id);
        return $this->db->get("usuarios")->row(0);
    }

    function getClientesMounthlData($userId, $limit = false) {

        $this->db->select("financeiro_clientes.*, clientes.name_company, clientes.data, clientes.responsible, clientes.phone as telefone, clientes.plano_id, planos.plano as plan, planos.valor as value, planos.descricao as description");
        $this->db->join("clientes", "financeiro_clientes.cliente_id = clientes.id", "left");
        $this->db->join("planos", "financeiro_clientes.plano = planos.id", "left");
        $this->db->where("clientes.usuarios_id", $userId);
        $this->db->order_by("parcelas_pagas DESC");
        if ($limit) {
            $this->db->limit($limit, 0);
        }
        return $this->db->get("financeiro_clientes")->result();
    }

    function getStatusSaqueExibicao($status) {
        $arrayStatus = array("Em análise", "Recebido", "Negado");
        if (isset($arrayStatus[$status])) {
            return $arrayStatus[$status];
        } else {
            return "Sem informação";
        }
    }

    function getSaldoUsuario($userId) {
        $this->db->where("usuario", $userId);
        return $this->db->get("usuarios_saldos")->row(0);
    }
    
    function getTokenUsuario($userId) {
        $this->db->select("token,email_pagseguro");
        $this->db->where("user_id", $userId);
        return $this->db->get("financeiro_usuarios")->row(0);
    }
    
    function updateUserToken($userId, $token, $email) {
        $this->db->set("token", $token);
        $this->db->set("email_pagseguro", $email);
        $this->db->where("user_id", $userId)->update("financeiro_usuarios");
    }
        
    function updatePayment($clientId) {
        $this->db->set("parcelas_pagas", "parcelas_pagas+1", FALSE);
        $this->db->set("ultimo_pagamento", date("Y-m-d H:i:s"));
        $this->db->where("cliente_id", $clientId)->update("financeiro_clientes");
    }
    
    function insertExtratoSaque($userId, $valorSaque, $status = 0){
        $this->db->set("usuario", $userId);
        $this->db->set("valor", $valorSaque);
        $this->db->set("status", $status); //0=em analise // 1-liberado //2- negado
        $this->db->set("data", date("Y-m-d H:i:s"));
        $this->db->insert("extratos_saques");
    }
   
    function insertUserToken($userId, $token){
        $this->db->set("user_id", $userId);
        $this->db->set("saldo", 0.00);
        $this->db->set("pago", 0.00);
        $this->db->set("recebido", 0.00);
        // $this->db->set("senha_financeira", $userId);
        $this->db->set("token", $token);
        $this->db->set("status", 1); //0=em analise // 1-liberado //2- negado
        $this->db->set("data", date("Y-m-d H:i:s"));
        $this->db->insert("financeiro_usuarios");
    }
}
