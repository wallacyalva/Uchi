<?php

class Login_model extends CI_Model {

    function __construct()
    {
         parent::__construct();
    }

    function get_user($usernameEmail, $password) {
        $error = false;
        $usuarioLogin = $this->usuarioModel->getDadosByEmail($usernameEmail);
        if ($usuarioLogin) {
            //se encontrou usuario, confere a senha
            if ($usuarioLogin->senha == md5($password)) {
                //se estiver correto, joga na sessao e redireciona para o perfil
                $data = array(
                    'bs_user_id' => $usuarioLogin->id,
                    'is_logged_in' => true
                );
                $this->session->set_userdata($data);
                return TRUE;
            } else {
                //senha incorreta
                $error = "O username/email ou senha está incorreto.";
            }
        } else {
            //usuario invalido
            $error = "O username";
        }
        return $error;
    }

    function registerLogin($usuarioLogin) {
        $data = array(
            'bs_user_id' => $usuarioLogin["user_id"],
            'email' => $usuarioLogin["email"],
            'is_logged_in' => true
        );
        $this->session->set_userdata($data);
    }

    public function logout() {
        if (is_user_logged_in()) {
            //faz logout
            $this->session->sess_destroy();
        }
    }
}
