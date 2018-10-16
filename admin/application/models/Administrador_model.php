<?php

    class Administrador_model extends CI_Model {

        public function __construct() {
            parent::__construct();
        }

        function getAlladministradors() {
            $this->db->select("*");
            return $this->db->get("administradores")->result();
        }
        
        function getadministradorCompleteData($id_administrador) {
            $this->db->select("*");
            $this->db->where("id", $id_administrador);
            return $this->db->get("administradores")->row(0);
        }

        function deletaradministrador($id_administrador) {
            $this->db->where("id", $id_administrador);
            return $this->db->delete("administradores");
        }

        function updateadministrador($administrador) {
            if(isset($administrador['nome'])) {
                $this->db->set("nome", $administrador['nome']);
            }
            if(isset($administrador['apelido'])) {
                $this->db->set("apelido", $administrador['apelido']);
            }
            if(isset($administrador['phone'])) {
                $this->db->set("phone", $administrador['phone']);
            }
            if(isset($administrador['telefone'])) {
                $this->db->set("telefone", $administrador['telefone']);
            }
            if(isset($administrador['confirm_new_password'])) {
                $this->db->set("senha", md5($administrador['confirm_new_password']));
            }
            $this->db->where("id", $administrador['id']);
            return $this->db->update("administradores");
        }

    }