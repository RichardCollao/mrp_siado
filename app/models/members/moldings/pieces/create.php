<?php

class CreateModel extends PiecesModel {

    public function __construct() {
        parent::__construct();
    }

    public function createPiece($values) {
        extract($values);
        $this->query('INSERT INTO moldings_pieces '
                . '(fk_id_molding, code, name, weight) '
                . 'VALUES (?, ?, ?, ?)'
                , array($fk_id_molding, $code, $name, $weight)
        );
        return $this->getLastInsertId();
    }


}
