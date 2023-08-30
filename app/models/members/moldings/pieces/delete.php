<?php

class DeleteModel extends PiecesModel {

    public function __construct() {
        parent::__construct();
    }

    public function Delete($values) {
        extract($values);
        return $this->query('DELETE '
                . 'FROM moldings_pieces '
                . 'WHERE id_molding_piece = ?'
                , array($id_molding_piece)
        );
    }

}
