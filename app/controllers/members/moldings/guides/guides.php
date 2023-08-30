<?php

class GuidesController extends MoldingsController {

    public function __construct() {
        parent::__construct();
    }

    public function loadLists() {

        $this->list_guides_types = array(
            'reception' => 'Recepcion',
            'returned'  => 'Retorno'
        );
        
        $pieces = $this->_Model->listPieces(array(
            'fk_id_molding' => $this->_id_molding)
        );
        foreach ($pieces as $row) {
            $this->list_pieces[] = array('id' => $row['id_molding_piece'],
                "columns" => array(
                    $row['name'],
                    $row['code'],
                    $row['weight']
                )
            );
        }
    }

    protected function _checkLists() {
        $errors = array();
        if (is_empty($this->list_pieces)) {
            $errors[] = 'No se encontro ninguna pieza para este moldaje';
        }

        if (!is_empty($errors)) {
            $MsgBox = new MsgBox();

            $MsgBox->setEvent('info');
            $MsgBox->setMessage('Antes de continuar primero debe corregir los siguientes errores.');
            $MsgBox->setItems($errors);
            $MsgBox->saveInSession();
            unset($MsgBox);

//            redirect(path::urlDomain('./'));
        }
    }

}
