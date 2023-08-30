<?php

class IndexModel extends GuidesModel {

    public function __construct() {
        parent::__construct();
    }

    public function addItem($values) {
        extract($values);
        $this->query('INSERT INTO moldings_guides_details '
                . '(fk_id_molding_guide, fk_id_molding_piece, quantity) '
                . 'VALUES (?, ?, ?)'
                , array($fk_id_molding_guide, $fk_id_molding_piece, $quantity)
        );
        return $this->getLastInsertId();
    }

    public function loadDetails($values) {
        extract($values);
        $this->query('SELECT *, moldings_pieces.weight * moldings_guides_details.quantity AS total '
                . 'FROM moldings_guides_details, moldings_pieces '
                . 'WHERE fk_id_molding_guide = ? '
                . 'AND moldings_pieces.id_molding_piece = moldings_guides_details.fk_id_molding_piece '
                , array($fk_id_molding_guide)
        );
        return $this->getFetchAll();
    }

}
