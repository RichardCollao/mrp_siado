<?php

class DeleteController extends MoldingsController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new DeleteModel();

        $this->_id_molding = (int) DecomposeUrl::getArgument(0);
        $this->_molding = $this->_Model->loadMolding(array(
            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'),
            'id_molding' => $this->_id_molding)
        );
    }

    public function index() {
        $this->_send($this->_molding);
    }

    private function _send($data) {
        $errors = array();
        $values = array(
            'id_molding' => $this->_id_molding
        );

        if (is_empty($this->_molding)) {
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
