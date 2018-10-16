<?php
header("Access-Control-Allow-Origin: *");
defined('BASEPATH') OR exit('No direct script access allowed');

class Anuncios extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Anuncios_model', 'anunciosModel');
        $this->load->model('Usuarios_model', 'usuariosModel');
    }

    private function login() {
        if ($this->input->post('userLogin') && $this->input->post('senha')) {
            $userLogin = $this->input->post('userLogin');
            $senha = $this->input->post('senha');
            $loginData = $this->usuariosModel->login($userLogin, $senha);
            return $loginData;
        } else {
            return false;
        }
    }

    public function upload() {
//        $allowedExt = array('png', 'jpeg', 'jpg', 'bmp', 'gif');
//                $dir = 'uploads/';
//                $ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
//                if (in_array($ext, $allowedExt)) {
//                    $fname = time() . "_" . rand(10000, 99999) . rand(10000, 99999) . "." . $ext;
//                    $target = $dir . $fname;
//                    if (move_uploaded_file($_FILES['imagem']['tmp_name'], $target)) {
//                        $result['filename'] = $fname;
//                        $result['status'] = true;
//                        echo json_encode($result);
//                    } else {
//                        $result['error'] = 'Falha no upload!';
//                        $result['status'] = false;
//                        echo json_encode($result);
//                    }
//                } else {
//                    $result['error'] = 'Extensão incorreta!';
//                    $result['status'] = false;
//                    echo json_encode($result);
//                }
        $uploads_dir = 'app/uploads';
        $ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $name = basename("IMG_" . $ext);
        if (move_uploaded_file($_FILES['imagem']['tmp_name'], "$uploads_dir/$name")) {
            echo "true";
        }
    }

    public function criar() {
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }
     
        // Access-Control headers are received during OPTIONS requests
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
     
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
     
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
     
            exit(0);
        }
        $postdata = file_get_contents("php://input");
        if (isset($postdata)) {
            $pdata = json_decode($postdata);
        } else {
            $result = json_encode('false ii');
        }
//        $loginData = $this->login();
//        if (!$loginData || $loginData['status'] == false) {
//            echo json_encode($loginData);
//            return false;
//        }
        if ($pdata->imagem && $pdata->texto && $pdata->lat && $pdata->long) {
            $usuario = $pdata->usuario;
            $titulo = "teste";
            $valor = "0.00";
            $texto = $pdata->texto;
            $lat = $pdata->lat;
            $lng = $pdata->long;
            $fname = $pdata->imagem;
            $bairro = $pdata->bairro;
            $cidade = $pdata->cidade;
            $local = $pdata->local;
            $estado = $pdata->estado;
            $pais = $pdata->pais;
            $tipo = $pdata->tipo;
        }
        echo json_encode($this->anunciosModel->criar($usuario, $titulo, $valor, $texto, $fname, $lat, $lng, $bairro, $cidade, $estado, $pais, $tipo, $local));
    }

    public function puxarTodos() {
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }
     
        // Access-Control headers are received during OPTIONS requests
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
     
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
     
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
     
            exit(0);
        }
        $postdata = file_get_contents("php://input");
        if (isset($postdata)) {
            $pdata = json_decode($postdata);
        } else {
            $result = json_encode('false ii');
        }
        if ($pdata->lat && $pdata->long) {
            $lat = $pdata->lat;
            $lng = $pdata->long;
        } else {
            $lat = false;
            $lng = false;
        }
        if ($pdata->publico !== false && $pdata->publico == 1) {
            if (isset($pdata->userId)) {
                $result = json_encode($this->anunciosModel->puxarTodos($pdata->userId, $pdata->index, $pdata->local, $pdata->l_tipo, $pdata->tipo, false, $lat, $lng));
                echo $result;
            } else {
                $result = json_encode($this->anunciosModel->puxarTodos(0, $pdata->index, $pdata->local, $pdata->l_tipo, $pdata->tipo, false, $lat, $lng));
                echo $result;
            }
            return false;
        }
//        $loginData = $this->login();
//        if (!$loginData || $loginData['status'] == false) {
//            echo json_encode($loginData);
//            return false;
//        }
//        if ($pdata->index !== false) {
//            $meus = false;
//            if ($pdata->meus && $pdata->meus == 1) {
//                $meus = true;
//            }
//            echo json_encode($this->anunciosModel->puxarTodos($loginData['id'], $pdata->index, $meus, $lat, $lng));
//        } else {
//            $result['status'] = false;
//            $result['error'] = "Post index não informado";
//            echo json_encode($result);
//        }
    }

    public function puxarTodasFotos() {
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }
     
        // Access-Control headers are received during OPTIONS requests
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
     
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
     
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
     
            exit(0);
        }
        $postdata = file_get_contents("php://input");
        if (isset($postdata)) {
            $pdata = json_decode($postdata);
        } else {
            $result = json_encode('false ii');
        }
        if ($pdata->lat && $pdata->long) {
            $lat = $pdata->lat;
            $lng = $pdata->long;
        } else {
            $lat = false;
            $lng = false;
        }
        if ($pdata->publico !== false && $pdata->publico == 1) {
            $result = json_encode($this->anunciosModel->puxarTodasFotos(0, $pdata->index, false, $lat, $lng));
            echo $result;
            return false;
        }
//        $loginData = $this->login();
//        if (!$loginData || $loginData['status'] == false) {
//            echo json_encode($loginData);
//            return false;
//        }
//        if ($pdata->index !== false) {
//            $meus = false;
//            if ($pdata->meus && $pdata->meus == 1) {
//                $meus = true;
//            }
//            echo json_encode($this->anunciosModel->puxarTodos($loginData['id'], $pdata->index, $meus, $lat, $lng));
//        } else {
//            $result['status'] = false;
//            $result['error'] = "Post index não informado";
//            echo json_encode($result);
//        }
    }

    public function mudarStatus() {
        $loginData = $this->login();
        if (!$loginData || $loginData['status'] == false) {
            echo json_encode($loginData);
            return false;
        }
        if ($this->input->post('anuncio') !== false) {
            echo json_encode($this->anunciosModel->mudarStatus($loginData['id'], $this->input->post('anuncio')));
        } else {
            $result['status'] = false;
            $result['error'] = "Anúncio não informado";
            echo json_encode($result);
        }
    }

}
