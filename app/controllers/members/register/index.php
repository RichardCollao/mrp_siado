<?php

class IndexController extends RegisterController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if (!is_empty($_POST)) {
            $data = $this->_loadDataFromPost();
            $this->_send($data);
        } else {
            $data = array();
        }
        $this->_view($data);
    }

    public function _send($data) {
        $errors = $this->_validateForm($data);
        if (is_empty($errors)) {
            $values = array(
                'name' => $data['name'],
                'surname' => $data['surname'],
                'mail' => $data['mail'],
                'password' => encryptPassword($data['password1']),
                'phone' => $data['phone'],
                'address' => $data['address']
            );
            //'activation_code' md5(uniqid(rand(), TRUE));
            // No se encontro ningun error en la validacion.
            // Intentara crear los registros necesarios para la nueva cuenta se usaran transacciones.
            $id_user = $this->_Model->createNewAcount($values);
            redirect(path::urlDomain('./register/been/' . $id_user));
        }
        // Mensaje
        $MsgBox = new MsgBox();
        $MsgBox->setEvent('warning');
        $MsgBox->setMessage('No se ha podido completar la accion debido a los siguientes errores.');
        $MsgBox->setItems($errors);
        $MsgBox->saveInSession();
        unset($MsgBox);
    }

    private function _loadDataFromPost() {
        return array(
            'name' => trim($_POST['name']),
            'surname' => trim($_POST['surname']),
            'mail' => trim($_POST['mail']),
            'password1' => trim($_POST['password1']),
            'password2' => trim($_POST['password2']),
            'phone' => trim($_POST['phone']),
            'address' => trim($_POST['address'])
        );
    }

    private function _validateForm($data) {
        extract($data);
        $errors = array();

        if (Validate::name($name) !== TRUE) {
            $errors[] = Validate::name($name);
        } elseif ($this->_user['name'] != $name) {
            $db_name = $this->_Model->existsName($name);
            if (!is_empty($db_name)) {
                $errors[] = "El nombre <b>$name</b> ya esta en uso.";
            }
        }

        if ($password1 != $password2) {
            $errors[] = "Las contraseñas no coinciden.";
        } elseif (Validate::password($password1) !== TRUE) {
            $errors[] = Validate::Password($password1);
        }

        if (Validate::Mail($mail) !== TRUE) {
            $errors[] = Validate::Mail($mail);
        } elseif ($this->_user['mail'] != $mail) {
            $db_mail = $this->_Model->existsMail($mail);
            if (!is_empty($db_mail)) {
                $errors[] = "El correo <b>$mail</b> ya esta en uso.";
            }
        }
        
        if (strlen($phone) < 3 || strlen($phone) > 16) {
            $errors[] = 'El campo <b>telefono</b> debe contener entre 3 y 16 carateres';
        } elseif (!preg_match('/^[0-9]+$/', $phone)) {
            $errors[] = 'El campo <b>telefono</b> no es valido, solo se permiten números';
        }
        
        if (!preg_match('/^[0-9a-zñ \/\.,#\-_]+$/', $address)) {
            $errors[] = 'El campo <b>direccion</b> no es valido, caracteres pemitidos letras, números, espacios, /.,#-_';
        }
        
        if ($captcha != $_SESSION['captcha'] || strlen($captcha) < 4) {
            $errors[] = 'El campo correspondiente a la imagen de seguridad es incorrecto.';
        }
        return $errors;
    }

    private function _view($data) {
        $data['img_captcha'] = path::urlModules('/captcha/img.php');
        $data['img_refresh'] = path::urlModules('/captcha/refresh.png');
        $data['action_form'] = path::urlDomain('./');
        $data['url_base'] = $data['link_base'] = Path::urlDomain('/');

        View::keep(path::appViews('./index.php'), $data, 'content');
    }

}
