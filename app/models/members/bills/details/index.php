<?php

class IndexModel extends DetailsModel {

    public function __construct() {
        parent::__construct();
    }

    public function addItem($values) {
        extract($values);
        $this->query('INSERT INTO bills_details '
                . '(fk_id_bill, fk_id_purchase_order_detail, quantity, value) '
                . 'VALUES (?, ?, ?, ?)'
                , array($fk_id_bill, $fk_id_purchase_order_detail, $quantity, $value)
        );
        return $this->getLastInsertId();
    }

    public function loadDetails($values) {
        extract($values);
        $this->query('SELECT bills_details.*, materials.name, measures.abbreviation '
                . 'FROM bills_details, purchase_orders_details, materials, measures '
                . 'WHERE bills_details.fk_id_bill = ? '
                . 'AND purchase_orders_details.id_purchase_order_detail = bills_details.fk_id_purchase_order_detail '
                . 'AND materials.id_material = purchase_orders_details.fk_id_material '
                . 'AND measures.id_measure = materials.fk_id_measure'
                , array($fk_id_bill)
        );
        return $this->getFetchAll();
    }

}
