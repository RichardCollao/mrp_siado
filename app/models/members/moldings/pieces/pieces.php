<?php

class PiecesModel extends MoldingsModel {

    public function __construct() {
        parent::__construct();
    }

    public function duplicatePieceCode($values) {
        extract($values);
        $this->query('SELECT * '
                . 'FROM moldings_pieces '
                . 'WHERE fk_id_molding=? '
                . 'AND id_molding_piece<>? '
                . 'AND code=? '
                . 'AND code<>""'
                , array($fk_id_molding, $id_molding_piece, $code)
        );
        return $this->getFetch();
    }

    public function duplicatePieceName($values) {
        extract($values);
        $this->query('SELECT * '
                . 'FROM moldings_pieces '
                . 'WHERE fk_id_molding=? '
                . 'AND id_molding_piece<>? '
                . 'AND name=?'
                , array($fk_id_molding, $id_molding_piece, $name)
        );
        return $this->getFetch();
    }

    public function loadMoldingPiece($values) {
        extract($values);
        $this->query('SELECT * '
                . 'FROM moldings_pieces '
                . 'WHERE id_molding_piece=? '
                , array($id_molding_piece)
        );
        return $this->getFetch();
    }

}
