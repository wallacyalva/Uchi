<?php

class Empresa_model extends CI_Model {

    public function __construct() {
         parent::__construct();
    }

    function getAllEmpresas() {
        $this->db->select("*");
        return $this->db->get("empresa")->result();
    }
    
    function getEmpresaCompleteData($id_empresa) {
        $this->db->select("*, empresa_address.id as id_address, empresa_personal_data.id as id_personal_data");
        $this->db->where("empresa.id", $id_empresa);
        $this->db->join("empresa_address", "empresa_address.id_empresa = empresa.id", "left");
        $this->db->join("empresa_personal_data", "empresa_personal_data.id_empresa = empresa.id", "left");
        return $this->db->get("empresa")->row(0);
    }

    function deletarEmpresa($id_empresa) {
        $this->db->where("id", $id_empresa);
        return $this->db->delete("empresa");
    }

    function updateEmpresa($empresa) {
        if(isset($empresa['name'])) {
            $this->db->set("name", $empresa['name']);
        }
        if(isset($empresa['cnpj'])) {
            $this->db->set("cnpj", $empresa['cnpj']);
        }
        if(isset($empresa['ramo'])) {
            $this->db->set("ramo", $empresa['ramo']);
        }
        if(isset($empresa['confirm_new_password'])) {
            $this->db->set("password", md5($empresa['confirm_new_password']));
        }
        $this->db->where("id", $empresa['id']);
        return $this->db->update("empresa");
    }

}