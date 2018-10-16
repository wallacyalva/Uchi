<?php

class Banner_model extends CI_Model {

    //Retorna todos os Estados
    function getAllEstados() {
        $this->db->select("*");
        return $this->db->get("estado")->result();
    }
    function getAllBannerByUser($idUser = FALSE) {
        $this->db->select("*");
        return $this->db->get("banner")->result();
    }
    function getCidadesByCodigoUf($codigoUfEstado) {
        $this->db->select("*");
        $this->db->where("uf", $codigoUfEstado['uf']);
        return $this->db->get("municipio")->result();
    }
    
    function getBannerByCity($uf,$cidade) {
        $this->db->select("banner");
        $this->db->where("uf", $estado);
        $this->db->where("municipio", $municipio);
        $this->db->where("ativo", 1);
        return $this->db->get("banner")->result();
    }

    function getBannerById($id) {
        $this->db->select("*");
        $this->db->where("id", $id);
        return $this->db->get("banner")->row(0);
    }

    function insertBanner($banner) {
        //inicia transacao
        $this->db->trans_start();

        $this->db->set("uf", $banner["estado"]);
        $this->db->set("municipio", $banner["cidades"]);
        $this->db->set("banner", $banner["bannerImagem"]);
        $this->db->set("link", $banner["site"]);
        $this->db->set("ativo", 1);
  

        $this->db->insert("banner");
        $idBanner = $this->db->insert_id();

        //complete transaction
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            //algum erro ocorreu! 
            return false;
        }
        //retorna ID do anuncio
        return $idBanner;
    }

    function updateBanner($banner) {
        //inicia transacao
        $this->db->trans_start();

        $this->db->set("uf", $banner["estado"]);
        $this->db->set("municipio", $banner["cidades"]);
        $this->db->set("banner", $banner["bannerImagem"]);
        $this->db->set("link", $banner["site"]);
        $this->db->set("ativo", 1);
        $this->db->where("id",$banner["id"]);

        $this->db->update("banner");
        //complete transaction
        $this->db->trans_complete();

        return $this->db->trans_status();
    }


}
