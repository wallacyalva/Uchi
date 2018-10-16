<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usuario_model', "usuarioModel");
        $this->load->model('cliente_model', "clienteModel");
        $this->load->model('banner_model', "bannerModel");
    }

    public function new(){
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();

        $userId = $this->session->userdata("bs_user_id");
        $user = $this->usuarioModel->getUserCompleteData($userId);

        $data = array();
       
  
        $data = $this->input->post();

        if ($data && $_FILES) {

            $this->form_validation->set_rules('name_company', 'Nome do Cliente', 'required|strip_tags');
            $this->form_validation->set_rules('responsible', 'Responsavel', 'strip_tags|required');
            $this->form_validation->set_rules('zip_code', 'Cep', 'strip_tags|required');
            $this->form_validation->set_rules('address', 'Endereço', 'required|strip_tags');
            $this->form_validation->set_rules('district', 'Bairro', 'strip_tags|required');
            $this->form_validation->set_rules('city', 'Cidade', 'strip_tags|required');
            $this->form_validation->set_rules('state', 'Estado', 'strip_tags|required');
            $this->form_validation->set_rules('phone', 'Telefone', 'strip_tags|required|numeric');
            $this->form_validation->set_rules('description', 'Descrição', 'trim|strip_tags|required|max_length[3000]');
           
            $errors = false;
           
            if ($this->form_validation->run() !== FALSE && !$errors) {
                $userId = $this->session->userdata("bs_user_id");
                if (!empty($_FILES))
                {
                    $config['upload_path']      = "../uploads/images_profile";
                    $config['allowed_types']    = '*';
                    $config['file_name']        = $userId . "_".time();
                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload("img_capa")) {
                        $this->session->set_flashdata("msg", array("tipo" => "2", "texto" => "<strong>Ops!!!</strong>".$this->upload->display_errors()."" ));     
                        redirect("cliente/new_cliente");
                    }
                    
                    $newNameImage=$config['file_name']."".$this->upload->file_ext;

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = '../uploads/images_profile/'.$newNameImage;
                    //SE TRUE CRIA UM THUNMB DA IMAGEM
                    $config['create_thumb'] = false;
                    //SE TRUE DA UM RESIZE MANTENDO A PROPORCAO DO WIDTH
                    $config['maintain_ratio'] = false;
                    $config['width']         = 1000;
                    $config['height']       = 794;
                    
                    $this->load->library('image_lib', $config);          
                    $this->image_lib->resize();

                }

                $data["usuario"] = $userId;
                $data["capa"] = $newNameImage;

                // $codigoPromocao = $this->promocaoModel->insertPromocao($data);
                $codigoCliente = $this->clienteModel->insertCliente($data);
                if($codigoCliente){
                    $this->session->set_flashdata("msg", array("tipo" => "1", "texto" => "<strong>Muito Bem!!!</strong> Cliente Cadastrado com sucesso." ));        
                    redirect("cliente/new_cliente");
                }else{
                    $this->session->set_flashdata("msg", array("tipo" => "2", "texto" => "<strong>Ops!!!</strong> Erro ao tentar Criar Promoção!" ));        
                    redirect("cliente/new_cliente");
                }
            }
        }
        $data['user'] = $user;
        $data['estados'] = $this->bannerModel->getAllEstados();
        $this->load->view('template/header_view');
        $this->load->view('banner/novo_banner_view', $data);
        $this->load->view('template/footer_view');
    }

    public function editar($banner){
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();

        $userId = $this->session->userdata("bs_user_id");
        $user = $this->usuarioModel->getUserCompleteData($userId);

        $data = array();
        $data['banner'] = $this->bannerModel->getBannerById($banner);
        $data['user'] = $user;
        $data['estados'] = $this->bannerModel->getAllEstados();
        $this->load->view('template/header_view');
        $this->load->view('banner/editar_banner_view', $data);
        $this->load->view('template/footer_view');
    }

//END NEW

public function cidades(){
    $data = array();
    $data = $this->input->post();
    $cidades=$this->bannerModel->getCidadesByCodigoUf($data);
    
    echo json_encode($cidades);
}

public function uploadPhoto() {
    if (!is_user_logged_in()) {
        redirect("login");
    }
    $userId = $this->session->userdata("bs_user_id");

    $config['upload_path']      = "uploads/images/banners/";
    $config['allowed_types']    = 'jpg|jpeg|JPG|JEPG|png|PNG';
    $config['file_name']        = time();
    $this->load->library('upload', $config);

    if (!$this->upload->do_upload("file")) {
        $this->session->set_flashdata("msg", array("tipo" => "2", "texto" => "<strong>Ops!!!</strong>".$this->upload->display_errors()."" ));     
        //redirect("cliente/new_cliente");
    }


    $newNameImage=$config['file_name']."".$this->upload->file_ext;
    $fileFullPath='uploads/images/banners/'.$newNameImage;
    $config['image_library'] = 'gd2';
    $config['source_image'] = 'uploads/images/banners/'.$newNameImage;
    //SE TRUE CRIA UM THUNMB DA IMAGEM
    $config['create_thumb'] = false;
    //SE TRUE DA UM RESIZE MANTENDO A PROPORCAO DO WIDTH
    $config['maintain_ratio'] = true;
    $config['width']         = 500;
    //$config['height']       = 200;
    
    $this->load->library('image_lib', $config);          
    $this->image_lib->resize();

   echo "<input type='hidden' name='cp_name_img_banner' id='cp_name_img_banner' value='".$newNameImage."'/>
   <img id='crop_image_banner' src=".base_url().$fileFullPath." >";

}

public function uploadPhotoEditar() {
    if (!is_user_logged_in()) {
        redirect("login");
    }
    $userId = $this->session->userdata("bs_user_id");

    $config['upload_path']      = "uploads/images/banners/";
    $config['allowed_types']    = 'jpg|jpeg|JPG|JEPG|png|PNG';
    $config['file_name']        = time();
    $this->load->library('upload', $config);

    if (!$this->upload->do_upload("file")) {
        $this->session->set_flashdata("msg", array("tipo" => "2", "texto" => "<strong>Ops!!!</strong>".$this->upload->display_errors()."" ));     
        //redirect("cliente/new_cliente");
    }


    $newNameImage=$config['file_name']."".$this->upload->file_ext;
    $fileFullPath='uploads/images/banners/'.$newNameImage;
    $config['image_library'] = 'gd2';
    $config['source_image'] = 'uploads/images/banners/'.$newNameImage;
    //SE TRUE CRIA UM THUNMB DA IMAGEM
    $config['create_thumb'] = false;
    //SE TRUE DA UM RESIZE MANTENDO A PROPORCAO DO WIDTH
    $config['maintain_ratio'] = true;
    $config['width']         = 500;
    //$config['height']       = 200;
    
    $this->load->library('image_lib', $config);          
    $this->image_lib->resize();

   echo "<input type='hidden' name='cp_name_img_banner' id='cp_name_img_banner' value='".$newNameImage."'/>
   <img id='crop_image_banner' src=".base_url().$fileFullPath." >";

}

public function cropBannerPhoto() {
    if (!is_user_logged_in()) {
        redirect("login");
    }
   $userId = $this->session->userdata("bs_user_id");
   
    $data = array();

    $data = $this->input->post();

    $img_width  = 650;
    $img_height = 366;


    $setings='{"img_width":'.$img_width.',"img_height":'.$img_height.',"x":'.$this->input->post("icb_x").',"y":'.$this->input->post("icb_y").',"height":'.$this->input->post("icb_h").',"width":'.$this->input->post("icb_w").',"rotate":0}';

    $patchImagePhoto = 'uploads/images/banners/'.$this->input->post("cp_img_banner_path");
    $params ["patch_src"] = $patchImagePhoto;
    $params ["patch_dst"] = $patchImagePhoto;
    $params ["setings"] = $setings;
    $params ["sigla"] = "banner";


    $this->load->library('cropavatar',$params);  

    $result= $this->cropavatar->getResult();

  
  $filnenewName=explode(".", $this->input->post("cp_img_banner_path"));
  $filenameBanner=$filnenewName[0].".banner.".$filnenewName[1];

  $data['bannerImagem']= $filenameBanner;

  $this->bannerModel->insertBanner($data);
  //$this->session->set_flashdata("msg", array("tipo" => "1", "texto" => "<strong>Muito Bem!!!</strong> Banner Inserido com sucesso"));     
  //redirect("banner/new");
  //echo $patchImagePhoto;
 // echo "<img id='img' src='".base_url().$result."' class='img-thumbnail' >";
 
}

public function cropBannerPhotoEditar() {
    if (!is_user_logged_in()) {
        redirect("login");
    }
   $userId = $this->session->userdata("bs_user_id");
   
    $data = array();

    $data = $this->input->post();

    $img_width  = 650;
    $img_height = 366;


    $setings='{"img_width":'.$img_width.',"img_height":'.$img_height.',"x":'.$this->input->post("icb_x").',"y":'.$this->input->post("icb_y").',"height":'.$this->input->post("icb_h").',"width":'.$this->input->post("icb_w").',"rotate":0}';

    $patchImagePhoto = 'uploads/images/banners/'.$this->input->post("cp_img_banner_path");
    $params ["patch_src"] = $patchImagePhoto;
    $params ["patch_dst"] = $patchImagePhoto;
    $params ["setings"] = $setings;
    $params ["sigla"] = "banner";


    $this->load->library('cropavatar',$params);  

    $result= $this->cropavatar->getResult();

  
  $filnenewName=explode(".", $this->input->post("cp_img_banner_path"));
  $filenameBanner=$filnenewName[0].".banner.".$filnenewName[1];

  $data['bannerImagem']= $filenameBanner;

  $this->bannerModel->updateBanner($data);
  //$this->session->set_flashdata("msg", array("tipo" => "1", "texto" => "<strong>Muito Bem!!!</strong> Banner Inserido com sucesso"));     
  //echo $patchImagePhoto;
    // echo "<img id='img' src='".base_url().$result."' class='img-thumbnail' >";
}

    public function index(){
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();

        $idUser = $this->session->userdata("bs_user_id");
       
        $data = array();

        $data["banners"] = $this->bannerModel->getAllBannerByUser($idUser);

        $user = $this->usuarioModel->getUserCompleteData($idUser);
        $data['user'] = $user;
        
        $this->load->view('template/header_view');
        $this->load->view('banner/banners_view', $data);
        $this->load->view('template/footer_view');
    }

}