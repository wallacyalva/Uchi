<?php

class Usuario_model extends CI_Model {

    public function __construct() {
	    parent:: __construct();
    }

    function getAllUsuarios() {
        $this->db->select("*");
        return $this->db->get("usuario")->result();
    }

    function getCount($which) {
        $this->db->select("COUNT(id) as count");
        return $this->db->get($which)->row(0);
    }

    function getUsuarioCompleteData($id_usuario) {
        $this->db->select("*, usuario_address.id as id_address, usuario_personal_data.id as id_personal_data");
        $this->db->where("usuario.id", $id_usuario);
        $this->db->join("usuario_address", "usuario_address.id_usuario = usuario.id", "left");
        $this->db->join("usuario_personal_data", "usuario_personal_data.id_usuario = usuario.id", "left");
        return $this->db->get("usuario")->row(0);
    }

    function deletarUsuario($id_usuario) {
        $this->db->where("id", $id_usuario);
        return $this->db->delete("usuario");
    }

    function updateUsuario($usuario) {
        if(isset($usuario['name'])) {
            $this->db->set("name", $usuario['name']);
        }
        if(isset($usuario['surname'])) {
            $this->db->set("surname", $usuario['surname']);
        }
        if(isset($usuario['ramo'])) {
            $this->db->set("ramo", $usuario['ramo']);
        }
        if(isset($usuario['confirm_new_password'])) {
            $this->db->set("password", $usuario['confirm_new_password']);
        }
        $this->db->where("id", $usuario['id']);
        return $this->db->update("usuario");
    }

    function deleteCliente($idCliente) {
        $this->db->where("id", $idCliente);
        $this->db->delete("clientes");
    }

    function getClienteImage($idCliente) {
        $this->db->select("picture,id,active");
        $this->db->where('clientes_id', $idCliente);
        $picture = $this->db->get("clientes_picture")->result();
        return $picture;
    }

    function getClienteCompleteData($userId, $idCliente = false, $fields = false) {
        if ($fields) {
            if (is_array($fields)) {
                $fieldsStr = implode(",", $fields);
            } else {
                $fieldsStr = $fields;
            }
            $this->db->select($fieldsStr);
            $this->db->join("clientes_enderecos", "clientes.id = clientes_enderecos.clientes_id", "left");
            return $this->db->where("clientes.id_usuario", $userId)->get("clientes")->row(0);
        } else if($idCliente) {
            $this->db->select("*,clientes.descricao as descricao,clientes.id as id_clientes,planos.id as id_planos,clientes_enderecos.id  as clientes_enderecos_id");            
            $this->db->join("clientes_enderecos", "clientes.id = clientes_enderecos.clientes_id", "left");
            $this->db->join("planos", "planos.id = clientes.plano_id", "left");
            $this->db->where("clientes.id", $idCliente);
            $this->db->where("clientes.id_usuario", $userId);
            return $this->db->get("clientes")->row(0);
        } else {
            $this->db->select("*,clientes.id as id_clientes,planos.id as id_planos,clientes_enderecos.id  as clientes_enderecos_id");            
            $this->db->join("clientes_enderecos", "clientes.id = clientes_enderecos.clientes_id", "left");
            $this->db->join("planos", "planos.id = clientes.plano_id", "left");
            return $this->db->where("clientes.id_usuario", $userId)->get("clientes")->result();
        }
    }
    
	function getDadosByEmail($usuarioEmail, $fields = false) {
        if ($fields) {
            if (is_array($fields)) {
                $fieldsStr = implode(",", $fields);
            } else {
                $fieldsStr = $fields;
            }
            return $this->db->select($fieldsStr)->where("apelido", $usuarioEmail)->get("administradores")->row(0);
        } else {
            return $this->db->where("apelido", $usuarioEmail)->get("administradores")->row(0);
        }
    }
    
    function getUserImage($usuarioId) {
        $this->db->select("avatar");
        $this->db->where('id', $usuarioId);
        $picture = $this->db->get("administradores")->row(0);
        return $picture;
    }

    function updateUserImage($usuarioId,$avatar) {
        $this->db->trans_start();

        $this->db->set('avatar', $avatar);

        $this->db->where('id', $usuarioId);
        $this->db->update('administradores');
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
	   
    public function checkUsuario($email, $password) {
		$password = md5($password);
		$this->db->select('email', 'senha');
		$this->db->from('administradores');
		$this->db->where('email', $email);
		$this->db->where('senha', $password);
		$query = $this->db->get();
		return $query->num_rows() == 1 ? true:false;
    }
	
	function getUserCompleteData($userId, $fields = false) {
        if ($fields) {
            if (is_array($fields)) {
                $fieldsStr = implode(",", $fields);
            } else {
                $fieldsStr = $fields;
            }
            $this->db->select($fieldsStr);
            return $this->db->where("usuario.id", $userId)->get("administradores")->row(0);
        } else {
            $this->db->select("*");            
            return $this->db->where("id", $userId)->get("administradores")->row(0);
        }
    }

    function getRandonUserCompleteData($fields = false) {
        if ($fields) {
            if (is_array($fields)) {
                $fieldsStr = implode(",", $fields);
            } else {
                $fieldsStr = $fields;
            }
            $this->db->select($fieldsStr);
            $this->db->join("usuario_address", "usuario.id = usuario_address.id_usuario", "left");
            return $this->db->where("usuario.id", $userId)->get("administradores")->row(0);
        } else {
            $this->db->select("*,usuario_address.id as id_usuario_address");            
            $this->db->join("usuario_address", "usuario.id = usuario_address.id_usuario", "left");
            $this->db->order_by("RAND(), usuario.id ASC");
            return $this->db->get("administradores")->row(0);
        }
    }
	
    function getAllClients($userId = false) {
        $this->db->distinct();
        if($userId) {
            $this->db->select("*");
            $this->db->where("id_usuario", $userId);
            $total = $this->db->count_all_results("clientes");
            return $total;
        } else {
            $total = $this->db->count_all_results("clientes");
            return $total;
        }
    }
    
    function getAllPayedClients($userId = false) {
        $this->db->distinct();
        if($userId) {
            $this->db->where("id_usuario", $userId);
            $this->db->where("plano_id !=", 0);
            $total = $this->db->count_all_results("clientes");
            return $total;
        } else {
            $this->db->where("plano_id !=", 0);            
            $total = $this->db->count_all_results("clientes");
            return $total;
        }
    }
    
    function getAllNegativeClients($userId = false) {
        $this->db->distinct();
        if($userId) {
            $this->db->where("usuario_pai", $userId);
            $this->db->where("status_mensalidade", 2);
            $total = $this->db->count_all_results("financeiro_clientes");
            return $total;
        } else {
            $this->db->where("status_mensalidade", 2);            
            $total = $this->db->count_all_results("financeiro_clientes");
            return $total;
        }
    }
    
    function getUserCompleteDataByCidade($cidade) {
        $this->db->select("*,usuario_address.id as id_usuario_address");            
        $this->db->join("usuario_address", "usuario.id = usuario_address.id_usuario", "left");
        return $this->db->where("usuario_address.city", $cidade["cidades"])->get("administradores")->result();
    }

    function getAllUser() {
        $this->db->select("*, financeiro_usuario.id_f_user as financeiro_id, usuario.id as id_usuario");
        $this->db->join("financeiro_usuario", "usuario.id = financeiro_usuario.user_id", "left");
        return $this->db->get("administradores")->result();
	}
	function getAllUserPropostas() {
        $this->db->select("*");
        $this->db->where('rule', 5);
        return $this->db->get("administradores")->result();
	}
    
    function getUserRule($userId) {
        $this->db->select("rule");
        $this->db->where("id", $userId);
        return $this->db->get("administradores")->row(0);
	}
    
    function deleteUsuario($idUsuario) {
        $this->db->where("id", $idUsuario);
        $this->db->delete("administradores");
    }

    function updateUser($userId, $usuario) {
        
                //START TRANSACTION
                $this->db->trans_start();
                //UPDATE clientes
                if (isset($usuario['name'])) {
                    $this->db->set('nome', $usuario['name']);
                }

                if (isset($usuario['phone'])) {
                    $this->db->set('telefone', $usuario['phone']);
                }

                if (isset($usuario['apelido'])) {
                    $this->db->set('apelido', $usuario['apelido']);
                }

                $this->db->where("id", $userId);
                $this->db->update('administradores'); //TABELA DE clientes
        
                //COMPLETE TRANSACTION
                $this->db->trans_complete();
                return $this->db->trans_status();
    }

    function updateUserAdmin($idUser,$idUserUpdate, $usuario) {
        
        //START TRANSACTION
        $this->db->trans_start();
        //UPDATE clientes
        if (isset($usuario['name'])) {
            $this->db->set('name', $usuario['name']);
        }
        if (isset($usuario['password'])) {
            $this->db->set('senha', md5($usuario['password']));
        }

        $this->db->set('phone', $usuario['phone']);

        if (isset($usuario['username_email'])) {
            $this->db->set('email', $usuario['username_email']);
        }

        $this->db->where("id", $idUserUpdate);
        $this->db->update('usuario'); //TABELA DE clientes

        //UPDATE clientes_ENDERECOS
        $this->db->set('zip_code', $usuario["zip_code"]);
        $this->db->set('address', $usuario["address"]);
        $this->db->set('district', $usuario["district"]);
        $this->db->set('city', $usuario["city"]);
        $this->db->set('state', $usuario["state"]);
        $this->db->where('id_usuario', $idUserUpdate);
        $this->db->update('usuario_address'); //TABELA DE ENDERECO DE clientes

        //COMPLETE TRANSACTION
        $this->db->trans_complete();
        return $this->db->trans_status();
}

    function insertUsuario($dados) {
        //inicia transacao
        $this->db->trans_start();

        $this->db->set("email", $dados["username_email"]);
        $this->db->set("senha", md5($dados["password"]));
        $this->db->set("rule", 3);
        $this->db->set("name", $dados["name"]);
        $this->db->set("phone", $dados["phone"]);
        $this->db->set("avatar", "no-image.jpg");
        $this->db->insert("administradores");
        $idUsuario = $this->db->insert_id();


        //INSERE ENDERECO
        $this->db->set("zip_code", $dados["zip_code"]);
        $this->db->set("address", $dados["address"]);
        $this->db->set("district", $dados["district"]);
        $this->db->set("city", $dados["city"]);
        $this->db->set("state", $dados["state"]);
        $this->db->set("id_usuario", $idUsuario);
        $this->db->insert("usuario_address");

        //INSERE FINCEIRO
        $this->db->set("user_id", $idUsuario);
        $this->db->set("mensalidade", $dados["mensalidade"]);
        $this->db->set("percentual", $dados["percentual"]);
        $this->db->set("status", 1);
        $this->db->insert("financeiro_usuario");
        //complete transaction
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            //algum erro ocorreu! 
            return false;
        }
        //retorna ID do anuncio
        return $idUsuario;
    }

    function getAllPedidos() {
        return $this->db->select("*")->get("parceiros_interessados")->result();
    }

    function getUserAleatorio($cidade ,$estado){
        $this->db->select("usuario.id");
        $this->db->join("usuario_address", "usuario.id = usuario_address.id_usuario", "left");
        $this->db->where("city", $cidade);
        $this->db->where("state", $estado);
        $this->db->order_by("RAND(), usuario.id ASC");
        return $this->db->get("administradores")->row(0);
    }

    function updateUserPassword($userId, $newPassword = false) {
            if ($newPassword === false) {
                $newPassword = generateNewPassword();
            }
            $this->db->set("senha", md5($newPassword));
            $this->db->where("id", $userId);
            $this->db->update("administradores");
            return $newPassword;
        }

    public function isLoggedIn()
	{
		if(!$this->session->has_userdata('logged_in')){
			redirect('login/logout');
		}
    }
    function getOneUserRule($idUser) {
        $this->db->select("rule");
        $this->db->where('id', $idUser);
        return $this->db->get("administradores")->row(0);
	}
    function updateUsuarioToAdmin($userId) {        
        //START TRANSACTION
        $this->db->trans_start();
        $rule=$this->getOneUserRule($userId);
        if($rule->rule==1){
            $this->db->set('rule', 3);
        }else{
            $this->db->set('rule', 1);
        }

        $this->db->where("id", $userId);
        $this->db->update('usuario'); //TABELA DE clientes

        //COMPLETE TRANSACTION
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
    function updateUsuarioToEmp($userId) {        
        //START TRANSACTION
        $this->db->trans_start();
        $rule=$this->getOneUserRule($userId);
        if($rule->rule==5){
            $this->db->set('rule', 3);
        }else{
            $this->db->set('rule', 5);
        }

        $this->db->where("id", $userId);
        $this->db->update('usuario'); //TABELA DE clientes

        //COMPLETE TRANSACTION
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

}
