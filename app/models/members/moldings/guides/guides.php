<?php

class GuidesModel extends MoldingsModel {

    public function __construct() {
        parent::__construct();
    }

    public function loadMoldingGuide($values) {
        extract($values);
        $this->query('SELECT * '
                . 'FROM moldings_guides '
                . 'WHERE id_molding_guide=? '
                , array($id_molding_guide)
        );
        return $this->getFetch();
    }

    public function listPieces($values) {
        extract($values);
        $this->query('SELECT * '
                . 'FROM moldings_pieces '
                . 'WHERE fk_id_molding=? '
                . 'ORDER BY name ASC '
                , array($fk_id_molding)
        );
        return $this->getFetchAll();
    }

    public function duplicateNumber($values) {
        extract($values);
        $this->query('SELECT * '
                . 'FROM moldings_guides '
                . 'WHERE id_molding_guide<>? '
                . 'AND fk_id_molding=? '
                . 'AND number=? '
                , array($id_molding_guide, $fk_id_molding, $number)
        );
        return $this->getFetch();
    }

}
