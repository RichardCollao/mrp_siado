<?php

class CreateModel extends BillsModel {

    public function __construct() {
        parent::__construct();
    }

    public function createBill($values) {
        extract($values);
        $this->query('INSERT INTO bills '
                . '(fk_id_purchase_order, number, issue_date, created_at, observation, status) '
                . 'VALUES (?, ?, ?, ?, ?, ?)'
                , array($fk_id_purchase_order, $number, $issue_date, $created_at, $observation, $status)
        );
        return $this->getLastInsertId();
    }

}
