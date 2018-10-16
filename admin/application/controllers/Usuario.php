<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usuario_model', "usuarioModel");
        $this->load->model('ramos_model', "ramosModel");
    }

    public function index(){
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();

        $userId = $this->session->userdata("bs_user_id");
        $user = $this->usuarioModel->getUserCompleteData($userId);
        
        $data = array();
        $data['user'] = $user;
        $data['n_usu'] = $this->usuarioModel->getCount("usuario");
        $data['n_emp'] = $this->usuarioModel->getCount("empresa");
        $data['n_adm'] = $this->usuarioModel->getCount("administradores");

        $this->load->view('template/header_view');
        $this->load->view('usuario/dashboard_view', $data);
        $this->load->view('template/footer_view');
    }
    
    public function deletar() {
        echo json_encode($this->usuarioModel->deletarUsuario($this->input->post("cliente_to_remove")));
    }

    public function listar() {
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();
        $data = array();
        $data['user'] = $this->usuarioModel->getUserCompleteData($this->session->userdata("bs_user_id"));
        $data['usuarios'] = $this->usuarioModel->getAllUsuarios();
        $this->load->view('template/header_view');
        $this->load->view('usuario/listar_usuarios_view', $data);
        $this->load->view('template/footer_view');
    }

    public function editar($id_usuario = null) {
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();
        $data = array();
        $data['user'] = $this->usuarioModel->getUserCompleteData($this->session->userdata("bs_user_id"));

        if($input = $this->input->post()) {

            $this->form_validation->set_rules('name', "Nome", 'max_length[100]');
            $this->form_validation->set_rules('surname', "Sobrenome", 'max_length[100]');
            $this->form_validation->set_rules('email', "Email", 'max_length[250]');
            $this->form_validation->set_rules('ramo', "Ramo", 'max_length[100]');
            $this->form_validation->set_rules('new_password', 'Nova Senha', 'trim|strip_tags|min_length[6]|max_length[50]|matches[confirm_new_password]');
            $this->form_validation->set_rules('confirm_new_password', 'Nova Senha', 'trim|strip_tags');

            if ($this->form_validation->run() != FALSE) {
                  $this->usuarioModel->updateUsuario($input);     
                  redirect(base_url()."usuario/listar");
              }
        }



        $data['usuario'] = $this->usuarioModel->getUsuarioCompleteData($id_usuario);
        $data['ramos'] = $this->ramosModel->getAllRamos();
        $this->load->view('template/header_view');
        $this->load->view('usuario/editar_usuario_view', $data);
        $this->load->view('template/footer_view');
    }

    public function empreendedorClientes($empreendedorId){
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();
        $idUser = $empreendedorId;
        $data   = array();

        if ($this->input->post('cliente_to_remove')){
            $idCliente = $this->input->post('cliente_to_remove');

            $files=$this->usuarioModel->getClienteImage($idCliente);

            $old = getcwd(); // Save the current directory
            chdir("../uploads/images_profile");
            foreach($files as $file){
                unlink($file->picture);
            }  
            chdir($old);
            $this->usuarioModel->deleteCliente($idCliente);
        }

        $data['clientes']=$this->usuarioModel->getClienteCompleteData($idUser);

        $userId = $this->session->userdata("bs_user_id");
        $user = $this->usuarioModel->getUserCompleteData($userId);
        $data['user'] = $user;
        
        $this->load->view('template/header_view');
        $this->load->view('cliente/meus_clientes_view', $data);
        $this->load->view('template/footer_view');
    }

    public function profile(){
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();
 
        $userId = $this->session->userdata("bs_user_id");
        $user = $this->usuarioModel->getUserCompleteData($userId);

        $postArray = $this->input->post();
        $data = array();

        if ($this->input->post()) {
        $this->form_validation->set_rules('name', "Nome", 'required|strip_tags|max_length[100]');
        $this->form_validation->set_rules('apelido', "Apelido", 'required|strip_tags|max_length[100]');
        $this->form_validation->set_rules('phone', "Telefone", 'required|strip_tags|max_length[11]');

        if ($this->form_validation->run() != FALSE) {
          //  $postArray["birthdate"] = DateTime::createFromFormat('d/m/Y', $postArray["birthdate"])->format('Y-m-d');
            $this->usuarioModel->updateUser($userId, $postArray);
            $this->session->set_flashdata("msg", array("tipo" => "1", "texto" => "<strong>Muito Bem!!!</strong> Cadastro Atualizado com Sucesso.." ));        
            redirect(base_url()."usuario/profile");
        }
        
    }
    $success = $this->session->flashdata("successPassword");
    if ($success) {
        $data["successPassword"] = $success;
    }
    $error = $this->session->flashdata("errorPassword");
    if ($error) {
        $data["errorPassword"] = $error;
    }

        $data['user'] = $user;

        $this->load->view('template/header_view');
        $this->load->view('usuario/meus_dados_view', $data);
        $this->load->view('template/footer_view');
    }

    public function usuarios(){
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();
 
        $userId = $this->session->userdata("bs_user_id");
        $user = $this->usuarioModel->getUserCompleteData($userId);
        $users = $this->usuarioModel->getAllUser();
        $data = array();

        if ($this->input->post('usuario_to_remove')){
            $idUsuario = $this->input->post('usuario_to_remove');

            $getImage=$this->usuarioModel->getUserImage($idUsuario);
            if($getImage){
                $old = getcwd(); // Save the current directory
                chdir("uploads/images/users/");
                $file = $this->usuarioModel->getUserImage($idUsuario);
                $filnenewName=explode(".", $file->avatar);
                if($filnenewName[0]=="no-image"){
    
                }else{
                    $original=$filnenewName[0].".".$filnenewName[2];
                    unlink($original);
                    unlink($file->avatar);
                    chdir($old);
                }
            }

            $this->usuarioModel->deleteUsuario($idUsuario);
        }
        else if($this->input->post('usuario_to_admin')){
            $this->usuarioModel->updateUsuarioToAdmin($this->input->post('usuario_to_admin'));
        }



        $data['users'] = $users;
        $data['user'] = $user;

        $this->load->view('template/header_view');
        $this->load->view('usuario/meus_usuarios_view', $data);
        $this->load->view('template/footer_view');
    }
    public function propostas(){
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();
 
        $userId = $this->session->userdata("bs_user_id");
        $user = $this->usuarioModel->getUserCompleteData($userId);
        $users = $this->usuarioModel->getAllUserPropostas();
        $data = array();

        if ($this->input->post('usuario_to_remove')){
            $idUsuario = $this->input->post('usuario_to_remove');

            $getImage=$this->usuarioModel->getUserImage($idUsuario);
            if($getImage){
                $old = getcwd(); // Save the current directory
                chdir("uploads/images/users/");
                $file = $this->usuarioModel->getUserImage($idUsuario);
                $filnenewName=explode(".", $file->avatar);
                if($filnenewName[0]=="no-image"){
    
                }else{
                    $original=$filnenewName[0].".".$filnenewName[2];
                    unlink($original);
                    unlink($file->avatar);
                    chdir($old);
                }
            }

            $this->usuarioModel->deleteUsuario($idUsuario);
        }
        else if($this->input->post('usuario_to_admin')){
            $this->usuarioModel->updateUsuarioToAdmin($this->input->post('usuario_to_admin'));
        }
        else if($this->input->post('usuario_to_empreendedor')){
            $this->usuarioModel->updateUsuarioToEmp($this->input->post('usuario_to_empreendedor'));
        }



        $data['users'] = $users;
        $data['user'] = $user;

        $this->load->view('template/header_view');
        $this->load->view('usuario/propostas_view', $data);
        $this->load->view('template/footer_view');
    }


    public function new(){
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();
 
        $userId = $this->session->userdata("bs_user_id");
        $user = $this->usuarioModel->getUserCompleteData($userId);

        $postArray = $this->input->post();
        $data = array();

        if ($this->input->post()) {
        $this->form_validation->set_rules('name', "Nome", 'required|strip_tags|max_length[200]|alpha_numeric');
        
        if ($this->form_validation->run() != FALSE) {

            $this->usuarioModel->insertUsuario($postArray);

            $this->session->set_flashdata("msg", array("tipo" => "1", "texto" => "<strong>Muito Bem!!!</strong> Usuário Cadastro Atualizado com Sucesso.." ));        
            redirect("usuario/new");
        }
        
    }
        $data['user'] = $user;

        $this->load->view('template/header_view');
        $this->load->view('usuario/new_usuario_view', $data);
        $this->load->view('template/footer_view');
    }

    public function change_password() {
        if (!is_user_logged_in()) {
            redirect("login");
        }
        $this->form_validation->set_rules('new_password', 'new_password', 'trim|required|strip_tags|min_length[6]|max_length[50]|matches[confirm_new_password]');
        $this->form_validation->set_rules('confirm_new_password', 'confirm_new_password', 'trim|required|strip_tags');
        if ($this->form_validation->run() != FALSE) {
            $data = $this->input->post();
            $userId = $this->session->userdata("bs_user_id");

            $this->usuarioModel->updateUserPassword($userId, $data["new_password"]);

            $this->session->set_flashdata("msg", array("tipo" => "1", "texto" => "<strong>Muito Bem!</strong> Senha Atualizada com Sucesso" ));
            redirect("usuario/profile");
        }
        $error = '';
        foreach ($_POST as $key => $field) {
            if (form_error($key)) {
                $error .= strip_tags(form_error($key));
                break;
            }
        }
        if (!$error) {
            $error = $this->lang->line("all_fields_required");
        }
        $this->session->set_flashdata("msg", array("tipo" => "2", "texto" => "<strong>Ops!!!</strong> Ocorreu um erro ao tentar ataulizar sua senha." ));        
        redirect("usuario/profile");
    }


    public function changePhoto() {
        if (!is_user_logged_in()) {
            redirect("login");
        }
        $userId = $this->session->userdata("bs_user_id");

        $config['upload_path']      = "uploads/images/users/";
        $config['allowed_types']    = 'jpg|jpeg|JPG|JEPG|png|PNG';
        $config['file_name']        = $userId . "_".time();
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload("file")) {
            $this->session->set_flashdata("msg", array("tipo" => "2", "texto" => "<strong>Ops!!!</strong>".$this->upload->display_errors()."" ));     
            //redirect("cliente/new_cliente");
        }
        $getImage=$this->usuarioModel->getUserImage($userId);
        if($getImage){
            $old = getcwd(); // Save the current directory
            chdir("uploads/images/users/");
            $file = $this->usuarioModel->getUserImage($userId);
            $filnenewName=explode(".", $file->avatar);
            if($filnenewName[0]=="no-image"){

            }else{
                $original=$filnenewName[0].".".$filnenewName[2];
                unlink($original);
                unlink($file->avatar);
                chdir($old);
            }
        }

        $newNameImage=$config['file_name']."".$this->upload->file_ext;
        $fileFullPath=base_url().'uploads/images/users/'.$newNameImage;
        $config['image_library'] = 'gd2';
        $config['source_image'] = 'uploads/images/users/'.$newNameImage;
        //SE TRUE CRIA UM THUNMB DA IMAGEM
        $config['create_thumb'] = false;
        //SE TRUE DA UM RESIZE MANTENDO A PROPORCAO DO WIDTH
        $config['maintain_ratio'] = true;
        $config['width']         = 500;
        //$config['height']       = 200;
        
        $this->load->library('image_lib', $config);          
        $this->image_lib->resize();

        $this->usuarioModel->updateUserImage($userId,$newNameImage);
       // return $fileFullPath;

       echo "<input type='hidden' name='cp_name_img' id='cp_name_img' value='".$newNameImage."'/>
       <img id='crop_image' src=".$fileFullPath." >";

    }

    public function cropPhoto() {
        if (!is_user_logged_in()) {
            redirect("login");
        }
       $userId = $this->session->userdata("bs_user_id");
       
       $file = $this->usuarioModel->getUserImage($userId); 
       $pach = base_url().'uploads/images/users/'.$file->avatar;
       $pachBeCrop = 'uploads/images/users/'.$file->avatar;
       
    //    echo $this->input->post("cp_img_path");
    $img_width  = 220;
    $img_height = 220;
    
    
    $setings='{"img_width":'.$img_width.',"img_height":'.$img_height.',"x":'.$this->input->post("ic_x").',"y":'.$this->input->post("ic_y").',"height":'.$this->input->post("ic_h").',"width":'.$this->input->post("ic_w").',"rotate":0}';
    
    $params ["patch_src"] = $pachBeCrop;
    $params ["patch_dst"] = $pachBeCrop;
    $params ["setings"] = $setings;
    $params ["sigla"] = "avatar";

        $this->load->library('cropavatar',$params);  
       // $this->cropavatar->crop($pachBeCrop,$pachBeCrop,$setings);
      $result= $this->cropavatar->getResult();
    
      
      $filnenewName=explode(".", $file->avatar);
      $filenameAvatar=$filnenewName[0].".avatar.".$filnenewName[1];
      $this->usuarioModel->updateUserImage($userId,$filenameAvatar);

      echo "<img id='img' src='".base_url().$result."' class='img-thumbnail' >";
     
    }
}