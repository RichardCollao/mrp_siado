<?php

class CreateModel extends GuidesModel {

    public function __construct() {
        parent::__construct();
    }

    public function createGuide($values) {
        extract($values);
        $this->query('INSERT INTO guides '
                . '(fk_id_purchase_order, number, issue_date, created_at, observation, status) '
                . 'VALUES (?, ?, ?, ?, ?, ?)'
                , array($fk_id_purchase_order, $number, $issue_date, $created_at, $observation, $status)
        );
        return $this->getLastInsertId();
    }

}
