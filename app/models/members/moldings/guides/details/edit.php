<?php

class EditModel extends DetailsModel {

    public function __construct() {
        parent::__construct();
    }

    public function editItem($values) {
        extract($values);
        return $this->query('UPDATE moldings_guides_details '
                . 'SET fk_id_molding_piece=?, quantity=? '
                . 'WHERE id_molding_guide_detail=?'
                , array($fk_id_molding_piece, $quantity, $id_molding_guide_detail)
        );
    }

    // Sobreescribe el metodo, no trae el item que se esta editando
    public function loadDetails($values) {
        extract($values);
        $this->query('SELECT *, moldings_pieces.weight * moldings_guides_details.quantity AS total '
                . 'FROM moldings_guides_details, moldings_pieces '
                . 'WHERE fk_id_molding_guide = ? '
                . 'AND id_molding_guide_detail <> ? '
                . 'AND moldings_pieces.id_molding_piece = moldings_guides_details.fk_id_molding_piece '
                , array($fk_id_molding_guide, $id_molding_guide_detail)
        );
        return $this->getFetchAll();
    }

}
