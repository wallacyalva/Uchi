<?php

class Dados_model extends CI_Model {

    // BIBLIOGRAFIAS //
    function insertBibliografia($nome) {
        $this->db->set("nome", $nome);
        return $this->db->insert("opts_bibliografias");
    }
    function getAllBibliografia() {
        $this->db->select("*");
        return $this->db->get("opts_bibliografias")->result();
    }
    function updatedBibliografia($nome, $id_bibliografia) {
        $this->db->set("nome", $nome);
        $this->db->where("id", $id_bibliografia);
        return $this->db->update("opts_bibliografias");
    }
    function deleteBibliografia($id_bibliografia) {
        $this->db->select("*");
        $this->db->where("id", $id_bibliografia);
        return $this->db->delete("opts_bibliografias");
    }

    // AREAS //
    function insertArea($nome) {
        $this->db->set("nome", $nome);
        return $this->db->insert("opts_areas");
    }
    function getAllAreas() {
        $this->db->select("*");
        return $this->db->get("opts_areas")->result();
    }
    function updatedArea($nome, $id_area) {
        $this->db->set("nome", $nome);
        $this->db->where("id", $id_area);
        return $this->db->update("opts_areas");
    }
    function deleteArea($id_area) {
        $this->db->select("*");
        $this->db->where("id", $id_area);
        return $this->db->delete("opts_areas");
    }

    // IDIOMAS //
    function insertIdioma($nome) {
        $this->db->set("nome", $nome);
        return $this->db->insert("opts_idiomas");
    }
    function getAllIdiomas() {
        $this->db->select("*");
        return $this->db->get("opts_idiomas")->result();
    }
    function updatedIdioma($nome, $id_idioma) {
        $this->db->set("nome", $nome);
        $this->db->where("id", $id_idioma);
        return $this->db->update("opts_idiomas");
    }
    function deleteIdioma($id_idioma) {
        $this->db->select("*");
        $this->db->where("id", $id_idioma);
        return $this->db->delete("opts_idiomas");
    }

    // FORMAÇÃO //
    function insertFormacao($nome) {
        $this->db->set("nome", $nome);
        return $this->db->insert("opts_formacoes");
    }
    function getAllFormacoes() {
        $this->db->select("*");
        return $this->db->get("opts_formacoes")->result();
    }
    function updatedFormacao($nome, $id_formacao) {
        $this->db->set("nome", $nome);
        $this->db->where("id", $id_formacao);
        return $this->db->update("opts_formacoes");
    }
    function deleteFormacao($id_formacao) {
        $this->db->select("*");
        $this->db->where("id", $id_formacao);
        return $this->db->delete("opts_formacoes");
    }

    // PROFISSOES //
    function insertProfissao($nome, $pai) {
        $this->db->set("nome", $nome);
        $this->db->set("pai", $pai);
        return $this->db->insert("opts_profissoes");
    }
    function getAllProfissoes() {
        $this->db->select("*");
        return $this->db->get("opts_profissoes")->result();
    }
    function updatedProfissao($nome, $pai, $id_area) {
        $this->db->set("nome", $nome);
        $this->db->set("pai", $pai);
        $this->db->where("id", $id_area);
        return $this->db->update("opts_profissoes");
    }
    function deleteProfissao($id_profissao) {
        $this->db->select("*");
        $this->db->where("id", $id_profissao);
        return $this->db->delete("opts_profissoes");
    }

    // INFORMATICA //
    function insertInformatica($nome, $pai) {
        $this->db->set("nome", $nome);
        $this->db->set("pai", $pai);
        return $this->db->insert("opts_informatica");
    }
    function getAllInformaticas() {
        $this->db->select("*");
        return $this->db->get("opts_informatica")->result();
    }
    function updatedInformatica($nome, $pai, $id_informatica) {
        $this->db->set("nome", $nome);
        $this->db->set("pai", $pai);
        $this->db->where("id", $id_informatica);
        return $this->db->update("opts_informatica");
    }
    function deleteInformatica($id_informatica) {
        $this->db->select("*");
        $this->db->where("id", $id_informatica);
        return $this->db->delete("opts_informatica");
    }

    // INFORMATICA //
    function insertPremiacao($nome, $pai) {
        $this->db->set("nome", $nome);
        $this->db->set("pai", $pai);
        return $this->db->insert("opts_premiacoes");
    }
    function getAllPremiacoes() {
        $this->db->select("*");
        return $this->db->get("opts_premiacoes")->result();
    }
    function updatedPremiacao($nome, $pai, $id_premiacao) {
        $this->db->set("nome", $nome);
        $this->db->set("pai", $pai);
        $this->db->where("id", $id_premiacao);
        return $this->db->update("opts_premiacoes");
    }
    function deletePremiacao($id_premiacao) {
        $this->db->select("*");
        $this->db->where("id", $id_premiacao);
        return $this->db->delete("opts_premiacoes");
    }
}