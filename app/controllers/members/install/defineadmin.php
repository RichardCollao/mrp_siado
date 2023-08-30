<?php

class DefineAdminController extends InstallController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new DefineAdminModel();
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

        if (is_empty($errors)) {
            $values = array(
                'fk_id_establishment' => 1,
                'name' => $data['name'],
                'mail' => $data['mail'],
                'password' => encryptPassword($data['pass']),
                'state_acount' => 'active',
                'type_user' => 'super_admin',
                'date_reg' => constant('FW_DATETIME_CURRENT')
            );

            $this->_Model->defineAdmin($values);

            redirect(Path::urlDomain('./finished'));
        } else {
            $MsgBox = new MsgBox();
            $MsgBox->setEvent('warning');
            $MsgBox->setMessage('No se ha podido completar la accion debido a los siguientes errores.');
            $MsgBox->setItems($errors);
            $MsgBox->saveInSession();
            unset($MsgBox);
        }
    }

    /**
     * Obtiene los valores para los campos desde el array $_POST.
     */
    private function _loadDataFromPost() {
        $data['name'] = trim($_POST['name']);
        $data['mail'] = trim($_POST['mail']);
        $data['pass'] = trim($_POST['pass']);
        $data['pass_confirm'] = trim($_POST['pass_confirm']);
        return $data;
    }

    /**
     * Valida los datos enviados por el formulario.
     */
    private function _validateForm($data) {
        $errors = array();
        // Validar nombre
        if (Validate::name($data['name']) !== TRUE) {
            $errors[] = Validate::name($data['name']);
        }
        // Validar mail
        if (Validate::Mail($data['mail']) !== TRUE) {
            $errors[] = Validate::Mail($data['mail']);
        }
        if ($data['pass'] != $data['pass_confirm']) {
            $errors[] = "Las contraseñas no coinciden";
        } elseif (Validate::password($data['pass']) !== TRUE) {
            $errors[] = Validate::Password($data['pass']);
        }
        return $errors;
    }

    private function _view($data) {
        $data['action_form'] = Path::urlDomain('./defineadmin');
        // Llama al script que contiene la vista
        View::keep(path::appViews('./defineadmin.php'), $data, 'content');
    }

}
