<?php

class Categoria_model extends CI_Model {
    
    /**
     * Autor: J.S.Junior
     * Data: 19/12/2017
     * Descrição: Metodo para inserir dados
     * 
     */
    function insertCategoria($dados) {
            //inicia transacao
            $this->db->trans_start();
    
            $this->db->set("descricao", $dados["categoria"]);
            $this->db->set("tipo", $dados["tipo"]);
            $this->db->set("pai", $dados["pai"]);
    
            $this->db->insert("categorias");
            $idReturn = $this->db->insert_id();
    
            //complete transaction
            $this->db->trans_complete();
    
            if ($this->db->trans_status() === FALSE) {
                //algum erro ocorreu! 
                return false;
            }
            //retorna ID do anuncio
            return $idReturn;
    }
    /**
     * Autor: J.S.Junior
     * Data: 19/12/2017
     * Descrição: Metodo par abuscar todas as categorias
     * 
     */
        function getAll($all = FALSE) {
            $this->db->select("*");
            if($all){
            }else{
                $this->db->where("pai","0");
            } 
            return $this->db->get("categorias")->result();
        }
    /**
     * Author: J.S.Júnior
     * Data: 19/12/2017
     * Descrição: Metodo para apagar registro
     */
    function deleteCategoria($idCategoria) {
        $this->db->where("id", $idCategoria);
        $this->db->delete("categorias");
    }

    function getOneCategoria($idCategoria) {
        $this->db->select("*");            
        return $this->db->where("id", $idCategoria)->get("categorias")->row(0);
    }
    function updateCategoria($idCategoria, $dados) {
        
        //START TRANSACTION
        $this->db->trans_start(); 
        
        $this->db->set("descricao", $dados["categoria"]);
        $this->db->set("tipo", $dados["tipo"]);
        $this->db->set("pai", $dados["pai"]);
        
        $this->db->where("id", $idCategoria);
        $this->db->update('categorias'); //TABELA DE clientes

        //COMPLETE TRANSACTION
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}
