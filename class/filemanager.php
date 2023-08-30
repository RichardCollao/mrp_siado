<?php

class FileManager {

    private $destination = '';
    private $fileName = '';
    private $maxSize = 1048576;
    private $allowedExts = array('jpg', 'png', 'xls', 'xlsx', 'pdf', 'doc', 'docx');
    private $errors = array();
    private $notice = array();

    public function setDestination($destination) {
        if (!file_exists($destination)) {
            if (!mkdir($destination, 0777, true)) {
                $this->errors[] = 'Fallo al crear las carpetas';
            }
        }
        $this->destination = $destination;
    }

    public function setFileName($filename) {
        $filename = preg_replace("/[^a-z0-9\.\s\_]/", "", strtolower($filename));
        $this->fileName = $filename;
    }

    public function setMaxSize($kb) {
        $this->maxSize = $kb * 8 * 1024;
    }

    public function setAllowedExtensions($newExtensions) {
        $this->allowedExts = $newExtensions;
    }

    function getErrors() {
        return $this->errors;
    }

    function getNotice() {
        return $this->notice;
    }

    public function upload($file) {
        $ext = explode(".", $file['name']);
        $file['ext'] = end($ext);
        
        $this->validate($file);
        if (is_empty($this->errors)) {
            if (move_uploaded_file($file['tmp_name'], $this->destination . $this->fileName)) {
                $this->notice[] = 'El archvo <b>' . $file['name'] . '</b> fue subido correctamente';
            } else {
                $this->errors[] = 'Se produjo un error al subir el archivo <b>' . $file['name'] . '</b>';
            }
        }
    }

    private function validate($file) {
        // check file exist
        if (empty($file['name'])) {
            $this->errors[] = 'Archivo no encontrado';
        } else {
            if(!empty($this->allowedExts)){
            // check allowed extensions
                if (!in_array($file['ext'], $this->allowedExts)) {
                    $this->errors[] = $file['name'] . ', este tipo de archivo no es permitido';
                }
            }
            // check file size
            if ($file['size'] > $this->maxSize) {
                $this->errors[] = $file['name'] . ', el tamaño del archivo excede el limite de ' . $this->maxSize . ' bytes';
            }
        }
    }

}

/**
// example
$FileManager = new FileManager;
$FileManager->setDestination($_SERVER['DOCUMENT_ROOT'] . '/images/profiles/');
$FileManager->setAllowedExtensions('image/jpeg');
$FileManager->setFileName('user_profile.jpg');
$FileManager->upload($_FILES['profileimage']);
*/