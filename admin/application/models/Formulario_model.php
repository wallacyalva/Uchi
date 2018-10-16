<?php

class Formulario_model extends CI_Model {

    function getAllForms() {
        $this->db->select("*");
        $result = $this->db->get("formularios_construtor")->result();

        foreach($result as $form) {
            $this->db->select("COUNT(id_formulario) as number");
            $this->db->where("id_formulario", $form->id);
            $form->number = $this->db->get("formularios_questoes")->row(0)->number;
        }

        return $result;
    }  

    function insertForm($form) {
        $this->db->set("nome", $form->nome);
        $this->db->insert("formularios_construtor");
        $id_formulario = $this->db->insert_id();

        foreach($form->campos as $questao) {
            $this->db->set("tipo", $questao->tipo);
            $this->db->set("titulo", $questao->titulo);
            $this->db->set("opcoes", $questao->opcoes);
            $this->db->set("analitico", $questao->analitico);
            $this->db->set("criativo", $questao->criativo);
            $this->db->set("operacional", $questao->operacional);
            $this->db->set("relacional", $questao->relacional);
            $this->db->set("id_formulario", $id_formulario);
            $this->db->set("indice", $questao->indice);
            $this->db->set("pai", 0);
            $this->db->insert("formularios_questoes");
        }

        return $id_formulario;
    }
}
