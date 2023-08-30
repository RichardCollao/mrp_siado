<?php

class CreateController extends VouchersController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new CreateModel();

        $this->_checkPermissions();
        $this->loadLists();
        $this->_checkLists();
        $this->_checkStock();
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

    private function _checkStock() {
        $errors = array();
        if (is_empty($this->list_materials_with_stock)) {
            $errors[] = 'No se encontro ningun material con stock';
        }

        if (!is_empty($errors)) {
            $MsgBox = new MsgBox();

            $MsgBox->setEvent('info');
            $MsgBox->setMessage('Antes de continuar primero debe corregir los siguientes errores.');
            $MsgBox->setItems($errors);
            $MsgBox->saveInSession();
            unset($MsgBox);

            redirect(path::urlDomain('./'));
        }
    }

    private function _send($data) {
        $errors = $this->_validateForm($data);
        $alerts = array();

        if (is_empty($errors)) {
            $values = array(
                'id_voucher' => 0,
                'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'),
                'fk_id_user_typist' => constant('AUTH_ID_USER'),
                'fk_id_user_autorized' => $data['fk_id_user_autorized'],
                'user_name_requesting' => $data['user_name_requesting'],
                'number' => $data['number'],
                'issue_date' => $data['issue_date'],
                'created_at' => constant('FW_DATETIME_CURRENT'),
                'destination' => $data['destination'],
                'observation' => $data['observation']
            );

            if (!is_empty($this->_Model->duplicateNumber($values))) {
                $MsgBox = new MsgBox();
                $MsgBox->setEvent('info');
                $MsgBox->setMessage('La siguiente informacion requiere su atencion.');
                $MsgBox->setItems(array('El valor del campo número ya existe.'));
                $MsgBox->saveInSession();
                unset($MsgBox);
            }

            if ($this->_Model->createVoucher($values)) {
                redirect(path::urlDomain('./details/' . $this->_Model->getLastInsertId()));
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
            'number' => trim($_POST['number']),
            'issue_date' => trim($_POST['issue_date']),
            'fk_id_user_autorized' => trim($_POST['fk_id_user_autorized']),
            'user_name_requesting' => trim($_POST['user_name_requesting']),
            'destination' => trim($_POST['destination']),
            'observation' => trim($_POST['observation'])
        );
    }

    private function _validateForm($data) {
        extract($data);
        $errors = array();
        if (!preg_match('/^[0-9a-z\.\-\_\s]+$/i', $number)) {
            $errors[] = 'EL campo Número no es valido';
        }

        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $issue_date)) {
            $errors[] = 'EL campo fecha no es valido, utilice el siguiente formato 2016-12-25';
        } elseif (!checkRealDate($issue_date)) {
            $errors[] = 'La fecha ingresada es invalida';
        }

        if (!array_key_exists($fk_id_user_autorized, $this->list_supervisors)) {
            $errors[] = 'El campo Autoriza no es valido.';
        }

        if (!preg_match('/^[a-zñ\s\,\-\(\)\?\.]+$/i', $user_name_requesting)) {
            $errors[] = 'EL campo Solicita no es valido';
        }

        if (strlen($destination) < 1 || strlen($destination) > 255) {
            $errors[] = 'El campo <b>Destino</b> debe contener entre 1 y 64 carateres';
        }

        if (!is_empty($observation)) {
            if (Validate::observation($observation) !== true) {
                $errors[] = 'El campo <b>Observación</b> no es valido';
            }
        }

        return $errors;
    }

    private function _view($data) {
        $data['action_form'] = path::urlDomain('./create');
        $data['list_supervisors'] = $this->list_supervisors;
//        $data['list_destinations'] = $this->list_destinations;
//        $data['list_user_name_requestings'] = $this->list_user_name_requestings;

        View::keep(path::appViews('./create.php'), $data, 'content');
    }

}
