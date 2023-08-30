<?php

class DisassociateController extends BillsController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new GuidesModel();

        $this->_id_guide = (int) DecomposeUrl::getArgument(0);
        $this->_guide = $this->_Model->loadGuide(array(
            'id_guide' => $this->_id_guide)
        );
    }

    public function index() {
        $this->_send($this->_bill);
    }

    private function _send($data) {
        $errors = array();
        $values = array(
            'id_guide' => $this->_id_guide
        );

        if (is_empty($this->_guide)) {
            $errors[] = 'El elemento seleccionado no existe';
        } else {
            $this->_Model->disassociateGuide($values);

            $MsgBox = new MsgBox();
            $MsgBox->setEvent('success');
            $MsgBox->setMessage('La operacion solicitada se ha realizado satisfactoriamente.');
            $MsgBox->setItems($errors);
            $MsgBox->saveInSession();
            unset($MsgBox);

            redirect(path::urlDomain('./guides/' . $this->_guide['fk_id_bill']));
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
