<?php

class EditModel extends BillsModel {

    public function __construct() {
        parent::__construct();
    }

    public function editBill($values) {
        extract($values);
        return $this->query('UPDATE bills '
                        . 'SET fk_id_purchase_order=?, number=?, issue_date=?, created_at=?, observation=?, status=? '
                        . 'WHERE id_bill=?'
                        , array($fk_id_purchase_order, $number, $issue_date, $created_at, $observation, $status
                    , $id_bill)
        );
    }

}
