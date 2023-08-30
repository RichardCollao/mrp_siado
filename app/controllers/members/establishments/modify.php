<?php

class ModifyController extends EstablishmentsController {

    private $_id_establishment;
    private $_establishment;

    public function __construct() {
        parent::__construct();

        $this->_Model = new ModifyModel();

        $this->_id_establishment = (int) DecomposeUrl::getArgument(0);
        $this->_establishment = $this->_Model->loadEstablishment($this->_id_establishment);

        $this->_checkEstablishment($this->_establishment['id_establishment']);
        $this->_checkPermissions();
    }

    public function index() {
        $data = array();
        if (!is_empty($_POST)) {
            $data = $this->_loadDataFromPost();
            $this->_send($data);
        } else {
            $data = $this->_loadDataFromModel();
        }

        $this->_view($data);
    }

    private function _send($data) {
        $errors = $this->_validateForm($data);

        if (is_empty($errors)) {
            $values = array(
                'id_establishment' => $this->_id_establishment,
                'name_business' => $data['name_business'],
                'activity_business' => $data['activity_business'],
                'rut_business' => $data['rut_business'],
                'address_business' => $data['address_business'],
                'phone_business' => $data['phone_business'],
                'name' => $data['name'],
                'address' => $data['address'],
                'phone' => $data['phone']
            );

            // Solo se valida nombre porque el rut puede repertirse en varias obras de la misma empresa.
            $q = $this->_Model->duplicateName($values);
            if (!is_empty($q)) {
                $errors[] = 'El nombre ya se encuentra en uso';
            } elseif ($this->_Model->modifyEstablishment($values)) {
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
        # redirect(Path::urlDomain('./'));
    }

    private function _loadDataFromModel() {
        return $this->_establishment;
    }

    private function _loadDataFromPost() {
        return array(
            'name_business' => trim($_POST['name_business']),
            'activity_business' => trim($_POST['activity_business']),
            'rut_business' => trim($_POST['rut_business']),
            'address_business' => trim($_POST['address_business']),
            'phone_business' => trim($_POST['phone_business']),
            'name' => trim($_POST['name']),
            'rut' => trim($_POST['rut']),
            'address' => trim($_POST['address']),
            'phone' => trim($_POST['phone'])
        );
    }

    private function _validateForm($data) {
        extract($data);
        $errors = array();

        if (!preg_match('/^[^0-9][a-z0-9\-\s_ñÑ\.]{1,64}$/i', $name_business)) {
            $errors[] = 'El campo <b>nombre constrcutora</b> no es valido';
        }

        if (!preg_match('/^\d{1,8}\-[K|k|0-9]$/', $rut_business)) {
            $errors[] = 'El campo <b>rut constructora</b> no es valido';
        }

        if (Validate::address($address_business) !== true) {
            $errors[] = 'El campo <b>direccion constructora</b> no es valido, caracteres pemitidos letras, números, espacios, /.#-_';
        }

        if (strlen($phone_business) < 3 || strlen($phone_business) > 32) {
            $errors[] = 'El campo telefono constructora debe contener entre 3 y 16 carateres';
        } elseif (!preg_match('/^[0-9\-\s()]+$/', $phone_business)) {
            $errors[] = 'El campo <b>telefono</b> no es valido, solo se permiten números, espacios, guiones y parentesis';
        }

        if (!preg_match('/^[^0-9][a-z0-9\-\s_ñ]{1,64}$/i', $name)) {
            $errors[] = 'El campo <b>nombre obra</b> no es valido';
        }

        if (Validate::address($address) !== true) {
            $errors[] = 'El campo <b>direccion obra</b> no es valido, caracteres pemitidos letras, números, espacios, /.#-_';
        }

        if (!empty($phone)) {
            if (strlen($phone) < 6 || strlen($phone) > 32) {
                $errors[] = 'El campo <b>telefono</b> obra debe contener entre 3 y 16 carateres';
            } elseif (!preg_match('/^[0-9\-\s()]+$/', $phone)) {
                $errors[] = 'El campo <b>telefono</b> obra no es valido, solo se permiten números, espacios, guiones y parentesis';
            }
        }
        return $errors;
    }

    private function _view($data) {
        $data['action_form'] = path::urlDomain('./modify/') . $this->_id_establishment;

        View::keep(path::appViews('./modify.php'), $data, 'content');
    }

}
