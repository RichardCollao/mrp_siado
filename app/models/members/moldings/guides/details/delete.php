<?php

class DeleteModel extends DetailsModel {

    public function __construct() {
        parent::__construct();
    }

    public function DeleteItem($values) {
        extract($values);
        return $this->query('DELETE FROM moldings_guides_details '
                        . 'WHERE id_molding_guide_detail=?'
                        , array($id_molding_guide_detail)
        );
    }

}
