<?php

class EditController extends UsersController {

    private $_id_user;
    private $_user;

    public function __construct() {
        parent::__construct();

        $this->_Model = new EditModel();

        $this->_id_user = (int) DecomposeUrl::getArgument(0);
        $this->_user = $this->_Model->loadUser(array(
            'id_user' => $this->_id_user)
        );

        $this->loadLists();
    }

    public function index() {
        #$this->_checkContent($this->_user);

        if (!is_empty($_POST)) {
            $data = $this->_loadDataFromPost();
            $this->_send($data);
        } else {
            $data = $this->_user;
        }

        $this->_view($data);
    }

    private function _send($data) {
        $errors = $this->_validateForm($data);

        if (is_empty($errors)) {
            $values = array(
                'id_user' => $this->_id_user,
                'fk_id_establishment' => $data['fk_id_establishment'],
                'name' => $data['name'],
                'mail' => $data['mail'],
                'password' => encryptPassword($data['password']),
                'phone' => $data['phone'],
                'state_acount' => $data['state_acount'],
                'type_user' => 'user',
                'date_reg' => constant('FW_DATETIME_CURRENT'),
                'permissions' => ''
            );

            if (!is_empty($this->_Model->duplicateName($values))) {
                $errors[] = "El nombre ya esta en uso.";
            } elseif (!is_empty($this->_Model->duplicateMail($values))) {
                $errors[] = "El correo ya esta en uso.";
            } elseif ($this->_Model->editUser($values)) {
                $MsgBox = new MsgBox();
                $MsgBox->setEvent('success');
                $MsgBox->setMessage('La operacion solicitada se ha realizado satisfactoriamente.');
                $MsgBox->saveInSession();
                unset($MsgBox);

                redirect(Path::urlDomain('./'));
            } else {
                $errors[] = "No se pudo realizar la operacion en la base de datos.";
            }
        }

        $MsgBox = new MsgBox();
        $MsgBox->setEvent('warning');
        $MsgBox->setMessage('No se ha podido completar la accion debido a los siguientes errores.');
        $MsgBox->setItems($errors);
        $MsgBox->saveInSession();
        unset($MsgBox);
//        redirect(path::urlDomain('./create'));
    }

    private function _loadDataFromPost() {
        return array(
            'name' => trim($_POST['name']),
            'mail' => trim($_POST['mail']),
            'password' => trim($_POST['password']),
            'phone' => trim($_POST['phone']),
            'state_acount' => trim($_POST['state_acount']),
            'fk_id_establishment' => (int) $_POST['fk_id_establishment']
        );
    }

    private function _validateForm($data) {
        extract($data);
        $errors = array();

        if (Validate::name($name) !== TRUE) {
            $errors[] = Validate::name($name);
        }

        if (Validate::Mail($mail) !== TRUE) {
            $errors[] = Validate::mail($mail);
        }

        if (Validate::password($password) !== TRUE) {
            $errors[] = Validate::Password($password);
        }

        if (!array_key_exists($state_acount, $this->list_state_acounts)) {
            $errors[] = "El campo <b>Estado</b> es incorrecto.";
        }

        if (!is_empty($phone)) {
            if (strlen($phone) < 3 || strlen($phone) > 32) {
                $errors[] = 'El campo telefono debe contener entre 3 y 32 carateres';
            } elseif (!preg_match('/^[0-9]+$/', $phone)) {
                $errors[] = 'El campo telefono no es valido';
            }
        }

        return $errors;
    }

    private function _view($data) {
        $data['action_form'] = path::urlDomain('./edit/' . $this->_id_user);
        $data['list_state_acounts'] = $this->list_state_acounts;
        $data['list_establishments'] = $this->list_establishments;

        View::keep(path::appViews('./edit.php'), $data, 'content');
    }

}
