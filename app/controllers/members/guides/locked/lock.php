<?php

class LockController extends LockedController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new LockModel();
        $this->_id_guide = (int) DecomposeUrl::getArgument(0);
        $this->_guide = $this->_Model->loadGuide(array(
            'id_guide' => $this->_id_guide)
        );

        $this->_checkEstablishment($this->_guide['fk_id_establishment']);
        $this->_checkPermissions();
    }

    public function index() {
        $data = $this->_guide;
        $this->_send($data);
    }

    private function _send($data) {
        $errors = array();
        $values = array(
            'id_guide' => $this->_id_guide,
            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT')
        );

        if ($this->_Model->lock($values)) {
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
