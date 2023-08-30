<?php

class DetailsModel extends PurchaseOrdersModel {

    public function __construct() {
        parent::__construct();
    }

    public function loadDetail($values) {
        extract($values);
        $this->query('SELECT purchase_orders.fk_id_establishment,'
                . 'purchase_orders_details.*, '
                . 'materials.name, '
                . 'measures.abbreviation '
                . 'FROM purchase_orders, purchase_orders_details, materials, measures '
                . 'WHERE purchase_orders_details.id_purchase_order_detail=? '
                . 'AND purchase_orders.id_purchase_order = purchase_orders_details.fk_id_purchase_order '
                . 'AND materials.id_material = purchase_orders_details.fk_id_material '
                . 'AND measures.id_measure = materials.fk_id_measure '
                . 'LIMIT 1'
                , array($id_purchase_order_detail)
        );
        return $this->getFetch();
    }

}
