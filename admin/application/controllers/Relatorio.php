<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Relatorio extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usuario_model', "usuarioModel");
        $this->load->model('cliente_model', "clienteModel");
        $this->load->model('banner_model', "bannerModel");
    }
    public function cidades(){
        $data = array();
        $data = $this->input->post();
        $cidades=$this->bannerModel->getCidadesByCodigoUf($data);
        
        echo json_encode($cidades);
    }

    public function pedidos(){
        $this->usuarioModel->isLoggedIn();
        $idUser = $this->session->userdata("bs_user_id");
        $data["pedidos"] = $this->usuarioModel->getAllPedidos();

        $user = $this->usuarioModel->getUserCompleteData($idUser);
        $data['user'] = $user;

        $this->load->view('template/header_view');
        $this->load->view('relatorio/pedidos_view', $data);
        $this->load->view('template/footer_view');
    }

    public function clientes(){
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();
        $idUser = $this->session->userdata("bs_user_id");
        $data   = array();
        $data = $this->input->post();

        if ($this->input->post()){
            $mpdf = new \Mpdf\Mpdf(
                [
                    'format' => 'A4-L'
                ]
            );

           $clientes = $this->clienteModel->getAllClienteCompleteDataByCidade($data);

           $html ="
<style>

</style>
           <div>
           <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Razão Social</th>
                        <th>Responsavel</th>
                        <th>Cidade</th>
                        <th>Telefone</th>
                    </tr>
                </thead>
                <tbody>";
            foreach($clientes as $cliente){
            $html .="                             
                    <tr>
                        <td>".$cliente->id_clientes."</td>
                        <td>".$cliente->name_company."</td>
                        <td>".$cliente->responsible."</td>
                        <td>".$cliente->city."</td>
                        <td>".$cliente->phone." / ".$cliente->phone2."</td>
                    </tr>";
            }
            $html .="    </tbody>
            </table>
            </div>";
            $mpdf->shrink_tables_to_fit = 1;
      
            $mpdf->WriteHTML($html);
            $mpdf->Output('clientes.pdf',\Mpdf\Output\Destination::DOWNLOAD);
            // $mpdf->Output();
        }

        $data['clientes']=$this->clienteModel->getClienteCompleteData($idUser);

        $userId = $this->session->userdata("bs_user_id");
        $user = $this->usuarioModel->getUserCompleteData($userId);
        $data['user'] = $user;
        $data['estados'] = $this->bannerModel->getAllEstados();

        $this->load->view('template/header_view');
        $this->load->view('relatorio/rel_cliente_view', $data);
        $this->load->view('template/footer_view');
        
    }
    public function empreendedores(){
        //check user logged in or not
        $this->usuarioModel->isLoggedIn();
        $idUser = $this->session->userdata("bs_user_id");
        $data   = array();
        $data = $this->input->post();

        if ($this->input->post()){
            $mpdf = new \Mpdf\Mpdf(
                [
                    'format' => 'A4-L'
                ]
            );

           $empreendedores = $this->usuarioModel->getUserCompleteDataByCidade($data);

           $html ="
<style>

</style>
           <div>
           <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Cidade</th>
                        <th>Telefone</th>
                    </tr>
                </thead>
                <tbody>";
            foreach($empreendedores as $empreendedor){
            $html .="                             
                    <tr>
                        <td>".$empreendedor->id."</td>
                        <td>".$empreendedor->name."</td>
                        <td>".$empreendedor->email."</td>
                        <td>".$empreendedor->city."</td>
                        <td>".$empreendedor->phone."</td>
                    </tr>";
            }
            $html .="    </tbody>
            </table>
            </div>";
            $mpdf->shrink_tables_to_fit = 1;
      
            $mpdf->WriteHTML($html);
            $mpdf->Output('empreendedores.pdf',\Mpdf\Output\Destination::DOWNLOAD);
            // $mpdf->Output();
        }

        $userId = $this->session->userdata("bs_user_id");
        $user = $this->usuarioModel->getUserCompleteData($userId);
        $data['user'] = $user;
        $data['estados'] = $this->bannerModel->getAllEstados();

        $this->load->view('template/header_view');
        $this->load->view('relatorio/rel_empreendedor_view', $data);
        $this->load->view('template/footer_view');
        
    }

}