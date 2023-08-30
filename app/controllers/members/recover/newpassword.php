<?php

class NewPasswordController extends RecoverController {

    private $_user;
    private $_hash;

    public function __construct() {
        parent::__construct();
        $id_user = DecomposeUrl::getArgument(0);
        $this->_hash = DecomposeUrl::getArgument(1);
        $this->_user = $this->_Model->getUserById($id_user);
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

    private function _send($data) {
        $errors = $this->_validateForm($data);

        if (is_empty($this->_user)) {
            $errors[] = array("No existe ningun usuario asociado.");
        }

        if ($this->_user['state_acount'] != 'active') {
            $errors[] = 'Su cuenta no se encuentra activa.';
        }

        $hash_security = $this->_Model->loadHash($this->_user['id_user']);

        if ($this->_hash != $hash_security['hash']) {
            $errors[] = 'Enlace invalido.';
        }

        $hash_expired = addInterval($hash_security['date_hash_creation'], '1 day');
        if (constant('FW_DATETIME_CURRENT') > $hash_expired) {
            $errors[] = 'El enlace ha caducado.';
        }

        if (is_empty($errors)) {
            $password = encryptPassword($data['pass']);
            // Actualiza la contraseña
            if ($this->_Model->changePass($password, $this->_user['id_user'])) {
                // Elimina el hash
                $this->_Model->deletehash($this->_user['id_user']);

                $MsgBox = new MsgBox();
                $MsgBox->setEvent('success');
                $MsgBox->setMessage('La contraseña se ha cambiado satisfactoriamente.');
                $MsgBox->setItems($errors);
                $MsgBox->saveInSession();
                unset($MsgBox);
                redirect(path::urlDomain('login'));
            }else{
                $errors[] = "Ocurrio un error inesperado en la base de datos";
            }
        }

        $MsgBox = new MsgBox();
        $MsgBox->setEvent('warning');
        $MsgBox->setMessage('No se ha podido completar la accion debido a los siguientes errores.');
        $MsgBox->setItems($errors);
        $MsgBox->saveInSession();
        unset($MsgBox);
    }

    // Obtiene los valores para los campos desde el array $_POST.
    private function _loadDataFromPost() {
        $data = array();
        //$data['mail'] = trim($_POST['mail']);
        $data['pass'] = trim($_POST['pass']);
        $data['pass_confirm'] = strtolower(trim($_POST['pass_confirm']));
        return $data;
    }

    private function _validateForm($data) {
        $errors = array();
        // Validar password
        if ($data['pass'] != $data['pass_confirm']) {
            $errors[] = "Las contraseñas no coinciden";
        } elseif (Validate::password($data['pass']) !== TRUE) {
            $errors[] = Validate::Password($data['pass']);
        }
        return $errors;
    }

    private function _view($data) {
        $data['link_form_action'] = path::urlDomain('./newpassword' . $this->_id_user . '/' . $this->_hash);
        $data['link_base'] = path::urlDomain('');

        View::keep(path::appViews('./newpassword.php'), $data, 'content');
    }

}
