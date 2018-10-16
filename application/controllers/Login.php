<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Login extends CI_Controller {

        public function __construct() {
           parent::__construct();
           $this->load->model('empresa_model', "empresaModel");
           $this->load->model('login_model', "loginModel");
           $this->load->model('user_model', "userModel");
        }
    
        public function index(){
            if($this->loginModel->isLoggedIn()){
                if($this->session->userdata("is_user")){
                    redirect("usuario");
                } else {
                    redirect("empresa");
                }
            } else {
                $this->load->view('login/login_view');
            }
        }
        
        public function registrar(){
        /**
         * Cria array para variavel data.
         * Insre no array os input do post
         */
        $data = array();
        $data = $this->input->post();

            if($this->input->post()) {
                $this->form_validation->set_rules('name', "Nome", 'required|strip_tags|max_length[200]|alpha_numeric');
                    $this->userModel->registerUser($data);
                    $this->session->set_flashdata("msg", array("tipo" => "1", "texto" => "<strong>Muito Bem!!!</strong> Cadastro realizado com Sucesso.." ));        
                    redirect("login");
            }
            $this->load->view('login/registrar_view');
        }
        
        public function setLocation() {
            $post = $this->input->post();
            $this->load->library('session');
            $userData = array(
                    'cidade' => $post["cidade"],
                    'estado' => $post["estado"]
            );
            $this->session->set_userdata($userData);
        }

        public function registrarempresa(){
            /**
             * Cria array para variavel data.
             * Insre no array os input do post
             */
            $data = array();
            $data = $this->input->post();
    
                if($this->input->post()) {
                    $this->form_validation->set_rules('name', "Nome", 'required|strip_tags|max_length[200]|alpha_numeric');
                        $this->empresaModel->registerEmpresa($data);
                        $this->session->set_flashdata("msg", array("tipo" => "1", "texto" => "<strong>Muito Bem!!!</strong> Cadastro realizado com Sucesso.." ));        
                        redirect("login");
                }
                $this->load->view('login/registrar_view');
            }
        /**
         * Metodo para logar em ajax
         */
        public function check_user()
        {
            $username = $this->input->post('email');
            $password = $this->input->post('password');
          
            $result['status'] = $this->loginModel->get_user($username,$password);
            
            if($this->session->userdata("is_user")){
                $result['is_user'] = true;
            } else {
                $result['is_user'] = false;
            }

            if($result){
                /*set session and save name and uid*/
                $this->load->library('session');
                $userData = array(
                        'logged_in' => true 
                );
                $this->session->set_userdata($userData);
            }
            echo json_encode($result);
        }
        
        public function logout()
        {
            $this->loginModel->logout();
            redirect('login');
        }
}