<?php

class UnlockController extends LockedController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new UnlockModel();
        $this->_id_bill = (int) DecomposeUrl::getArgument(0);
        $this->_bill = $this->_Model->loadBill(array(
            'id_bill' => $this->_id_bill)
        );

        $this->_checkEstablishment($this->_bill['fk_id_establishment']);
        $this->_checkPermissions();
    }

    public function index() {
        $data = $this->_bill;
        $this->_send($data);
    }

    private function _send($data) {
        $errors = array();
        $values = array(
            'id_bill' => $this->_id_bill,
            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT')
        );

        if ($this->_Model->unlock($values)) {
            $MsgBox = new MsgBox();
            $MsgBox->setEvent('success');
            $MsgBox->setMessage('La operacion solicitada se ha realizado satisfactoriamente.');
            $MsgBox->setItems($errors);
            $MsgBox->saveInSession();
            unset($MsgBox);

            redirect(path::urlDomain('./../'));
        } else {
            $errors[] = "Error inesperado, no fue posible actualizar la base de datos";
        }

        $MsgBox = new MsgBox();
        $MsgBox->setEvent('warning');
        $MsgBox->setMessage('No se ha podido completar la accion debido a los siguientes errores.');
        $MsgBox->setItems($errors);
        $MsgBox->saveInSession();
        unset($MsgBox);

        redirect(path::urlDomain('./../'));
    }

}
