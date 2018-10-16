<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of ImageResize
 *
 */
class ImageResize {

    public $arquivo;
    private $altura;
    private $largura;
    private $pasta;

    function __construct($initializeParams) {
        if ($initializeParams) {
            $this->arquivo = $initializeParams["arquivo"];
            $this->altura = $initializeParams["altura"];
            $this->largura = $initializeParams["largura"];
            $this->pasta = $initializeParams["pasta"];
        }
    }

    private function getExtensao() {
        //retorna a extensao da imagem	
        $result = explode('.', strtolower($this->arquivo['name']));
        $extensao = end($result);
        return $extensao;
    }

    private function ehImagem($extensao) {
        $extensoes = array('gif', 'jpeg', 'jpg', 'png');  // extensoes permitidas
        if (in_array($extensao, $extensoes))
            return true;
    }

    //largura, altura, tipo, localizacao da imagem original
    private function redimensionar($imgLarg, $imgAlt, $tipo, $img_localizacao) {
        //descobrir novo tamanho sem perder a proporcao
        if ($imgLarg > $imgAlt) {
            $novaLarg = $this->largura;
            $novaAlt = round(($novaLarg / $imgLarg) * $imgAlt);
        } elseif ($imgAlt > $imgLarg) {
            $novaAlt = $this->altura;
            $novaLarg = round(($novaAlt / $imgAlt) * $imgLarg);
        } else {// altura == largura
            if ($imgAlt > $this->altura) {
                $novaAlt = $this->altura;
                $novaLarg = $this->altura;
//                            $novaAlt = $novaLarg = max($this->largura, $this->altura);
            }
        }
        //cria uma nova imagem com o novo tamanho	
        $novaimagem = imagecreatetruecolor($novaLarg, $novaAlt);
        switch ($tipo) {
            case 1: // gif
                $origem = imagecreatefromgif($img_localizacao);
                break;
            case 2: // jpg
                $origem = imagecreatefromjpeg($img_localizacao);
                break;
            case 3: // png
                $origem = imagecreatefrompng($img_localizacao);
                imagefill($novaimagem, 0, 0, imagecolorallocate($novaimagem, 255, 255, 255));
                break;
        }
        //redimencionar a imagem
        imagecopyresampled($novaimagem, $origem, 0, 0, 0, 0, $novaLarg, $novaAlt, $imgLarg, $imgAlt);
        imagejpeg($novaimagem, str_replace("gif", "jpg", $img_localizacao), 100); //best quality 
        //destroi as imagens criadas
        imagedestroy($novaimagem);
        imagedestroy($origem);
    }

    public function salvar() {
        $extensao = $this->getExtensao();
        //gera um nome unico para a imagem em funcao do tempo
        $newName = time() . '_' . rand(0, 9999999999) . '_' . rand(0, 9999999999) . '.' . $extensao;
        //localizacao do arquivo 
        $destino = $this->pasta . $newName;
        $this->arquivo["name"] = $newName;
        //move o arquivo
        if (!move_uploaded_file($this->arquivo['tmp_name'], $destino)) {
            if ($this->arquivo['error'] == 1) {
                return false;
            } else {
                return false;
            }
        }

        if ($this->ehImagem($extensao)) {
            //pega a largura, altura, tipo e atributo da imagem
            list($largura, $altura, $tipo, $atributo) = getimagesize($destino);
            // testa se é preciso redimensionar a imagem
            if (($largura > $this->largura) || ($altura > $this->altura)) {
                $this->redimensionar($largura, $altura, $tipo, $destino);
            } elseif ($extensao != "jpg" && $extensao != "jpeg") {
                $this->saveAsJPG();
            }
        }
        return true;
    }

    private function saveAsJPG() {
        $extensao = $this->getExtensao();
        $explode = explode($extensao, $this->arquivo["name"]);
        $fileNameNoExtension = $explode[0];
        $convertedFileName = $this->pasta . $fileNameNoExtension . "jpg";
        $localizacaoImagem = $this->pasta . $this->arquivo["name"];
        if ($extensao == "png") {
            $new_pic = imagecreatefrompng($localizacaoImagem);
        } elseif ($extensao == "gif") {
            $new_pic = imagecreatefromgif($this->pasta . $this->arquivo["name"]);
        }
        // Create a new true color image with the same size
        $imageWidth = imagesx($new_pic);
        $imageHeight = imagesy($new_pic);
        $whiteBackground = imagecreatetruecolor($imageWidth, $imageHeight);
        // Fill the new image with white background
        imagefill($whiteBackground, 0, 0, imagecolorallocate($whiteBackground, 255, 255, 255));
        // Copy original transparent image onto the new image
        imagecopy($whiteBackground, $new_pic, 0, 0, 0, 0, $imageWidth, $imageHeight);
        $new_pic = $whiteBackground;
        imagejpeg($new_pic, $localizacaoImagem, 80); // 0-worst qlty,smaller __ 100- best qlty, bigger
        imagedestroy($new_pic);
    }

    public function resizeJPGtoThumbnail($newWidth, $newHeight) {
        //imageSize é o tamanho que a imagem tem
        //newSize é o tamanho maximo que ela pode ter
        //novaSize é o novo tamanho redimensionado 
        $new_pic = imagecreatefromjpeg($this->pasta . $this->arquivo["name"]);
        $imageWidth = imagesx($new_pic);
        $imageHeight = imagesy($new_pic);
        //descobrir novo tamanho sem perder a proporcao
        if ($imageWidth > $newWidth || $imageHeight > $newHeight) {
            if ($imageWidth > $imageHeight) {
                $novaLarg = $newWidth;
                $novaAlt = round(($novaLarg / $imageWidth) * $imageHeight);
            } elseif ($imageHeight > $imageWidth) {
                $novaAlt = $newHeight;
                $novaLarg = round(($novaAlt / $imageHeight) * $imageWidth);
            } else {// altura == largura
                if ($imageHeight > $newHeight) {
                    $novaAlt = $newHeight;
                    $novaLarg = $newHeight;
                }
            }
        } else {
            $novaLarg = $imageWidth;
            $novaAlt = $imageHeight;
        }
        $convertedFileName = $this->pasta . "r_" . $this->arquivo["name"];
        // Create a new true color image with the same size
        $whiteBackground = imagecreatetruecolor($novaLarg, $novaAlt);
        // Fill the new image with white background
        imagefill($whiteBackground, 0, 0, imagecolorallocate($whiteBackground, 255, 255, 255));
        // Copy original transparent image onto the new image
        imagecopyresampled($whiteBackground, $new_pic, 0, 0, 0, 0, $novaLarg, $novaAlt, $imageWidth, $imageHeight);
        $new_pic = $whiteBackground;
        imagejpeg($new_pic, $convertedFileName, 60); // 0-worst qlty,smaller __ 100- best qlty, bigger
        imagedestroy($new_pic);
    }

    function setFile($file) {
        $this->arquivo = $file;
    }

    function setPasta($destino) {
        $this->pasta = $destino;
    }

}
