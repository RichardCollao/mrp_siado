<?php

class EditModel extends GuidesModel {

    public function __construct() {
        parent::__construct();
    }

    public function editGuide($values) {
        extract($values);
        return $this->query('UPDATE guides '
                        . 'SET fk_id_purchase_order=?, number=?, issue_date=?, created_at=?, observation=?, status=? '
                        . 'WHERE id_guide=?'
                        , array($fk_id_purchase_order, $number, $issue_date, $created_at, $observation, $status
                    , $id_guide)
        );
    }

}
