<?php

class Ramos_model extends CI_Model {

    function getAllRamos() {
        $this->db->select("*");
        return $this->db->get("ramos")->result();
    }
}