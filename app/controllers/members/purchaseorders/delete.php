<?php

class DeleteController extends PurchaseOrdersController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new DeleteModel();

        $this->_id_purchase_order = (int) DecomposeUrl::getArgument(0);
        $this->_purchase_order = $this->_Model->loadPurchaseOrder(array(
            'id_purchase_order' => $this->_id_purchase_order)
        );

        $this->_checkEstablishment($this->_purchase_order['fk_id_establishment']);
        $this->_checkPermissions();
        $this->_isBlocked();
    }

    public function index() {
        $this->_send($this->_purchase_order);
    }

    private function _send($data) {
        $errors = array();
        $values = array(
            'id_purchase_order' => $this->_id_purchase_order
        );

        if (is_empty($this->_purchase_order)) {
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
