<?php

class EditModel extends DetailsModel {

    public function __construct() {
        parent::__construct();
    }

    public function editItem($values) {
        extract($values);
        return $this->query('UPDATE bills_details '
                . 'SET fk_id_purchase_order_detail=?, quantity=?, value=? '
                . 'WHERE id_bill_detail=?'
                , array($fk_id_purchase_order_detail, $quantity, $value, $id_bill_detail)
        );
    }

    public function loadDetails($values) {
        extract($values);
        $this->query('SELECT bills_details.*, materials.name, measures.abbreviation '
                . 'FROM bills_details, purchase_orders_details, materials, measures '
                . 'WHERE bills_details.fk_id_bill = ? '
                . 'AND bills_details.id_bill_detail <> ? '
                . 'AND purchase_orders_details.id_purchase_order_detail = bills_details.fk_id_purchase_order_detail '
                . 'AND materials.id_material = purchase_orders_details.fk_id_material '
                . 'AND measures.id_measure = materials.fk_id_measure'
                , array($fk_id_bill, $id_bill_detail)
        );
        return $this->getFetchAll();
    }
}