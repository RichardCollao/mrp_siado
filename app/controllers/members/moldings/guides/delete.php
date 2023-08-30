<?php

class DeleteController extends GuidesController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new DeleteModel();

        $this->_id_molding_guide = (int) DecomposeUrl::getArgument(0);
        $this->_molding_guide = $this->_Model->loadMoldingGuide(array(
            'id_molding_guide' => $this->_id_molding_guide)
        );
    }

    public function index() {
        $this->_send($this->_molding_guide);
    }

    private function _send($data) {
        $errors = array();
        $values = array(
            'id_molding_guide' => $this->_id_molding_guide
        );

        if (is_empty($this->_molding_guide)) {
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

                redirect(path::urlDomain('./' . $this->_molding_guide['fk_id_molding']));
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

        redirect(path::urlDomain('./' . $this->_molding_guide['fk_id_molding']));
    }

}
