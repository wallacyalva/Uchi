<?php

class Login_model extends CI_Model {

    function get_user($email, $password) {
        $error = false;
        $usuarioLogin = $this->userModel->getDadosByUserEmail($email, array("id", "email", "password","Is_user"));
        $empresaLogin = $this->empresaModel->getDadosByEmpresaEmail($email, array("id", "email", "password"));
        if ($usuarioLogin->Is_user == "1" ) {
            //se encontrou usuario, confere a senha
            if ($usuarioLogin->password == md5($password)) {
                //se estiver correto, joga na sessao e redireciona para o perfil
                $data = array(
                    'bs_user_id' => $usuarioLogin->id,
                    'email' => $usuarioLogin->email,
                    'is_user' => true,
                    'is_logged_in' => true
                );
                
                $this->session->set_userdata($data);
                return TRUE;
            } else {
                //senha incorreta
                $error = "O username/email ou senha do usuario está incorreto.";
            }
        } else if($usuarioLogin->Is_user == "0" ){
            //se encontrou empresa, confere a senha
            if ($usuarioLogin->password == md5($password)) {
                //se estiver correto, joga na sessao e redireciona para o perfil
                $data = array(
                    'bs_user_id' => $usuarioLogin->id,
                    'email' => $usuarioLogin->email,
                    'is_user' => false,
                    'is_logged_in' => true
                );
                
                $this->session->set_userdata($data);
                return TRUE;
            } else {
                //senha incorreta
                $error = "O username/email ou senha da empresa está incorreto.";
            }
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
            redirect("");
        }
    }

    public function isLoggedIn()
	{
		if($this->session->userdata('is_logged_in')){
			return true;
		} else {
            return false;
        }
	}
}