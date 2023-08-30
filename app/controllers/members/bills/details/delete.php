<?php

class DeleteController extends DetailsController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new DeleteModel();
        $this->_id_detail = (int) DecomposeUrl::getArgument(0);
        $this->_detail = $this->_Model->loadDetail(array(
            'id_bill_detail' => $this->_id_detail)
        );

        $this->_checkEstablishment($this->_detail['fk_id_establishment']);
        $this->_checkPermissions();
        $this->_isBlocked();
    }

    public function index() {
        $this->_send($this->_detail);
    }

    private function _send($data) {
        $errors = array();
        $values = array(
            'id_bill_detail' => $this->_id_detail
        );

        if (is_empty($this->_detail)) {
            $errors[] = 'El elemento seleccionado no existe';
        }

        if (is_empty($errors)) {
            if ($this->_Model->deleteItem($values)) {
                $MsgBox = new MsgBox();
                $MsgBox->setEvent('success');
                $MsgBox->setMessage('La operacion solicitada se ha realizado satisfactoriamente.');
                $MsgBox->setItems($errors);
                $MsgBox->saveInSession();
                unset($MsgBox);
                redirect(path::urlDomain('./' . $this->_detail['fk_id_bill']));
            } else {
                $errors[] = 'Debe tener un stock igual o superior para eliminar este recurso';
            }
        }

        $MsgBox = new MsgBox();
        $MsgBox->setEvent('warning');
        $MsgBox->setMessage('No se ha podido completar la accion debido a los siguientes errores.');
        $MsgBox->setItems($errors);
        $MsgBox->saveInSession();
        unset($MsgBox);

        redirect(path::urlDomain('./' . $this->_detail['fk_id_bill']));
    }

}
