<?php

class Plano_model extends CI_Model {
    
    /**
     * Autor: J.S.Junior
     * Data: 13/01/2018
     * Descrição: Metodo para inserir dados
     * 
     */
    private $table = "planos";

    function insertPlano($dados) {
            //inicia transacao
            $this->db->trans_start();
    
            $this->db->set("plano", $dados["plano"]);
            $this->db->set("valor", $dados["valor"]);
            $this->db->set("descricao", $dados["descricao"]);
            $this->db->set("tipo", 0);
    
            $this->db->insert($this->table);
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
                $this->db->where("tipo","0");
            } 
            return $this->db->get($this->table)->result();
        }
    /**
     * Author: J.S.Júnior
     * Data: 19/12/2017
     * Descrição: Metodo para apagar registro
     */
    function deletePlano($id) {
        $this->db->where("id", $id);
        $this->db->delete($this->table);
    }

    function getOnePlano($id) {
        $this->db->select("*");            
        return $this->db->where("id", $id)->get($this->table)->row(0);
    }
    function updatePlano($id, $dados) {
        
        //START TRANSACTION
        $this->db->trans_start(); 
        
        $this->db->set("plano", $dados["plano"]);
        $this->db->set("valor", $dados["valor"]);
        $this->db->set("descricao", $dados["descricao"]);
        
        $this->db->where("id", $id);
        $this->db->update($this->table);

        //COMPLETE TRANSACTION
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}
