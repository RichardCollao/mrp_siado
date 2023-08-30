<?php

/**
 * Esta obra esta licenciada bajo la Licencia Creative 
 * Commons Atribucion-CompartirIgual 4.0 Internacional. 
 * @license    http://creativecommons.org/licenses/by-sa/4.0/deed.es_CL
 * @author     Richard Collao Olivares <http://www.richardcollao.cl>
 */
class UploadImage {

    private $_errors = array();
    private $_image = array();
    private $_width_max = null;
    private $_height_max = null;
    private $_sizemax = null;
    private $_redim_width = null;
    private $_redim_height = null;
    private $_out_format;
    private $_out_name;
    private $mode = 0755;

    public function __construct($file) {
        list($type, $ext) = explode('/', $file['type']);
        list($width, $height) = @getimagesize($file['tmp_name']);
        $this->_image['name'] = $file['name'];
        $this->_image['tmp_name'] = $file['tmp_name'];
        $this->_image['type'] = $type;
        $this->_image['ext'] = str_replace('jpeg', 'jpg', $ext);
        $this->_image['width'] = $width;
        $this->_image['height'] = $height;
        $this->_image['size'] = round(filesize($file['tmp_name']) / 1024);
        $this->_out_format = $this->_image['ext'];
        $this->_out_name = $this->_image['name'];
    }

    public function getErrors() {
        return $this->_errors;
    }

    public function setOutFormat($str) {
        $this->_out_format = $str;
    }

    public function setOutName($str) {
        $this->_out_name = $str;
    }

    public function setDestination($dir) {
        if (!file_exists($dir)) {
            if (!mkdir($dir, $this->mode, true)) {
                $this->_errors[] = 'Fallo al crear el directorio de destino';
            }
        }
        $this->_folder_destination = $dir;
        chmod($this->_folder_destination, $this->mode);
    }

    public function setSizeMax($int) {
        $this->_size_max = $int;
    }

    public function setWidthHeightMax($width, $height) {
        $this->_width_max = $width;
        $this->_height_max = $height;
    }

    public function setRedim($width, $height) {
        $this->_redim_width = $width;
        $this->_redim_height = $height;
    }

    public function getImageInfo() {
        return $this->_image;
    }

    public function getOutFormat() {
        return $this->_out_format;
    }

    public function getOutName() {
        return $this->_out_name;
    }

    public function execute() {
        // Validaciones.
        $this->_validate();

        if (is_empty($this->_errors)) {
            // Si no hay redimension y el formato permanece igual solo se mueve la imagen.
            // Sino la imagen es recreada con la libreria gd
            if ($this->_image['ext'] == $this->_out_format && is_null($this->_redim_width) && is_null($this->_redim_height)) {
                return $this->_moveUpload();
            } else {
                return $this->_convertImage();
            }
        } else {
            return false;
        }
    }

    // Validaciones.
    private function _validate() {

        if (is_empty($this->_folder_destination)) {
            throw new Exception('No se ha provisto el metodo setDestination().');
        }

        if (is_empty($this->_image['tmp_name'])) {
            $this->_errors[] = 'El archivo no ha llegado al servidor.';
        }

        if (getFilePermissions($this->_folder_destination) != decoct($this->mode)) {
            $this->_errors[] = 'El directorio de destino no tiene permisos de escritura.';
        }

        if (is_empty($this->_errors)) {
            if ($this->_image['type'] != 'image' || $this->_image['ext'] == 'bmp') {
                $this->_errors[] = 'El archivo que se intenta subir no es una imagen o no es soportado.';
            }

            if (is_null($this->_redim_width) && is_null($this->_redim_height)) {
                if (!is_null($this->_width_max) && $this->_image['width'] > $this->_width_max) {
                    $this->_errors[] = 'El ancho de la imagen no debe superar los ' . $this->_width_max . ' pixeles.';
                }

                if (!is_null($this->_height_max) && $this->_image['height'] > $this->_height_max) {
                    $this->_errors[] = 'El alto de la imagen no debe superar los ' . $this->_height_max . ' pixeles.';
                }

                if (!is_null($this->_size_max) && $this->_image['size'] > $this->_size_max) {
                    $this->_errors[] = 'El peso de la imagen no debe superar los ' . $this->_size_max . ' kbytes.';
                }
            }
        }
    }

    private function _convertImage() {
        // Crea la ruta con el nombre del archivo definitivo.
        $name_last = $this->_folder_destination . $this->_out_name . '.' . $this->_out_format;
        // Resuelve la funcion correspondiente a la extencion de la imagen. 
        $func_ext = 'imagecreatefrom' . str_replace('jpg', 'jpeg', $this->_image['ext']);

        // Crea la imagen en la varible a partir del archivo temporal que se ha subido.
        if (@!$src_image = call_user_func($func_ext, $this->_image['tmp_name'])) {
            $this->_errors[] = 'El Archivo no se ha podido crear en el servidor.';
            return false;
        }

        // Comprueba si la imagen debe ser redimencionada.
        if (is_null($this->_redim_width) && is_null($this->_redim_height)) {
            $dst_image = $src_image;
        } else {
            $dst_image = $this->_redimImage($src_image);
        }

        try {
            switch ($this->_out_format) {
                case 'bmp':
                    imagewbmp($dst_image, $name_last);
                    break;
                case 'gif':
                    imagegif($dst_image, $name_last);
                    break;
                case 'jpg':
                    imagejpeg($dst_image, $name_last, 100);
                    break;
                case 'png':
                    imagepng($dst_image, $name_last, 0);
                    break;
            }
        } catch (Exception $e) {
            $this->_errors[] = 'El Archivo no se ha podido editar en el servidor.';
            return false;
        }

        imagedestroy($dst_image);
        return true;
    }

    private function _moveUpload() {

        $name_last = $this->_folder_destination . $this->_out_name . '.' . $this->_out_format;

        try {
            move_uploaded_file($this->_image['tmp_name'], $name_last);
            return true;
        } catch (Exception $ex) {
            $this->_errors[] = 'El Archivo no se ha podido mover en el servidor';
            return false;
        }
    }

    private function _redimImage($src_image) {
        $dst_w = $this->_redim_width;
        $dst_h = $this->_redim_height;
        $src_w = imagesx($src_image);
        $src_h = imagesy($src_image);
        $dst_image = ImageCreate($dst_w, $dst_h);

        ImageCopyResized($dst_image, $src_image, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
        return $dst_image;
    }

}
