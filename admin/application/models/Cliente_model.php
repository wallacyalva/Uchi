<?php

class Cliente_model extends CI_Model {


    function getAllPlanos(){
        $this->db->select("*");
        return $this->db->get("planos")->result();
    }

    function getClienteCapa($idCliente) {
        $this->db->select("capa");
        $this->db->where('id', $idCliente);
        $picture = $this->db->get("clientes")->row(0);
        return $picture;
    }

    function getCategorias() {
        $this->db->select("*");
        $this->db->where('pai', 0);
        return $this->db->get("categorias")->result();
    }

    function getSubCategorias($paiId){
        $this->db->select("id, descricao, pai");
        $this->db->where("tipo", 1);
        $this->db->where("pai", $paiId);
        return $this->db->get("categorias")->result();
    }

    function updateClienteCapa($idCliente,$imagem) {
        $this->db->trans_start();

        $this->db->set('capa', $imagem);

        $this->db->where('id', $idCliente);
        $this->db->update('clientes');
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    function getSubCategoria($idCategoria) {
        $this->db->select("*");
        $this->db->where("tipo", 0);
        $this->db->where("pai", $idCategoria);
        return $this->db->get("categorias")->result();
    }

    function insertCliente($cliente) {
        //inicia transacao
        $this->db->trans_start();
        
        $this->db->set("name_company", $cliente["name_company"]);
        $this->db->set("email", $cliente["email"]);
        $this->db->set("senha", md5($cliente["password"]));
        $this->db->set("capa", $cliente["capa"]);
        //$this->db->set("id_categoria", $cliente["categoria"]);
        $this->db->set("responsible", $cliente["responsible"]);
        $this->db->set("phone", $cliente["phone"]);
        if($cliente["phone2"]){
            $this->db->set("phone2", $cliente["phone2"]);
        }
        $this->db->set("site", $cliente["site"]);
        $this->db->set("facebook", $cliente["facebook"]);
        $this->db->set("twitter", $cliente["twitter"]);
        $this->db->set("google", $cliente["google"]);
        $this->db->set("tipo", 0);
        $this->db->set("descricao", $cliente["description"]);
        $this->db->set("data", date("Y-m-d H:i:s"));
        $this->db->set("usuarios_id", $cliente["usuario"]);
        $this->db->set("ativo", 1);
        $this->db->set("chat_disponivel", 1);
        $this->db->set("plano_id", $cliente["plano"]);
        $this->db->set("tipo", 0);
        
        $this->db->insert("clientes");
        $clienteId = $this->db->insert_id();

        //insere categorias
        foreach ($cliente["categoria"] as $categoria) {
            $this->db->set("categoria", $categoria);
            $this->db->set("idcliente", $clienteId);
            $this->db->insert("clientes_categorias");
        }

        foreach ($cliente["sub_categoria"] as $sub_categoria) {
            $this->db->set("categoria", $sub_categoria);
            $this->db->set("idcliente", $clienteId);
            $this->db->insert("clientes_categorias");
        }


        // INSERE IMAGEM
        $this->db->set("clientes_id", $clienteId);
        $this->db->set("picture", $cliente["capa"]);
        $this->db->set("type", 1);
        $this->db->set("active", "active");
        $this->db->insert("clientes_picture");

        //INSERE ENDERECO
        $this->db->set("zip_code", $cliente["zip_code"]);
        $this->db->set("address", $cliente["address"]);
        $this->db->set("district", $cliente["district"]);
        $this->db->set("city", $cliente["city"]);
        $this->db->set("state", $cliente["state"]);
        $this->db->set("clientes_id", $clienteId);
        $this->db->insert("clientes_enderecos");

        //complete transaction
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            //algum erro ocorreu! 
            return false;
        }
        //retorna ID do anuncio
        return $clienteId;
    }

    function getClienteCompleteData($userId = false, $idCliente = false, $fields = false) {
        if ($fields) {
            if (is_array($fields)) {
                $fieldsStr = implode(",", $fields);
            } else {
                $fieldsStr = $fields;
            }
            $this->db->select($fieldsStr);
            $this->db->join("clientes_enderecos", "clientes.id = clientes_enderecos.clientes_id", "left");
            return $this->db->where("clientes.usuarios_id", $userId)->get("clientes")->row(0);
        }else if($userId==FALSE AND $idCliente==TRUE) {
            $this->db->select("*,clientes.descricao as descricao,clientes.id as id_clientes,planos.id as id_planos,clientes_enderecos.id  as clientes_enderecos_id");            
            $this->db->join("clientes_enderecos", "clientes.id = clientes_enderecos.clientes_id", "left");
            $this->db->join("planos", "planos.id = clientes.plano_id", "left");
            $this->db->where("clientes.id", $idCliente);
            return $this->db->get("clientes")->row(0);
        } else if($idCliente) {
            $this->db->select("*,clientes.descricao as descricao,clientes.id as id_clientes,planos.id as id_planos,clientes_enderecos.id  as clientes_enderecos_id");            
            $this->db->join("clientes_enderecos", "clientes.id = clientes_enderecos.clientes_id", "left");
            $this->db->join("planos", "planos.id = clientes.plano_id", "left");
            $this->db->where("clientes.id", $idCliente);
            $this->db->where("clientes.usuarios_id", $userId);
            return $this->db->get("clientes")->row(0);
        } else if ($userId){
            $this->db->select("*,clientes.id as id_clientes,planos.id as id_planos,clientes_enderecos.id  as clientes_enderecos_id");            
            $this->db->join("clientes_enderecos", "clientes.id = clientes_enderecos.clientes_id", "left");
            $this->db->join("planos", "planos.id = clientes.plano_id", "left");
            return $this->db->where("clientes.usuarios_id", $userId)->get("clientes")->result();
        } else {
            $this->db->select("*,clientes.id as id_clientes,planos.id as id_planos,clientes_enderecos.id  as clientes_enderecos_id");            
            $this->db->join("clientes_enderecos", "clientes.id = clientes_enderecos.clientes_id", "left");
            $this->db->join("planos", "planos.id = clientes.plano_id", "left");
            return $this->db->get("clientes")->result();
        }
    }

    function getAllClienteCompleteDataByCidade($cidade) {
            $this->db->select("*,clientes.id as id_clientes,planos.id as id_planos,clientes_enderecos.id  as clientes_enderecos_id");            
            $this->db->join("clientes_enderecos", "clientes.id = clientes_enderecos.clientes_id", "left");
            $this->db->join("planos", "planos.id = clientes.plano_id", "left");
            return $this->db->where("clientes_enderecos.city", $cidade['cidades'])->get("clientes")->result();
    }

    function getAllClienteCompleteData() {
        $this->db->select("*,clientes.id as id_clientes,planos.id as id_planos,clientes_enderecos.id  as clientes_enderecos_id");            
        $this->db->join("clientes_enderecos", "clientes.id = clientes_enderecos.clientes_id", "left");
        $this->db->join("planos", "planos.id = clientes.plano_id", "left");
        return $this->db->get("clientes")->result();
}

    function getOneClienteCompleteData($userId, $idCliente = false, $fields = false) {
        if ($fields) {
            if (is_array($fields)) {
                $fieldsStr = implode(",", $fields);
            } else {
                $fieldsStr = $fields;
            }
            $this->db->select($fieldsStr);
            $this->db->join("clientes_enderecos", "clientes.id = clientes_enderecos.clientes_id", "left");
            return $this->db->where("clientes.usuarios_id", $userId)->get("clientes")->row(0);
        } else if($idCliente) {
            $this->db->select("*,clientes.descricao as descricao,clientes.id as id_clientes,planos.id as id_planos,clientes_enderecos.id  as clientes_enderecos_id");            
            $this->db->join("clientes_enderecos", "clientes.id = clientes_enderecos.clientes_id", "left");
            $this->db->join("planos", "planos.id = clientes.plano_id", "left");
            $this->db->where("clientes.id", $idCliente);
            $this->db->where("clientes.usuarios_id", $userId);
            return $this->db->get("clientes")->row(0);
        } else {
            $this->db->select("*,clientes.id as id_clientes,planos.id as id_planos,clientes_enderecos.id  as clientes_enderecos_id");            
            $this->db->join("clientes_enderecos", "clientes.id = clientes_enderecos.clientes_id", "left");
            $this->db->join("planos", "planos.id = clientes.plano_id", "left");
            return $this->db->where("clientes.usuarios_id", $userId)->get("clientes")->row(0);
        }
    }
/** 
* Função para apagar registro
* Quando deletado o cliente, o banco irá deletar
* os registros nas tabelas (clientes, clientes_enderecos, clientes_picture)
* DELETE ON CASCADE UPDATE ON CASCADE
* @author J.S.Júnior
* @version 0.1 
* @access public  
* @package Cliente 
* @example $this->nomeModel->deleteCliente($idRegistroCliente);
*/ 
    function deleteCliente($idCliente) {
        $this->db->where("id", $idCliente);
        $this->db->delete("clientes");
    }
/** 
* Função para buscar as imagens do cliente
* @author J.S.Júnior
* @version 0.1 
* @access public  
* @package Cliente 
* @example $this->nomeModel->getClienteImage($idCliente);
*/ 
    function getClienteImage($idCliente) {
        $this->db->select("picture,id,active");
        $this->db->where('clientes_id', $idCliente);
        $picture = $this->db->get("clientes_picture")->result();
        return $picture;
    }

    function updateCLiente($idCliente, $cliente) {
        
                //START TRANSACTION
                $this->db->trans_start();
                //UPDATE clientes
                if (isset($cliente['name_company'])) {
                    $this->db->set('name_company', $cliente['name_company']);
                }
        
                $this->db->set('responsible', $cliente['responsible']);
                $this->db->set('phone', $cliente['phone']);
                $this->db->set('phone2', $cliente['phone2']);
                $this->db->set('site', $cliente['site']);
                // if (isset($cliente['id_categoria'])) {
                //     $this->db->set("id_categoria", $cliente["categoria"]);
                // }
                $this->db->set('facebook', $cliente['facebook']);
                $this->db->set('twitter', $cliente['twitter']);
                $this->db->set('google', $cliente['google']);
                $this->db->set('descricao', $cliente['description']);
        
                if (isset($cliente['email_user'])) {
                    $this->db->set('email', $cliente['email_user']);
                }
                $this->db->where("id", $idCliente);
                $this->db->update('clientes'); //TABELA DE clientes
                
                //insere categorias adicionadas
                foreach ($cliente["categoria"] as $categoria) {
                    if (!in_array($categoria, $cliente["todasCategorias"])) {
                        $this->db->set("categoria", $categoria);
                        $this->db->set("idcliente", $idCliente);
                        $this->db->insert("clientes_categorias");
                    }
                }
                //remove categorias retiradas
                foreach ($cliente["todasCategorias"] as $categoria) {
                    if (!in_array($categoria, $cliente["categoria"])) {
                        $this->db->where("categoria", $categoria);
                        $this->db->where("idcliente", $idCliente);
                        $this->db->delete("clientes_categorias");
                    }
                }
                
                //UPDATE clientes_ENDERECOS
                $this->db->set('zip_code', $cliente["zip_code"]);
                $this->db->set('address', $cliente["address"]);
                $this->db->set('district', $cliente["district"]);
                $this->db->set('city', $cliente["city"]);
                $this->db->set('state', $cliente["state"]);
                $this->db->where('clientes_id', $idCliente);
                $this->db->update('clientes_enderecos'); //TABELA DE ENDERECO DE clientes
        
                //COMPLETE TRANSACTION
                $this->db->trans_complete();
                return $this->db->trans_status();
            }
            function updateClientePassword($idCliente, $newPassword = false) {
                if ($newPassword === false) {
                    $newPassword = generateNewPassword();
                }
                $this->db->set("senha", md5($newPassword));
                $this->db->where("id", $idCliente);
                $this->db->update("clientes");
                return $newPassword;
            }
            function updateClienteRepresentante($idCliente, $newRepresentante) {
                $this->db->set("usuarios_id", $newRepresentante);
                $this->db->where("id", $idCliente);
                $this->db->update("clientes");
                return $newRepresentante;
            }
            function getClienteDetalhesCategorias($idCliente) {            
                return $this->getClienteCategoriasArray($idCliente);
            }

            function getClienteCategoriasArray($idcliente) {
                $this->db->select("categoria");
                $this->db->where("idcliente", $idcliente);
                $categorias = $this->db->get("clientes_categorias")->result();
                $categoriasCliente = array();
                foreach ($categorias as $categoria) {
                    $categoriasCliente[] = $categoria->categoria;
                }
                return $categoriasCliente;
            }
            function getClienteCategorias($idcliente) {
                $this->db->select("categoria");
                $this->db->where("idcliente", $idcliente);
                return $this->db->get("clientes_categorias")->result();
            }
            function getClienteAtivo($idCliente) {
                $this->db->select("ativo");
                $this->db->where('id', $idCliente);
                return $this->db->get("clientes")->row(0);
            }
            function updateBlockCliente($idCliente) {        
                        //START TRANSACTION
                        $this->db->trans_start();
                        $cliente=$this->getClienteAtivo($idCliente);
                        if($cliente->ativo==1){
                            $this->db->set('ativo', 0);
                        }else{
                            $this->db->set('ativo', 1);
                        }
        
                        $this->db->where("id", $idCliente);
                        $this->db->update('clientes'); //TABELA DE clientes
                
                        //COMPLETE TRANSACTION
                        $this->db->trans_complete();
                        return $this->db->trans_status();
            }
}
