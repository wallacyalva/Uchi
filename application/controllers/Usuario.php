<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Usuario extends CI_Controller {

        public function __construct() {
           parent::__construct();

           $this->load->model('empresa_model', "empresaModel");
           $this->load->model('login_model', "loginModel");
           $this->load->model('user_model', "usuarioModel");
        }

        public function index() {

            if($this->loginModel->isLoggedIn()) {
    
                $this->perfil();
    
            } else {
    
                redirect("login");
    
            }
        }

        public function perfil($usuarioId = null) {

            if($this->loginModel->isLoggedIn()) {
                if($usuarioId) {
                    if($this->session->userdata("is_user")) {

                        $iduser = $this->session->userdata("bs_user_id");

                        if($usuarioId == $iduser) {
                            redirect(base_url("usuario"));
                        }

                        $data = array();
                        
                        if($data['usuario'] = $this->usuarioModel->getUserCompleteData($usuarioId)) {

                            $data['user'] = $this->usuarioModel->getUserCompleteData($iduser);
                            $data['posts'] = $this->usuarioModel->getUserPosts($usuarioId);
                            $data['pedidos'] = $this->usuarioModel->getUserPedidos($iduser);
                            $data['notificacoes'] = $this->usuarioModel->getUserNotificacoes($iduser);
                            $data['mensagens'] = $this->usuarioModel->getUserMensagens($iduser);
                            $data['estadoAmizade'] = $this->usuarioModel->getUserEstadoAmizade($iduser,$usuarioId);                            
                            $data['amizades'] = $this->usuarioModel->getAmizades($usuarioId);
                            $data['recomendacoes'] = $this->usuarioModel->getRecomendacoes($usuarioId);
                            $data['responder'] = $this->responder();
                            
                            
                            $this->load->view('template/header_view', $data);
                            $this->load->view('user/geral_perfil_usuario');
                            $this->load->view('template/footer_view');

                        } else { 
                            redirect(base_url("usuario"));
                        }

                    } else {

                        $idempresa = $this->session->userdata("bs_user_id");

                        $data = array();

                        $data['usuario'] = $this->usuarioModel->getUserCompleteData($usuarioId);
                        $data['emp'] = $this->empresaModel->getEmpresaCompleteData($idempresa);
                        $data['posts'] = $this->usuarioModel->getUserPosts($usuarioId);
                        $data['pedidos'] = $this->usuarioModel->getUserPedidos($idempresa);
                        $data['notificacoes'] = $this->usuarioModel->getUserNotificacoes($idempresa);
                        $data['mensagens'] = $this->usuarioModel->getUserMensagens($idempresa);
                        $data['estadoAmizade'] = $this->usuarioModel->getUserEstadoAmizade($idempresa,$usuarioId);
                        $data['amizades'] = $this->usuarioModel->getAmizades($usuarioId);                            
                        $data['responder'] = $this->responder();
                        $data['recomendacoes'] = $this->usuarioModel->getRecomendacoes($usuarioId);


                        $this->load->view('template/header_view', $data);
                        $this->load->view('user/geral_perfil_usuario');
                        $this->load->view('template/footer_view');

                    }
                } else {

                    if(!$this->session->userdata("is_user")) {
                        redirect("empresa");
                    }


                        $iduser = $this->session->userdata("bs_user_id");

                        $data = array();
        
                        $data['user'] = $data['usuario'] = $this->usuarioModel->getUserCompleteData($iduser);
                        $data['posts'] = $this->usuarioModel->getUserPosts($iduser);
                        $data['pedidos'] = $this->usuarioModel->getUserPedidos($iduser);
                        $data['notificacoes'] = $this->usuarioModel->getUserNotificacoes($iduser);
                        $data['mensagens'] = $this->usuarioModel->getUserMensagens($iduser);
                        $data['recomendacoes'] = $this->usuarioModel->getRecomendacoes($iduser);
                        $data['responder'] = $this->responder();
                        

        
                        $this->load->view('template/header_view', $data);
                        $this->load->view('template/usuario_top_info_view', $data);
                        $this->load->view('user/user_perfil_view');
                        $this->load->view('template/footer_view');
                }

            } else {

                redirect("login");
                
            }
        }

        public function solicitarAmigo($usuarioId){
          
            $iduser = $this->session->userdata("bs_user_id");
            $this->usuarioModel->fazerPedido($iduser,$usuarioId);
            $this->usuarioModel->fazerNotificacao($iduser,$usuarioId);
            redirect("usuario/perfil/".$usuarioId);
        }
        
        public function newAmigo($usuarioId,$resposta,$notificacao){
            $iduser = $this->session->userdata("bs_user_id");
            $this->usuarioModel->ResponderPedido($iduser,$usuarioId,$resposta,$notificacao);
            if($resposta == '1'){
                $this->usuarioModel->mandarNorificacaoDeAmizade($iduser,$usuarioId);
                $this->usuarioModel->mandarNorificacaoDeAmizade($usuarioId,$iduser);
            }
            redirect("usuario");
        }

        public function responder(){
            return array(
                "id_recebedor" => "0","id_emisor" => "0","nome_emisor" => "joao", "texto" => "abobrinha"
            );
        }

        public function vizualizarNotificacao($id_notificacao, $id_paraIr = null){
            $this->usuarioModel->vizualizar($id_notificacao);
            redirect("usuario/perfil/".$id_paraIr);
        }
        public function vizualizarNotificacaoTodas($id_notificado,$tipo, $id_paraIr = null){
            $this->usuarioModel->vizualizarTodas($id_notificado,$tipo);
            redirect("usuario/perfil/".$id_paraIr);
        }

        public function todasNotificacoes($tipo){
            $iduser = $this->session->userdata("bs_user_id");

            $data = array();

            $data['user'] = $data['usuario'] = $this->usuarioModel->getUserCompleteData($iduser);
            $data['posts'] = $this->usuarioModel->getUserPosts($iduser);
            $data['pedidos'] = $this->usuarioModel->getUserPedidos($iduser);
            $data['notificacoes'] = $this->usuarioModel->getUserNotificacoes($iduser);
            $data['mensagens'] = $this->usuarioModel->getUserMensagens($iduser);
            $data['recomendacoes'] = $this->usuarioModel->getRecomendacoes($iduser);
            $data['responder'] = $this->responder();
            switch ($tipo) {
                case 'mensagem':
                $data['mensagens_todos'] = $this->usuarioModel->getUserMensagens($iduser, false);
                    break;
                case 'notificacoes':
                    $data['notificacoes_todos'] = $this->usuarioModel->getUserNotificacoes($iduser,false);
                    break;
                case 'pedidos':
                $data['pedidos_todos'] = $this->usuarioModel->getUserPedidos($iduser, false );
                    break;
                default:
                redirect("index");
                    break;
            }


            $this->load->view('template/header_view', $data);
            $this->load->view('template/usuario_top_info_view', $data);
            switch ($tipo) {
                case 'mensagem':
                $this->load->view('Notificacoes/Mensagens_view', $data);
                    break;
                case 'notificacoes':
                    $this->load->view('Notificacoes/Notificacoes_view.', $data);
                    break;
                case 'pedidos':
                $this->load->view('Notificacoes/pedidos_view', $data);
                    break;
                
                default:
                redirect("index");
                    break;
            }
            $this->load->view('template/footer_view');
        }
        
        public function enviarMensagem($de,$para){
            $mensagem = $this->input->post("mensagem");
            $this->usuarioModel->enviarSms($de,$para,$mensagem);
            redirect("usuario");
        }
        public function pegarCertaMensagem(){
            $this->input->post();
        }

        public function recomendar($recomendado){
            $recomendando = $this->session->userdata("bs_user_id");
            $estrelas = $this->input->post("estrelas");
            $texto = $this->input->post("Recomendacao");
            $this->usuarioModel->recomendar($recomendando,$recomendado,$estrelas,$texto);
            redirect("usuario/perfil/".$recomendado);
        }

        public function Pesquisar(){
           $vaga=$this->input->post("pesquisaPrinc");
            $iduser = $this->session->userdata("bs_user_id");
            $data = array();


            $data['user'] = $data['usuario'] = $this->usuarioModel->getUserCompleteData($iduser);
            $data['vaga'] = $this->usuarioModel->Pesquisar($vaga);
            $data['posts'] = $this->usuarioModel->getUserPosts($iduser);
            $data['pedidos'] = $this->usuarioModel->getUserPedidos($iduser);
            $data['notificacoes'] = $this->usuarioModel->getUserNotificacoes($iduser);
            $data['mensagens'] = $this->usuarioModel->getUserMensagens($iduser);
            $data['recomendacoes'] = $this->usuarioModel->getRecomendacoes($iduser);
            $data['responder'] = $this->responder();
            
            $this->load->view('template/header_view', $data);
            $this->load->view('user/Resposta_view');
            $this->load->view('template/footer_view');
        }

        public function vagas() {
            $iduser = $this->session->userdata("bs_user_id");

            $data = array();

            $data['user'] = $data['usuario'] = $this->usuarioModel->getUserCompleteData($iduser);
            $data['vaga'] = $this->empresaModel->getAllVagas();
            $data['posts'] = $this->usuarioModel->getUserPosts($iduser);
            $data['pedidos'] = $this->usuarioModel->getUserPedidos($iduser);
            $data['notificacoes'] = $this->usuarioModel->getUserNotificacoes($iduser);
            $data['mensagens'] = $this->usuarioModel->getUserMensagens($iduser);
            $data['recomendacoes'] = $this->usuarioModel->getRecomendacoes($iduser);
            $data['responder'] = $this->responder();
            

            $this->load->view('template/header_view', $data);
            $this->load->view('user/vagas_view');
            $this->load->view('template/footer_view');
        }

        public function editarInfo() {
            $sobre = $this->input->post("sobre");
            $Idade = $this->input->post("Idade");
            $Civil = $this->input->post("Civil");
            $Nasciolidade = $this->input->post("Nasciolidade");
            $Eletronico = $this->input->post("Eletronico");
            $Telefone = $this->input->post("Telefone");
            $Rua = $this->input->post("Rua");
            $Bairro = $this->input->post("Bairro");
            $Cidade = $this->input->post("Cidade");
            $Estado = $this->input->post("Estado");
            $Postal = $this->input->post("Postal");
    
            $userId = $this->session->userdata("bs_user_id");
    
            $result = $this->usuarioModel->updateUserData($sobre, $Idade, $Civil,$Eletronico, $Nasciolidade, $Telefone, $Rua, $Bairro, $Cidade, $Estado, $Postal, $userId);
            if($result){
                redirect("usuario");
            } else {
                echo "um erro ocorreu!";
            }
    
        }
        
        public function editarPortifolio() {
            $userId = $this->session->userdata("bs_user_id");
            
            $curto = $this->input->post("curto");
            $longo = $this->input->post("longo");
            $area = $this->input->post("area");
            $experiencias = $this->input->post("experiencias");
            $habilidades = $this->input->post("habilidades");
            $referencias = $this->input->post("referencias");
            
    
            $result = $this->usuarioModel->setUserPortifolio($curto,$longo,$area,$experiencias,$habilidades,$referencias,$userId);
            if($result){
                redirect("usuario");
            } else {
                echo "um erro ocorreu!";
            }
    
        }

        public function getPost() {
            $post = $this->input->post("idPost");
            $result = $this->usuarioModel->getPost($post);
            echo json_encode($result);
            return false;
        }

        public function editarPost() {
            $data = array();
            $data = $this->input->post();

            $result = $this->usuarioModel->updateUserPost($data);
            
            if($result){
                redirect("usuario");
            }
        }

        public function criarPost() {

            $userId = $this->session->userdata("bs_user_id");
            $data = array();
            $data = $this->input->post();

            if($_FILES['photos']['size'][0] != 0) {
                $imgs = $_FILES['photos'];
                $files = $_FILES;
                $cpt = count($_FILES['photos']['name']);

                $config['upload_path']   = 'assets/images/posts/';
                $config['allowed_types'] = 'jpg|jpeg|JPG|JEPG|png|PNG';
                $this->load->library('upload', $config);

                for($i=0; $i<$cpt; $i++) {

                    $_FILES['photo']['name']     = $userId . "_" . time() . "_" . $files['photos']['name'][$i];
                    $_FILES['photo']['type']     = $files['photos']['type'][$i];
                    $_FILES['photo']['tmp_name'] = $files['photos']['tmp_name'][$i];
                    $_FILES['photo']['error']    = $files['photos']['error'][$i];
                    $_FILES['photo']['size']     = $files['photos']['size'][$i];
                    $this->upload->do_upload("photo");

                    $newNameImage = $_FILES['photo']['name'];
                    $images[] = $newNameImage;
                    
                }
                
                $result = $this->usuarioModel->setUserPost($userId, $data, $images);

            } else {

                $result = $this->usuarioModel->setUserPost($userId, $data);

            }
            if($result){
                redirect("usuario");
            }
        }

        public function excluirPost() {
            $post_id = $this->input->post("idPost");
            $result = $this->usuarioModel->deleteUserPost($post_id);
            echo json_encode($result);
            return false;
        }

        public function fixarPost() {
            $post_id = $this->input->post("idPost");
            $result = $this->usuarioModel->fixarUserPost($post_id);
            echo json_encode($result);
            return false;
        }

        public function desfixarPost() {
            $post_id = $this->input->post("idPost");
            $result = $this->usuarioModel->desfixarUserPost($post_id);
            echo json_encode($result);
            return false;
        }

        public function changePhoto() {
            $userId = $this->session->userdata("bs_user_id");
    
            $config['upload_path']      = "assets/images/";
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
                chdir("assets/images/");
                $file = $this->usuarioModel->getUserImage($userId);
                $filnenewName=explode(".", $file->avatar);
                if($filnenewName[0]=="no-image"){
    
                }else{
                       
                        unlink($file->avatar);
                        chdir($old);
                }
            }
    
            $newNameImage=$config['file_name']."".$this->upload->file_ext;
            $fileFullPath=base_url().'assets/images/'.$newNameImage;
            $fileFullPath2=base_url().'assets/images/'.$newNameImage;
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'assets/images/'.$newNameImage;
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
           <img id='crop_image' src=".$fileFullPath2." >";
    
        }
        
        public function cropPhoto() {

            // if (!is_user_logged_in()) 
            //     redirect("login");
            // 
           $userId = $this->session->userdata("bs_user_id");
           
           $file2 = $this->usuarioModel->getUserImage($userId); 
           $pachBeCrop='assets/images';
           $arquivoTocrop=$file2->avatar;
           
        //    echo $this->input->post("cp_img_path");
        $img_width  = 220;
        $img_height = 220;
        
        
        $setings='{"img_width":'.$img_width.',"img_height":'.$img_height.',"x":'.$this->input->post("ic_x").',"y":'.$this->input->post("ic_y").',"height":'.$this->input->post("ic_h").',"width":'.$this->input->post("ic_w").',"rotate":0}';
        
        $params ["patch_src"] = $pachBeCrop;
        $params ["patch_dst"] = $pachBeCrop;
        $params ["setings"] = $setings;
        $params ["sigla"] = "avatar";
        $params ["arquivo"] = $arquivoTocrop;
    
            $this->load->library('cropavatar',$params);  
           // $this->cropavatar->crop($pachBeCrop,$pachBeCrop,$setings);
          $result= $this->cropavatar->getResult();
        
          
          $filnenewName=explode(".", $file2->avatar);
          $filenameAvatar=$filnenewName[0].".avatar.".$filnenewName[1];

          $this->usuarioModel->updateUserImage($userId,$filenameAvatar);
    
        //  echo "<img id='img' src='".images_url().$result."' class='img-thumbnail' >";

        echo "<a href='#' class='img-thumbnail' data-toggle='modal' data-target='#modal_change_photo'>
            <img id='img' src='".images_url().$result."'>
        </a>";
         
        }
}