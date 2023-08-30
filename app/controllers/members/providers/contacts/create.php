<?php

class CreateController extends ProvidersController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new CreateModel();

        $this->_id_provider = (int) DecomposeUrl::getArgument(0);
        $this->_provider = $this->_Model->loadProvider(array(
            'id_provider' => $this->_id_provider
        ));
        $this->_checkPermissions();
    }

    public function index() {
        if (!is_empty($_POST)) {
            $data = $this->_loadDataFromPost();
            $this->_send($data);
        } else {
            $data = array();
        }
        $data['provider'] = $this->_provider;
        $this->_view($data);
    }

    private function _send($data) {
        $errors = $this->_validateForm($data);

        if (is_empty($errors)) {
            $values = array(
                'fk_id_provider' => $this->_id_provider,
                'name' => $data['name'],
                'mail' => $data['mail'],
                'phone' => $data['phone']
            );
            if ($this->_Model->createContact($values)) {
                $MsgBox = new MsgBox();
                $MsgBox->setEvent('success');
                $MsgBox->setMessage('La operacion solicitada se ha realizado satisfactoriamente.');
                $MsgBox->setItems($errors);
                $MsgBox->saveInSession();
                unset($MsgBox);

                redirect(path::urlDomain('./' . $this->_id_provider));
            }
        }
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
            'mail' => trim($_POST['mail']),
            'phone' => trim($_POST['phone'])
        );
    }

    private function _validateForm($data) {
        extract($data);
        $errors = array();
        if (strlen($name) < 3 || strlen($name) > 255) {
            $errors[] = 'El campo <b>nombre</b> debe contener entre 3 y 255 carateres';
        } elseif (!preg_match('/[a-z0-9\s]+/i', $name)) {
            $errors[] = 'El campo <b>nombre</b> puede solo puede contener números, letras y caracteres ()#&-_.';
        }

        if (!is_empty($mail)) {
            if (Validate::mail($mail) !== true) {
                $errors[] = 'El campo <b>correo</b> no es valido.';
            }
        }

        if (!is_empty($phone)) {
            if (strlen($phone) < 3 || strlen($phone) > 32) {
                $errors[] = 'El campo <b>telefono</b> debe contener entre 3 y 32 carateres';
            } elseif (!preg_match('/^[0-9\-\(\)\s\+\,]+$/', $phone)) {
                $errors[] = 'El campo <b>telefono</b> no es valido, solo se permiten números';
            }
        }
        return $errors;
    }

    private function _view($data) {
        $data['action_form'] = path::urlDomain('./create/' . $this->_id_provider);

        View::keep(path::appViews('./create.php'), $data, 'content');
    }

}
