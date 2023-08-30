<?php

class DeleteController extends MoldingsController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new DeleteModel();

        $this->_id_molding_piece = (int) DecomposeUrl::getArgument(0);
        $this->_molding_piece = $this->_Model->loadMoldingPiece(array(
            'id_molding_piece' => $this->_id_molding_piece)
        );
    }

    public function index() {
        $this->_send($this->_molding_piece);
    }

    private function _send($data) {
        $errors = array();
        $values = array(
            'id_molding_piece' => $this->_id_molding_piece
        );

        if (is_empty($this->_molding_piece)) {
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

                redirect(path::urlDomain('./' . $this->_molding_piece['fk_id_molding']));
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
