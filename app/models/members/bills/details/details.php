<?php

class DetailsModel extends BillsModel {

    public function __construct() {
        parent::__construct();
    }

    public function loadDetail($values) {
        extract($values);
        $this->query('SELECT bills_details.*, '
                . 'purchase_orders.fk_id_establishment, '
                . 'materials.name, measures.abbreviation '
                . 'FROM bills_details, purchase_orders, purchase_orders_details, materials, measures '
                . 'WHERE bills_details.id_bill_detail = ? '
                . 'AND purchase_orders_details.id_purchase_order_detail = bills_details.fk_id_purchase_order_detail '
                . 'AND purchase_orders.id_purchase_order = purchase_orders_details.fk_id_purchase_order '
                . 'AND materials.id_material = purchase_orders_details.fk_id_material '
                . 'AND measures.id_measure = materials.fk_id_measure'
                , array($id_bill_detail)
        );
        return $this->getFetch();
    }

}
