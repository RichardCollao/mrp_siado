<?php

class DeleteController extends BillsController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new DeleteModel();

        $this->_id_bill = (int) DecomposeUrl::getArgument(0);
        $this->_bill = $this->_Model->loadBill(array(
            'id_bill' => $this->_id_bill)
        );

        $this->_checkEstablishment($this->_bill['fk_id_establishment']);
        $this->_checkPermissions();
        $this->_isBlocked();
    }

    public function index() {
        $this->_send($this->_bill);
    }

    private function _send($data) {
        $errors = array();
        $values = array(
            'id_bill' => $this->_id_bill
        );

        if (is_empty($this->_bill)) {
            $errors[] = 'El elemento seleccionado no existe';
        } else {
            try {
                $this->_Model->delete($values);

                $MsgBox = new MsgBox();
                $MsgBox->setEvent('success');
                $MsgBox->setMessage('La operacion solicitada se ha realizado satisfactoriamente.');
                $MsgBox->setItems($errors);
                $MsgBox->saveInSession();
                unset($MsgBox);

                redirect(path::urlDomain('./'));
            } catch (Exception $e) {
                $errors[] = 'Este recurso no puede ser eliminado mientras este siendo utilizado.';
            }
        }

        $MsgBox = new MsgBox();
        $MsgBox->setEvent('warning');
        $MsgBox->setMessage('No se ha podido completar la accion debido a los siguientes errores.');
        $MsgBox->setItems($errors);
        $MsgBox->saveInSession();
        unset($MsgBox);

        redirect(path::urlDomain('./'));
    }

}
