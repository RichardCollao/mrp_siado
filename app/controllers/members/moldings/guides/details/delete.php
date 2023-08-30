<?php

class DeleteController extends GuidesController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new DeleteModel();

        $this->_id_molding_guide_detail = (int) DecomposeUrl::getArgument(0);
        $this->_molding_guide_detail = $this->_Model->loadDetail(array(
            'id_molding_guide_detail' => $this->_id_molding_guide_detail)
        );
    }

    public function index() {
        $this->_send($this->_guide_detail);
    }

    private function _send($data) {
        $errors = array();
        $values = array(
            'id_molding_guide_detail' => $this->_id_molding_guide_detail
        );

        if (is_empty($this->_molding_guide_detail)) {
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

                redirect(path::urlDomain('./' . $this->_molding_guide_detail['fk_id_molding_guide']));
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

        redirect(path::urlDomain('./' . $this->_molding_guide_detail['fk_id_molding_guide']));
    }

}
