<?php

class DetailsModel extends GuidesModel {

    public function __construct() {
        parent::__construct();
    }

    public function loadDetail($values) {
        extract($values);
        $this->query('SELECT *, moldings_pieces.weight * moldings_guides_details.quantity AS total '
                . 'FROM moldings_guides_details, moldings_pieces '
                . 'WHERE id_molding_guide_detail=? '
                . 'AND moldings_pieces.id_molding_piece = moldings_guides_details.fk_id_molding_piece '
                , array($id_molding_guide_detail)
        );
        return $this->getFetch();
    }

}
