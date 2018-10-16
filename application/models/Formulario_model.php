<?php

class Formulario_model extends CI_Model {
    
    function getRankedUsers($post) {
        //$this->db->select("usuario_personal_data.aboutme,usuario_address.state,usuario_address.city,usuario_address.id_usuario,usuario.*");
        //$this->db->join("usuario", "usuario_address.id_usuario = usuario.id", "left");
        //$this->db->join("usuario_personal_data", "usuario_address.id_usuario = usuario_personal_data.id_usuario", "left");
        
        if($post["selectEstado"] != "0"){
            //$this->db->where("state", $post["selectEstado"]);
            //$this->db->where("city", $post["sub_div_muni"]);
            $this->db->select("usuario.*, usuario_personal_data.aboutme, usuario_address.state, usuario_address.city, usuario_address.id_usuario,((( SUM(resposta_formacao.id_formacao) / 10 / 4)*".$post['escolaridade'].")+ (((((SUM(resposta_idioma.leitura) / 3) + SUM((resposta_idioma.fala) / 3) + SUM((resposta_idioma.escrita) / 3)) / 3) / 2 / 2)*".$post['idiomas'].") + (((COUNT(resposta_informatica.id_sub_tipo) / 6 /2))*".$post['informatica'].") + (((resposta_profissional.viajar + resposta_profissional.moradia + resposta_profissional.atuacao) / 3)*".$post['experiencia'].") + (resposta_profissional.internacional*".$post['exterior'].")) as ranking");
            $this->db->join("resposta_formacao", "resposta_formacao.id_usuario = usuario.id", "left");
            $this->db->join("resposta_idioma", "resposta_idioma.id_usuario = usuario.id", "left");
            $this->db->join("resposta_informatica", "resposta_informatica.id_usuario = usuario.id", "left");
            $this->db->join("resposta_profissional", "resposta_profissional.id_usuario = usuario.id", "left");
            $this->db->join("usuario_address", "usuario_address.id_usuario = usuario.id", "left");
            $this->db->join("usuario_personal_data", "usuario_personal_data.id_usuario = usuario.id", "left");
            $this->db->where("usuario.active", 1);
            $this->db->where("usuario.Is_user", 1);
            $this->db->where("usuario_address.city", $post['sub_div_muni']);
            $this->db->where("usuario_address.state", $post['selectEstado']);
            $this->db->where("resposta_profissional.area", $post['sub_div']);
            $this->db->group_by("usuario.id");
            $this->db->order_by("ranking", "DESC");
            return $this->db->get("usuario")->result();
            // return $this->db->query("SELECT usuario.*, usuario_personal_data.aboutme, usuario_address.state, usuario_address.city, usuario_address.id_usuario,((( SUM(resposta_formacao.id_formacao) / 10 / 4)*".$post['escolaridade'].")+ (((((SUM(resposta_idioma.leitura) / 3) + SUM((resposta_idioma.fala) / 3) + SUM((resposta_idioma.escrita) / 3)) / 3) / 2 / 2)*".$post['idiomas'].") + (((COUNT(resposta_informatica.id_sub_tipo) / 6 /2))*".$post['informatica'].") + (((resposta_profissional.viajar + resposta_profissional.moradia + resposta_profissional.atuacao) / 3)*".$post['experiencia'].") + (resposta_profissional.internacional*".$post['exterior'].")) as ranking FROM usuario LEFT JOIN resposta_formacao ON resposta_formacao.id_usuario = usuario.id LEFT JOIN resposta_idioma ON resposta_idioma.id_usuario = usuario.id LEFT JOIN resposta_informatica ON resposta_informatica.id_usuario = usuario.id LEFT JOIN resposta_profissional ON resposta_profissional.id_usuario = usuario.id LEFT JOIN usuario_personal_data ON usuario_personal_data.id_usuario = usuario.id LEFT JOIN usuario_address ON usuario_address.id_usuario = usuario.id WHERE usuario.active = 1 AND usuario_address.city = '".$post['sub_div_muni']."' AND usuario_address.state = '".$post['selectEstado']."' AND resposta_profissional.area = '".$post['sub_div']."' GROUP BY usuario.id ORDER BY ranking DESC")->result();
        } else {
            $this->db->select("usuario.*, usuario_personal_data.aboutme, usuario_address.state, usuario_address.city, usuario_address.id_usuario,((( SUM(resposta_formacao.id_formacao) / 10 / 4)*".$post['escolaridade'].")+ (((((SUM(resposta_idioma.leitura) / 3) + SUM((resposta_idioma.fala) / 3) + SUM((resposta_idioma.escrita) / 3)) / 3) / 2 / 2)*".$post['idiomas'].") + (((COUNT(resposta_informatica.id_sub_tipo) / 6 /2))*".$post['informatica'].") + (((resposta_profissional.viajar + resposta_profissional.moradia + resposta_profissional.atuacao) / 3)*".$post['experiencia'].") + (resposta_profissional.internacional*".$post['exterior'].")) as ranking");
            $this->db->join("resposta_formacao", "resposta_formacao.id_usuario = usuario.id", "left");
            $this->db->join("resposta_idioma", "resposta_idioma.id_usuario = usuario.id", "left");
            $this->db->join("resposta_informatica", "resposta_informatica.id_usuario = usuario.id", "left");
            $this->db->join("resposta_profissional", "resposta_profissional.id_usuario = usuario.id", "left");
            $this->db->join("usuario_address", "usuario_address.id_usuario = usuario.id", "left");
            $this->db->join("usuario_personal_data", "usuario_personal_data.id_usuario = usuario.id", "left");
            $this->db->where("usuario.active", 1);
            $this->db->where("usuario.Is_user", 1);
            $this->db->where("resposta_profissional.area", $post['sub_div']);
            $this->db->group_by("usuario.id");
            $this->db->order_by("ranking", "DESC");
            return $this->db->get("usuario")->result();
            // return $this->db->query("SELECT usuario.*, usuario_personal_data.aboutme, usuario_address.state, usuario_address.city, usuario_address.id_usuario,((( SUM(resposta_formacao.id_formacao) / 10 / 4)*".$post['escolaridade'].")+ (((((SUM(resposta_idioma.leitura) / 3) + SUM((resposta_idioma.fala) / 3) + SUM((resposta_idioma.escrita) / 3)) / 3) / 2 / 2)*".$post['idiomas'].") + (((COUNT(resposta_informatica.id_sub_tipo) / 6 /2))*".$post['informatica'].") + (((resposta_profissional.viajar + resposta_profissional.moradia + resposta_profissional.atuacao) / 3)*".$post['experiencia'].") + (resposta_profissional.internacional*".$post['exterior'].")) as ranking FROM usuario LEFT JOIN resposta_formacao ON resposta_formacao.id_usuario = usuario.id LEFT JOIN resposta_idioma ON resposta_idioma.id_usuario = usuario.id LEFT JOIN resposta_informatica ON resposta_informatica.id_usuario = usuario.id LEFT JOIN resposta_profissional ON resposta_profissional.id_usuario = usuario.id LEFT JOIN usuario_personal_data ON usuario_personal_data.id_usuario = usuario.id LEFT JOIN usuario_address ON usuario_address.id_usuario = usuario.id WHERE usuario.active = 1 AND resposta_profissional.area = '".$post['sub_div']."' GROUP BY usuario.id ORDER BY ranking DESC")->result();
        }

        //return $this->db->get("usuario_address")->result();
        // return $this->db->query("SELECT usuario.id, usuario.name, usuario.surname, usuario.ramo, usuario.email, usuario.avatar, usuario.created, usuario_personal_data.aboutme, ((( SUM(resposta_formacao.id_formacao) / 10 / 4)".$post['escolaridade'].") + (((((SUM(resposta_idioma.leitura) / 3) + SUM((resposta_idioma.fala) / 3) + SUM((resposta_idioma.escrita) / 3)) / 3) / 2 / 2)".$post['idiomas'].") + (((COUNT(resposta_informatica.id_sub_tipo) / 6 /2))".$post['informatica'].") + (((resposta_profissional.viajar + resposta_profissional.moradia + resposta_profissional.atuacao) / 3)".$post['experiencia'].") + (resposta_profissional.internacional*".$post['exterior'].")) as ranking FROM usuario LEFT JOIN resposta_formacao ON resposta_formacao.id_usuario = usuario.id LEFT JOIN resposta_idioma ON resposta_idioma.id_usuario = usuario.id LEFT JOIN resposta_informatica ON resposta_informatica.id_usuario = usuario.id LEFT JOIN resposta_profissional ON resposta_profissional.id_usuario = usuario.id LEFT JOIN usuario_personal_data ON usuario_personal_data.id_usuario = usuario.id WHERE usuario.active = 1 AND usuario.ramo = ".$post['profisao']." GROUP BY usuario.id ORDER BY ranking DESC")->result();
    }

    function getAreas() {
        $this->db->select("*");
        $this->db->where("pai", 0);
        return $this->db->get("ramos")->result();
    }

    function Municipios($muni) {
        $this->db->select("usuario_address.city");
        $this->db->distinct("usuario_address.city");
        $this->db->where("state",$muni);
        return $this->db->get("usuario_address")->result();
    }

    function subAreas($pai) {
        $this->db->select("*");
        $this->db->where("pai", $pai);
        return $this->db->get("ramos")->result();
    }

    function insertComputacional($iduser,$post_data) {
        for($i = 1; $i <=25; $i++) {
            $this->db->set("questao_$i", $post_data[$i]);
        }
        $this->db->set("id_usuario", $iduser);
        return $this->db->insert("resposta_comportamental");
    }

    function insertProfissional($iduser, $post_data) {
        $this->db->set("id_usuario", $iduser);
        $this->db->set("area", $post_data["sub_div"]);
        $this->db->set("viajar", $post_data["viajar"]);
        $this->db->set("moradia", $post_data["moradia"]);
        $this->db->set("vinculo", $post_data["vinculo"]);
        $this->db->set("atuacao", $post_data["atuacao"]);
        if($post_data["internacional"] == "sim") {
            $this->db->set("internacional", 1);
            $this->db->set("pais", $post_data["pais"]);
            $this->db->set("funcao", $post_data["funcao"]);
            $this->db->set("de", $post_data["date_de"]);
            $this->db->set("ate", $post_data["date_ate"]);
        } else if ( $post_data["internacional"] == "nao" ) {
            $this->db->set("internacional", 0);
        }
        $this->db->insert("resposta_profissional");
        foreach($post_data as $p_data){
            $treat = explode("_",$p_data);
            if(isset($treat[1])){
                $resposta = $treat[0];
                $id = $treat[1];
                $data["status"] = $this->setRespostaFormularioGeral($iduser,$id,$resposta);
            }
        }
    }

    function setFormacao($id_usuario, $data) {
        $this->db->set("id_usuario", $id_usuario);
        $this->db->set("id_formacao", $data->main);
        $this->db->set("id_instituicao", $data->sub);
        return $this->db->insert("resposta_formacao");
    }

    function setIdioma($id_usuario, $data) {
        $this->db->set("id_usuario", $id_usuario);
        $this->db->set("id_idioma", $data->main);
        $this->db->set("leitura", $data->le);
        $this->db->set("fala", $data->fala);
        $this->db->set("escrita", $data->escreve);
        return $this->db->insert("resposta_idioma");
    }

    function setInformatica($id_usuario, $data) {
        $this->db->set("id_usuario", $id_usuario);
        $this->db->set("id_tipo", $data->main);
        $this->db->set("id_sub_tipo", $data->sub);
        return $this->db->insert("resposta_informatica");
    }

    function setProducao($id_usuario, $data) {
        $this->db->set("id_usuario", $id_usuario);
        $this->db->set("id_bibliografia", $data->main);
        $this->db->set("outro", $data->sub);
        return $this->db->insert("resposta_producao");
    }

    function setPremiacao($id_usuario, $data) {
        $this->db->set("id_usuario", $id_usuario);
        $this->db->set("id_categoria", $data->main);
        $this->db->set("id_sub_categoria", $data->sub);
        return $this->db->insert("resposta_premiacao");
    }

    function setRespostaFormularioGeral($iduser,$id,$resposta){
         $this->db->set("id_usuario",$iduser);
          $this->db->set("id_questao",$id);
          $this->db->set("resposta",$resposta);
         $this->db->insert("resposta_geral");
    }

    function getFormularioById($id) {
        $this->db->select("*");
        $this->db->where("id", $id);
        return $this->db->get("formularios_construtor")->row(0);
    }

    function getFormularioByIdArea($id_area) {
        $this->db->select("*");
        $this->db->where("id_area", $id_area);
        return $this->db->get("formularios_construtor")->row(0);
    }

    function getQuestoesByFormularioId($id_formulario) {
        $this->db->select("*");
        $this->db->where("id_formulario", $id_formulario);
        $this->db->order_by("indice", "ASC");
        return $this->db->get("formularios_questoes")->result();

    }

    function getAllFormacoes() {
        $this->db->select("opts_formacoes.id, opts_formacoes.nome, opts_formacoes.sub");
        $this->db->order_by("opts_formacoes.i", "ASC");
        return $this->db->get("opts_formacoes")->result();
    }

    function getAllIdiomas() {
        $this->db->select("opts_idiomas.id, opts_idiomas.nome, opts_idiomas.sub");
        $this->db->order_by("opts_idiomas.i", "ASC");
        return $this->db->get("opts_idiomas")->result();
    }

    function getAllInformatica() {
        $this->db->select("opts_informatica.id, opts_informatica.nome, opts_informatica.sub");
        $this->db->where("opts_informatica.pai", 0);
        $this->db->order_by("opts_informatica.i", "ASC");
        return $this->db->get("opts_informatica")->result();
    }

    function getSubInformatica($id_pai) {
        $this->db->select("opts_informatica.id, opts_informatica.nome");
        $this->db->where("opts_informatica.pai", $id_pai);
        $this->db->order_by("opts_informatica.i", "ASC");
        return $this->db->get("opts_informatica")->result();
    }

    function getAllProducoes() {
        $this->db->select("opts_bibliografias.id, opts_bibliografias.nome, opts_bibliografias.sub");
        $this->db->order_by("opts_bibliografias.i", "ASC");
        return $this->db->get("opts_bibliografias")->result();
    }

    function getAllPremiacoes() {
        $this->db->select("opts_premiacoes.id, opts_premiacoes.nome, opts_premiacoes.sub");
        $this->db->where("opts_premiacoes.pai", 0);
        $this->db->order_by("opts_premiacoes.i", "ASC");
        return $this->db->get("opts_premiacoes")->result();
    }

    function getSubPremiacoes($id_pai) {
        $this->db->select("opts_premiacoes.id, opts_premiacoes.nome, opts_premiacoes.sub");
        $this->db->where("opts_premiacoes.pai", $id_pai);
        $this->db->order_by("opts_premiacoes.i", "ASC");
        return $this->db->get("opts_premiacoes")->result();
    }
}