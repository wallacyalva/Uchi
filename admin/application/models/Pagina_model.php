<?php

class Pagina_model extends CI_Model {

    function insertPagina($pagina) {
        //inicia transacao
        $this->db->trans_start();

        $this->db->set("url", $pagina["url"]);
        $this->db->set("titulo", $pagina["titulo"]);
        $this->db->set("conteudo", $pagina["conteudo"]);
        
        $this->db->insert("pagina");
        $idPagina = $this->db->insert_id();
        
        //complete transaction
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            //algum erro ocorreu! 
            return false;
        }
        //retorna ID do anuncio
        return $idPagina;
    }

    function getPagina($idPagina = false) {
        if($idPagina) {
            $this->db->select("*");            
            $this->db->where("idpagina", $idPagina);
            return $this->db->get("pagina")->row(0);
        } else {
            $this->db->select("*");            
             return $this->db->get("pagina")->result();
        }
    }
/** 
* Função para apagar registro
* Quando deletado o cliente, o banco irá deletar
* os registros nas tabelas (clientes, clientes_enderecos, clientes_picture)
* DELETE ON CASCADE UPDATE ON CASCADE
* @author J.S.Júnior
* @version 0.1 
* @access public  
* @package Cliente 
* @example $this->nomeModel->deleteCliente($idRegistroCliente);
*/ 
    function deletePagina($idpagina) {
        $this->db->where("idpagina", $idpagina);
        $this->db->delete("pagina");
    }
/** 
* Função para buscar as imagens do cliente
* @author J.S.Júnior
* @version 0.1 
* @access public  
* @package Cliente 
* @example $this->nomeModel->getClienteImage($idCliente);
*/ 
    function getClienteImage($idCliente) {
        $this->db->select("picture,id,active");
        $this->db->where('clientes_id', $idCliente);
        $picture = $this->db->get("clientes_picture")->result();
        return $picture;
    }

    function updatePagina($idPagina, $pagina) {
        
                //START TRANSACTION
                $this->db->trans_start();
                
                $this->db->set('titulo', $pagina['titulo']);
                $this->db->set('url', $pagina['url']);
                $this->db->set('conteudo', $pagina['conteudo']);
                $this->db->where("idpagina", $idPagina);
                $this->db->update('pagina'); //TABELA DE clientes
        
                //COMPLETE TRANSACTION
                $this->db->trans_complete();
                return $this->db->trans_status();
            }
}
