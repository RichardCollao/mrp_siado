<?php

class IndexModel extends PiecesModel {

    public function __construct() {
        parent::__construct();
    }

    public function countRows($wheres, $filters) {
        #extract($values);
        $this->query('SELECT count(*) AS total '
                . 'FROM moldings_pieces '
                . 'WHERE moldings_pieces.fk_id_molding=? '
                . $filters[0]
                , array_merge($wheres[1], $filters[1])
        );
        return $this->getFetch();
    }

    public function loadPieces($wheres, $filters, $limits) {
        #extract($values);
        $this->query('SELECT *, '
                . '(SELECT COALESCE(SUM(moldings_guides_details.quantity), 0) 
                FROM moldings_guides_details, moldings_guides 
                WHERE moldings_guides_details.fk_id_molding_piece = moldings_pieces.id_molding_piece 
                AND moldings_guides.id_molding_guide = moldings_guides_details.fk_id_molding_guide 
                AND moldings_guides.type = "reception") AS total_reception, '
                . '(SELECT COALESCE(SUM(moldings_guides_details.quantity), 0) 
                FROM moldings_guides_details, moldings_guides 
                WHERE moldings_guides_details.fk_id_molding_piece = moldings_pieces.id_molding_piece 
                AND moldings_guides.id_molding_guide = moldings_guides_details.fk_id_molding_guide 
                AND moldings_guides.type = "returned") AS total_returned '
                . 'FROM moldings_pieces '
                . 'WHERE fk_id_molding=? '
                . $filters[0]
                . 'ORDER BY moldings_pieces.name ASC '
                . $limits[0]
                , array_merge($wheres[1], $filters[1], $limits[1])
        );
        return $this->getFetchAll();
    }


}
