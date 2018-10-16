<?php

class Promocao_model extends CI_Model {

    function insertPromocao($promocao, $desativarPromocao = false) {
        //inicia transacao
        $this->db->trans_start();

        $this->db->set("usuario", $promocao["usuario"]);
        $this->db->set("disponivel", 1);
        $this->db->set("titulo", $promocao["title_promotion"]);
        $this->db->set("tipo", 1);
        $this->db->set("valor_produto", getNumericValueOfString(str_replace(array("R$", "R$ "), "", $promocao["price_product"])));
        $this->db->set("desconto", getNumericValueOfString(str_replace(array(" ", "%"), "", $promocao["price_discount"])));
        $this->db->set("dias_countdown", getNumericValueOfString($promocao["active_days"]));
        $this->db->set("qtdprodutos", getNumericValueOfString($promocao["product_quantity"]));
        $this->db->set("regra", $promocao["rule"]);
        $this->db->set("descricao", $promocao["description"]);
        $this->db->set("capa", $promocao["capa"]);
        $this->db->set("data", date("Y-m-d H:i:s"));

        $this->db->insert("anuncios");
        $promocaoId = $this->db->insert_id();

        //complete transaction
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            //algum erro ocorreu! 
            return false;
        }
        //retorna ID do anuncio
        return $promocaoId;
    }

    function updateClientePromocao($promocao) {
        //inicia transacao
        $this->db->trans_start();

        $this->db->set("usuario", $promocao["idcliente"]);
        $this->db->set("disponivel", 1);
        $this->db->set("titulo", $promocao["title_promotion"]);
        $this->db->set("tipo", 1);
        $this->db->set("valor_produto", getNumericValueOfString(str_replace(array("R$", "R$ "), "", $promocao["price_product"])));
        $this->db->set("desconto", getNumericValueOfString(str_replace(array(" ", "%"), "", $promocao["price_discount"])));
        $this->db->set("dias_countdown", getNumericValueOfString($promocao["active_days"]));
        $this->db->set("qtdprodutos", getNumericValueOfString($promocao["product_quantity"]));
        $this->db->set("regra", $promocao["rule"]);
        $this->db->set("descricao", $promocao["description"]);
        $this->db->set("data", date("Y-m-d H:i:s"));

        if(isset($promocao["capa"])){
           $this->db->set("capa", $promocao["capa"]);
        }
        $this->db->where("id", $promocao["idpromocao"]);
        $this->db->update("anuncios");
        //complete transaction
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            //algum erro ocorreu! 
            return false;
        }
        //retorna ID do anuncio
        return true;
    }

    function desativarPromocao($promocao) {
        //inicia transacao
        $this->db->trans_start();
        $this->db->set("disponivel", 0);
        $this->db->where("id", $promocao);
        $this->db->update("anuncios");
        //complete transaction
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            //algum erro ocorreu! 
            return false;
        }
        //retorna ID do anuncio
        return true;
    }

    function getPromocoesUsuario($usuarioId, $orderBy = "DESC") {
        $this->db->select("*,anuncios.id as id");
        $this->db->join("usuarios_enderecos", "usuarios_enderecos.usuarios_id = anuncios.usuario", "left");        
        $this->db->where("anuncios.usuario", $usuarioId);
        $this->db->where("anuncios.tipo", 1);
        $this->db->order_by("anuncios.id", $orderBy);
        return $this->db->get("anuncios")->result();
    }

    function getOnePromocoesUsuario($usuarioId,$idPromocao, $orderBy = "DESC") {
        $this->db->select("*,anuncios.id as id");
        $this->db->join("usuarios_enderecos", "usuarios_enderecos.usuarios_id = anuncios.usuario", "left");        
        $this->db->where("anuncios.usuario", $usuarioId);
        $this->db->where("anuncios.tipo", 1);
        $this->db->where("anuncios.id", $idPromocao);
        $this->db->order_by("anuncios.id", $orderBy);
        return $this->db->get("anuncios")->row(0);;
    }

}
