<?php

class EditModel extends PiecesModel {

    public function __construct() {
        parent::__construct();
    }

    public function editMoldingPiece($values) {
        extract($values);
        return $this->query('UPDATE moldings_pieces '
                        . 'SET code=?, name=?, weight=? '
                        . 'WHERE id_molding_piece=? '
                        , array($code, $name, $weight, $id_molding_piece)
        );
    }

}
