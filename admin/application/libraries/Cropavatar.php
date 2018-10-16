<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Cropavatar{
  
  //public $rotate = "";

  public function __construct($params = array())
	{
    $this->setSrc($params["patch_src"],$params["patch_dst"],$params["sigla"]);
    $this->setData($params["setings"]);
    $this->crop($this->src,$this->dst,$this->data);
  //  $this->crop($params["patch_src"], $params["patch_dst"], $params["setings"]);
    //$this->$rotate = $params["rotate"];
  }
  
  public function setData($data) {
    if (!empty($data)) {
      $this->data = json_decode(stripslashes($data));
    }
  }

  public function setSrc($src,$dst,$sigla) {
    if (!empty($src)) {
      $type = exif_imagetype($src);

      if ($type) {
        $this->src = $src;
        $this->type = $type;
        $this->extension = image_type_to_extension($type);
        $this->setDst($dst,$sigla);
      }
    }
  }

  public function setDst($dst,$sigla) {

    $type = exif_imagetype($dst);
    
    $filnename=explode(".", $dst);

          if ($type) {
            $extension = image_type_to_extension($type);
            //$src = $filnename[0] . '.'.$sigla . $extension ;
            $src = $filnename[0] . '.'.$sigla.'.' . $filnename[1] ;
          }
    $this->dst = $src;
  }
  
  public function crop($src, $dst, $data) {
    if (!empty($src) && !empty($dst) && !empty($data)) {
      switch ($this->type) {
        case IMAGETYPE_GIF:
          $src_img = imagecreatefromgif($src);
          break;

        case IMAGETYPE_JPEG:
          $src_img = imagecreatefromjpeg($src);
          break;

        case IMAGETYPE_PNG:
          $src_img = imagecreatefrompng($src);
          break;
      }

      if (!$src_img) {
        $this -> msg = "Failed to read the image file";
        return;
      }

      $size = getimagesize($src);
      $size_w = $size[0]; // natural width
      $size_h = $size[1]; // natural height

      $src_img_w = $size_w;
      $src_img_h = $size_h;

      $degrees =  $data->rotate;

      // Rotate the source image
      if (is_numeric($degrees) && $degrees != 0) {
        // PHP's degrees is opposite to CSS's degrees
        $new_img = imagerotate( $src_img, -$degrees, imagecolorallocatealpha($src_img, 0, 0, 0, 127) );

        imagedestroy($src_img);
        $src_img = $new_img;

        $deg = abs($degrees) % 180;
        $arc = ($deg > 90 ? (180 - $deg) : $deg) * M_PI / 180;

        $src_img_w = $size_w * cos($arc) + $size_h * sin($arc);
        $src_img_h = $size_w * sin($arc) + $size_h * cos($arc);

        // Fix rotated image miss 1px issue when degrees < 0
        $src_img_w -= 1;
        $src_img_h -= 1;
      }

      $tmp_img_w = $data -> width;
      $tmp_img_h = $data -> height;

      
      // $dst_img_w = 220;
      // $dst_img_h = 220;
      
      $dst_img_w = $data->img_width;
      $dst_img_h = $data->img_height;

      $src_x = $data -> x;
      $src_y = $data -> y;

      if ($src_x <= -$tmp_img_w || $src_x > $src_img_w) {
        $src_x = $src_w = $dst_x = $dst_w = 0;
      } else if ($src_x <= 0) {
        $dst_x = -$src_x;
        $src_x = 0;
        $src_w = $dst_w = min($src_img_w, $tmp_img_w + $src_x);
      } else if ($src_x <= $src_img_w) {
        $dst_x = 0;
        $src_w = $dst_w = min($tmp_img_w, $src_img_w - $src_x);
      }

      if ($src_w <= 0 || $src_y <= -$tmp_img_h || $src_y > $src_img_h) {
        $src_y = $src_h = $dst_y = $dst_h = 0;
      } else if ($src_y <= 0) {
        $dst_y = -$src_y;
        $src_y = 0;
        $src_h = $dst_h = min($src_img_h, $tmp_img_h + $src_y);
      } else if ($src_y <= $src_img_h) {
        $dst_y = 0;
        $src_h = $dst_h = min($tmp_img_h, $src_img_h - $src_y);
      }

      // Scale to destination position and size
      $ratio = $tmp_img_w / $dst_img_w;
      $dst_x /= $ratio;
      $dst_y /= $ratio;
      $dst_w /= $ratio;
      $dst_h /= $ratio;

      $dst_img = imagecreatetruecolor($dst_img_w, $dst_img_h);

      // Add transparent background to destination image
      imagefill($dst_img, 0, 0, imagecolorallocatealpha($dst_img, 0, 0, 0, 127));
      imagesavealpha($dst_img, true);

      $result = imagecopyresampled($dst_img, $src_img, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);

      if ($result) {
        if (!imagepng($dst_img, $dst)) {
          $this -> msg = "Failed to save the cropped image file";
        }
      } else {
        $this -> msg = "Failed to crop the image file";
      }

      imagedestroy($src_img);
      imagedestroy($dst_img);
    }
  }

  public function getResult() {
    return !empty($this->data) ? $this->dst : $this->src;
  }
}