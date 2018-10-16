<?php

class Classificado_model extends CI_Model {

    function getAllClassificados() {
            $this->db->select("*");
            return $this->db->get("classificados")->result();
    }

    function getAllClassificadoByCity($city) {
        $this->db->select("*");
        $this->db->where("cidade", $city);
        return $this->db->get("classificados")->result();
    }

    function getClassificadoAtivo($idClassificado) {
        $this->db->select("ativo");
        $this->db->where('idclassificados', $idClassificado);
        return $this->db->get("classificados")->row(0);
    }

    function updateBlockClassidicado($idClassificado) {        
        //START TRANSACTION
        $this->db->trans_start();
        $Classificado=$this->getClassificadoAtivo($idClassificado);
        if($Classificado->ativo==1){
            $this->db->set('ativo', 0);
        }else{
            $this->db->set('ativo', 1);
        }

        $this->db->where("idclassificados", $idClassificado);
        $this->db->update('classificados'); //TABELA DE clientes

        //COMPLETE TRANSACTION
        $this->db->trans_complete();
        return $this->db->trans_status();
    }  

    function getAllClientesClassificados() {
        $this->db->select("*");
        return $this->db->get("clientes_classificados")->result();
    }

    function removeClassidicado($id) {
        $this->db->where("idclassificados", $id);
        $this->db->delete("classificados");
    }
}
