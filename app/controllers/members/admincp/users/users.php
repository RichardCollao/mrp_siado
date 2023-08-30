<?php

class UsersController extends AdmincpController {

    public function __construct() {
        parent::__construct();
    }

    public function loadLists() {
        $list_establishments = $this->_Model->listEstablishments(array());
        foreach ($list_establishments as $establishment) {
            $this->list_establishments[$establishment['id_establishment']] = $establishment['name'];
        }
    }

    protected function _checkLists() {
        $errors = array();
        if (is_empty($this->list_establishments)) {
            $errors[] = 'No se encontro ninguna lista de obras';
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

}
