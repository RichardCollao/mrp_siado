<?php

class EditController extends ProvidersController {

    private $_id_provider;
    private $_provider;

    public function __construct() {
        parent::__construct();

        $this->_Model = new EditModel();

        $this->_id_provider = (int) DecomposeUrl::getArgument(0);
        $this->_provider = $this->_Model->loadProvider(
                array('fk_id_establishment' => constant('AUTH_ESTABLISHMENT'),
                    'id_provider' => $this->_id_provider));

        $this->_checkEstablishment($this->_provider['fk_id_establishment']);
        $this->_checkPermissions();
    }

    public function index() {
        if (!is_empty($_POST)) {
            $data = $this->_loadDataFromPost();
            $this->_send($data);
        } else {
            $data = $this->_provider;
        }

        $this->_view($data);
    }

    private function _send($data) {
        $errors = $this->_validateForm($data);

        if (is_empty($errors)) {
            $values = array(
                'id_provider' => $this->_id_provider,
                'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'),
                'name' => $data['name'],
                'activity' => $data['activity'],
                'rut' => $data['rut'],
                'mail' => $data['mail'],
                'address' => $data['address'],
                'phone' => $data['phone']
            );

            if (!is_empty($this->_Model->duplicateName($values))) {
                $errors[] = 'El nombre ya se encuentra en uso';
            } elseif (!is_empty($this->_Model->duplicateRut($values))) {
                $errors[] = 'El RUT ya se encuentra en uso';
            } elseif ($this->_Model->editProvider($values)) {
                // Mensaje
                $MsgBox = new MsgBox();
                $MsgBox->setEvent('success');
                $MsgBox->setMessage('La operacion solicitada se ha realizado satisfactoriamente.');
                $MsgBox->setItems($errors);
                $MsgBox->saveInSession();
                unset($MsgBox);

                redirect(path::urlDomain('./'));
            }
        }

        $MsgBox = new MsgBox();
        $MsgBox->setEvent('warning');
        $MsgBox->setMessage('No se ha podido completar la accion debido a los siguientes errores.');
        $MsgBox->setItems($errors);
        $MsgBox->saveInSession();
        unset($MsgBox);
        #redirect(Path::urlDomain('./'));
    }

    private function _loadDataFromPost() {
        # return array_map('trim', $_POST);
        return array(
            'name' => trim($_POST['name']),
            'activity' => trim($_POST['activity']),
            'rut' => trim($_POST['rut']),
            'mail' => trim($_POST['mail']),
            'phone' => trim($_POST['phone']),
            'address' => trim($_POST['address'])
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

        if (!preg_match('/^\d{1,8}\-[K|k|0-9]$/i', $rut)) {
            $errors[] = 'El campo <b>rut</b> no es valido, ejemplo: 10000000-k ';
        }

        if (!is_empty($mail)) {
            if (Validate::mail($mail) !== true) {
                $errors[] = 'El campo <b>correo</b> no es valido.';
            }
        }

        if (!is_empty($address)) {
            if (Validate::address($address) !== true) {
                $errors[] = 'El campo <b>direccion</b> no es valido, caracteres pemitidos letras, números, espacios, /.#-_';
            }
        }

        if (!is_empty($phone)) {
            if (strlen($phone) < 3 || strlen($phone) > 32) {
                $errors[] = 'El campo <b>telefono</b> debe contener entre 3 y 32 carateres';
            }
//            elseif (!preg_match('/^[0-9\-\(\)\s\+\,]+$/', $phone)) {
//                $errors[] = 'El campo <b>telefono</b> no es valido, solo se permiten números';
//            }
        }
        return $errors;
    }

    private
            function _view($data) {
        $data['action_form'] = path::urlDomain('./edit/') . $this->_id_provider;

        View::keep(path::appViews('./edit.php'), $data, 'content');
    }

}
