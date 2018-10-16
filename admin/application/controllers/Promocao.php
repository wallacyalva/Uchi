<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Promocao extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usuario_model', "usuarioModel");
        $this->load->model('cliente_model', "clienteModel");
        $this->load->model('promocao_model', 'promocaoModel');
    }

   
    public function cliente(){
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();

        $idUser = $this->session->userdata("bs_user_id");
        $userRule = $this->usuarioModel->getUserRule($idUser); 
        $idCliente = $this->uri->segment(3);
        if($userRule->rule == 1){
            $cliente = $this->clienteModel->getClienteCompleteData(false, $idCliente);
        } else {
            $cliente = $this->clienteModel->getClienteCompleteData($idUser, $idCliente);
        }

        $data = array();

        if ($this->input->post('set_promocao')){
            $set_promocao = $this->input->post('set_promocao');
            $this->promocaoModel->desativarPromocao($set_promocao);
        }
        
        $data["promocoes"] = $this->promocaoModel->getPromocoesUsuario($idCliente);
 
        $user = $this->usuarioModel->getUserCompleteData($idUser);
        $data['user'] = $user;
        $data['cliente'] = $cliente;
        
        $this->load->view('template/header_view');
        $this->load->view('promocao/list_promocao_cliente_view', $data);
        $this->load->view('template/footer_view');
    }

    public function new(){
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();

        $idUser = $this->session->userdata("bs_user_id");
        $idCliente = $this->uri->segment(3);

        $cliente = $this->clienteModel->getClienteCompleteData($idUser, $idCliente);
        
        $data = $this->input->post();

        if ($data && $_FILES) {
            $this->form_validation->set_rules('title_promotion', 'Titulo da Promoção', 'required|strip_tags|max_length[40]');
            $this->form_validation->set_rules('price_product', 'Valor do produto', 'trim|strip_tags|required');
            $this->form_validation->set_rules('price_discount', 'Desconto (%)', 'trim|strip_tags|required');
            $this->form_validation->set_rules('active_days', 'Contagem regressiva', 'trim|required|strip_tags|numeric');
            $this->form_validation->set_rules('product_quantity', 'Quantidade disponível', 'trim|strip_tags|required|numeric');
            $this->form_validation->set_rules('rule', 'Regras', 'trim|strip_tags|required|max_length[3000]');
            $this->form_validation->set_rules('description', 'Descrição', 'trim|strip_tags|required|max_length[3000]');
            $errors = false;
            if ($this->form_validation->run() !== FALSE && !$errors) {
                $userId = $this->session->userdata("bs_user_id");
                if (!empty($_FILES))
                {
                    $config['upload_path']      = "../uploads/images_promocao";
                    $config['allowed_types']    = 'jpg|jpeg|JPG|JEPG|png|PNG';
                    $config['file_name']        = $idCliente . "_" . time();
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload("file_image")) {
                        $this->session->set_flashdata("msg", array("tipo" => "2", "texto" => "<strong>Ops!!!</strong> Não foi possivel enviar a imagem de capa." ));
                        redirect("promocao/new/".$idCliente ."");
                    }
                    
                    $newNameImage=$config['file_name']."".$this->upload->file_ext;

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = '../uploads/images_promocao/'.$newNameImage;
                    //SE TRUE CRIA UM THUNMB DA IMAGEM
                    $config['create_thumb'] = false;
                    //SE TRUE DA UM RESIZE MANTENDO A PROPORCAO DO WIDTH
                    $config['maintain_ratio'] = false;
                    $config['width']         = 1000;
                    $config['height']       = 794;
                    
                    $this->load->library('image_lib', $config);          
                    $this->image_lib->resize();

                }

                $data["usuario"] = $idCliente;
                $data["capa"] = $newNameImage;

                
                $codigoPromocao = $this->promocaoModel->insertPromocao($data);

                if($codigoPromocao){
                    $this->session->set_flashdata("msg", array("tipo" => "1", "texto" => "<strong>Muito Bem!!!</strong> Promoção inserida com sucesso." ));        
                    redirect("promocao/new/".$idCliente ."");
                }else{
                    $this->session->set_flashdata("msg", array("tipo" => "2", "texto" => "<strong>Ops!!!</strong> Erro ao tentar Criar Promoção!" ));        
                    redirect("promocao/new/".$idCliente ."");
                }
            }
        }
 

        $userId = $this->session->userdata("bs_user_id");
        $user = $this->usuarioModel->getUserCompleteData($userId);
        $data['user'] = $user;
        $data['cliente'] = $cliente;
        
        $this->load->view('template/header_view');
        $this->load->view('promocao/new_promocao_view', $data);
        $this->load->view('template/footer_view');
    }

    public function editarpromocaocliente(){
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();

        $idUser = $this->session->userdata("bs_user_id");
        $idCliente = $this->uri->segment(3);
        $idPromocao = $this->uri->segment(4);

        $cliente = $this->clienteModel->getClienteCompleteData($idUser, $idCliente);
        $data   = array();

        $data = $this->input->post();
        $data['idpromocao']=$idPromocao;
        $data['idcliente']=$idCliente;

        if ($this->input->post()) {
            $this->form_validation->set_rules('title_promotion', 'Titulo da Promoção', 'required|strip_tags|max_length[40]');
            $this->form_validation->set_rules('price_product', 'Valor do produto', 'trim|strip_tags|required');
            $this->form_validation->set_rules('price_discount', 'Desconto (%)', 'trim|strip_tags|required');
            $this->form_validation->set_rules('active_days', 'Contagem regressiva', 'trim|required|strip_tags|numeric');
            $this->form_validation->set_rules('product_quantity', 'Quantidade disponível', 'trim|strip_tags|required|numeric');
            $this->form_validation->set_rules('rule', 'Regras', 'trim|strip_tags|required|max_length[3000]');
            $this->form_validation->set_rules('description', 'Descrição', 'trim|strip_tags|required|max_length[3000]');
            $errors = false;             
            
            
            if ($_FILES) {
                    $config['upload_path']      = "../uploads/images_promocao";
                    $config['allowed_types']    = 'gif|jpg|jpeg|png';
                    $config['file_name']        = $idCliente . "_" . time();
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload("file_image_promocao")) {
                        echo "Erro não foi possivel enviar o arquivo";
                    }
                    
                    $newNameImage=$config['file_name']."".$this->upload->file_ext;

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = '../uploads/images_promocao/'.$newNameImage;
                    //SE TRUE CRIA UM THUNMB DA IMAGEM
                    $config['create_thumb'] = false;
                    //SE TRUE DA UM RESIZE MANTENDO A PROPORCAO DO WIDTH
                    $config['maintain_ratio'] = false;
                    $config['width']         = 1000;
                    $config['height']       = 794;
                    
                    $this->load->library('image_lib', $config);          
                    $this->image_lib->resize();

                    $data["capa"] = $newNameImage;

                }

                $codigoPromocao = $this->promocaoModel->updateClientePromocao($data);

                if($codigoPromocao){
                    $this->session->set_flashdata("msg", array("tipo" => "1", "texto" => "<strong>Muito Bem!!!</strong> Promoção atualizada com sucesso." ));        
                    redirect("promocao/editarpromocaocliente/".$idCliente ."/".$idPromocao."");
                }else{
                    $this->session->set_flashdata("msg", array("tipo" => "2", "texto" => "<strong>Ops!!!</strong> Erro ao tentar Atualizar Promoção!" ));        
                    redirect("promocao/editarpromocaocliente/".$idCliente ."/".$idPromocao."");
                }
        }
 

        $userId = $this->session->userdata("bs_user_id");
        $user = $this->usuarioModel->getUserCompleteData($userId);
        $data['user'] = $user;
        $data['cliente'] = $cliente;

        $data["promocoes"] = $this->promocaoModel->getOnePromocoesUsuario($idCliente,$idPromocao);
        
        $this->load->view('template/header_view');
        $this->load->view('promocao/editar_promocao_cliente_view', $data);
        $this->load->view('template/footer_view');
    }


    public function index(){
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();
        $idUser = $this->session->userdata("bs_user_id");
        $data   = array();

        if ($this->input->post('cliente_to_remove')){
            $idCliente = $this->input->post('cliente_to_remove');

            $files=$this->clienteModel->getClienteImage($idCliente);

            $old = getcwd(); // Save the current directory
            chdir("../uploads/images_profile");
            foreach($files as $file){
                unlink($file->picture);
            }  
            chdir($old);
            $this->clienteModel->deleteCliente($idCliente);
        }

        $data['clientes']=$this->clienteModel->getClienteCompleteData($idUser);

        $userId = $this->session->userdata("bs_user_id");
        $user = $this->usuarioModel->getUserCompleteData($userId);
        $data['user'] = $user;
        
        $this->load->view('template/header_view');
        $this->load->view('promocao/meus_clientes_view', $data);
        $this->load->view('template/footer_view');
    }

    public function adm(){
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();
        $idUser = $this->session->userdata("bs_user_id");
        $data   = array();

        if ($this->input->post('cliente_to_remove')){
            $idCliente = $this->input->post('cliente_to_remove');

            $files=$this->clienteModel->getClienteImage($idCliente);

            $old = getcwd(); // Save the current directory
            chdir("../uploads/images_profile");
            foreach($files as $file){
                unlink($file->picture);
            }  
            chdir($old);
            $this->clienteModel->deleteCliente($idCliente);
        }

        $data['clientes']=$this->clienteModel->getAllClienteCompleteData();

        $userId = $this->session->userdata("bs_user_id");
        $user = $this->usuarioModel->getUserCompleteData($userId);
        $data['user'] = $user;
        
        $this->load->view('template/header_view');
        $this->load->view('promocao/meus_clientes_view', $data);
        $this->load->view('template/footer_view');
    }
    

}