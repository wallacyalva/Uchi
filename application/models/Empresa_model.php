<?php

class Empresa_model extends CI_Model {

    function getAllRamos() {
        $this->db->select("id,nome");
        $this->db->where("pai != 0");
        return $this->db->get("ramos")->result();
    }

    function registerEmpresa($data) {
        //inicia transacao
        $this->db->trans_start();

        //INSERE A EMPRESA
        $this->db->set("name", $data["emp_nome"]);
        $this->db->set("ramo", $data["emp_ramo"]);
        $this->db->set("email", $data["emp_email"]);
        $this->db->set("cnpj", $data["emp_cnpj"]);
        $this->db->set("password", md5($data["emp_password"]));
        $this->db->set("avatar", "no-image.jpg");
        $this->db->set("active", 1); //Quando setado pra 1 o user já sai ativado
        $this->db->set("Is_user", 0); //Quando setado pra 0 é empresa
        $this->db->insert("usuario");
        $isLastInsert = $this->db->insert_id();

        //INSERE O ENDERECO
        $this->db->set("postalcode", $data["emp_postalcode"]);
        $this->db->set("street", $data["emp_street"]);
        $this->db->set("district", $data["emp_district"]);
        $this->db->set("city", $data["emp_city"]);
        $this->db->set("state", $data["emp_state"]);
        $this->db->set("id_usuario", $isLastInsert);
        $this->db->insert("usuario_address");

        //INSERE A DATA
        $this->db->set("sobre", "");
        $this->db->set("criacao", "");
        $this->db->set("local", "");
        $this->db->set("telefone", "");
        $this->db->set("contato", "");
        $this->db->set("site", "");
        $this->db->set("id_usuario", $isLastInsert);
        $this->db->insert("usuario_personal_data");

        //complete transaction
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            //algum erro ocorreu! 
            return false;
        }
    }

    function getDadosByEmpresaEmail($empresaEmail, $fields) {
        if ($fields) {
            if (is_array($fields)) {
                $fieldsStr = implode(",", $fields);
            } else {
                $fieldsStr = $fields;
            }
            return $this->db->select($fieldsStr)->where("email", $empresaEmail)->get("usuario")->row(0);
        } else {
            return $this->db->where("id", $empresaEmail)->get("usuario")->row(0);
        }
    }

    function getEmpresaCompleteData($empresaId) {
        $this->db->select("*, usuario_address.id_usuario as id_address, usuario_personal_data.id_usuario as id_personal_data");            
        $this->db->join("usuario_address", "usuario.id = usuario_address.id_usuario", "left");
        $this->db->join("usuario_personal_data", "usuario.id = usuario_personal_data.id_usuario", "left");
        return $this->db->where("usuario.id", $empresaId)->get("usuario")->row(0);
    }

    function updateEmpresaData($sobre, $criacao, $local, $phone, $contato, $site, $empresaId){
        $this->db->trans_start();
        $this->db->set("sobre", $sobre);
        $this->db->set("criacao", $criacao);
        $this->db->set("local", $local);
        $this->db->set("telefone", $phone);
        $this->db->set("contato", $contato);
        $this->db->set("site", $site);
        $this->db->where("id_usuario", $empresaId);
        $this->db->update('usuario_personal_data');
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    function insertVaga($id_empresa, $post) {
        $this->db->set("titulo", $post["titulo"]);
        $this->db->set("descricao", $post["descricao"]);
        $this->db->set("salario", $post["salario"]);
        $this->db->set("local", $post["local"]);
        $this->db->set("id_opts_areas", $post["area"]);
        $this->db->set("id_empresa", $id_empresa);
        return $this->db->insert("vagas");
    }
    function insertCase($id_usuario, $post) {
        $this->db->set("id_usuario", $id_usuario);
        $this->db->set("titulo", $post["titulo"]);
        $this->db->set("texto", $post["texto"]);
        return $this->db->insert("cases");
    }

    function updateVaga($id_empresa, $post) {
        $this->db->set("titulo", $post["titulo"]);
        $this->db->set("descricao", $post["descricao"]);
        $this->db->set("salario", $post["salario"]);
        $this->db->set("local", $post["local"]);
        $this->db->set("id_opts_areas", $post["area"]);
        $this->db->where("id", $post["id"]);
        return $this->db->update("vagas");
    }

    function getAllVagasByEmpresa($id_empresa) {
        $this->db->select("*");
        $this->db->where("id_empresa", $id_empresa);
        return $this->db->get("vagas")->result();
    }
    function getAllCasesById($id_empresa) {
        $this->db->select("*");
        $this->db->where("id_usuario", $id_empresa);
        return $this->db->get("cases")->result();
    }

    function getAllVagas() {
        $this->db->select("*");
        return $this->db->get("vagas")->result();
    }

    function responderVaga($id_vaga,$userId,$id_empresa){
        $this->db->set("vizualizada", 0);
        $this->db->set("tipo", "notificacoes");
        $this->db->set("id_notificado", $id_empresa);
        $this->db->set("id_notificando", $userId);
        $this->db->set("texto", "Alguem respondeu a uma vaga sua, click para vizualizar."
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    );
        $this->db->insert("notificacoes");
    }

    function deleteVaga($id_vaga, $id_empresa) {
        return $this->db->where("id", $id_vaga)->where("id_empresa", $id_empresa)->delete("vagas");
    }
    
}
