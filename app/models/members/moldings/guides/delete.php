<?php

class DeleteModel extends GuidesModel {

    public function __construct() {
        parent::__construct();
    }

    public function delete($values) {
        extract($values);
        return $this->query('DELETE '
                        . 'FROM moldings_guides '
                        . 'WHERE id_molding_guide=? '
                        , array($id_molding_guide)
        );
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

}
