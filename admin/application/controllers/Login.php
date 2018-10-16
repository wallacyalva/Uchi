<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Login extends CI_Controller {

        public function __construct() {
           parent::__construct();
           $this->load->model('usuario_model', "usuarioModel");
           $this->load->model('login_model', "loginModel");
        }
    
        public function index(){
            $this->load->view('login/login_view');
        }
        
        
	public function check_user()
	{
		$username = $this->input->post('username_email');
		$password = $this->input->post('password');
		$result['status'] = $this->loginModel->get_user($username,$password);
		if($result){
			/*set session and save name and uid*/
			$this->load->library('session');

			$userData = array(
					'logged_in' => true 
			);
			$this->session->set_userdata($userData);
		}
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: Content-Type");
		echo json_encode($result);
    }
    
    public function logout()
	{
		$this->session->unset_userdata('logged_in');
		redirect('login');
    }
    
}