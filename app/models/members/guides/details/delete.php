<?php

class DeleteModel extends DetailsModel {

    public function __construct() {
        parent::__construct();
    }

    public function DeleteItem($values) {
        extract($values);
        return $this->query('DELETE FROM guides_details '
                        . 'WHERE id_guide_detail = ?'
                        , array($id_guide_detail)
        );
    }

}
