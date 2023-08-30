<?php

class DisplayModel extends PurchaseOrdersModel {

    public function __construct() {
        parent::__construct();
    }

    public function loadDetails($values) {
        extract($values);
        $this->query('SELECT purchase_orders_details.*, '
                . 'materials.name, '
                . 'measures.abbreviation, '
                
                . '(SELECT COALESCE(SUM(guides_details.quantity), 0) '
                . 'FROM guides_details '
                . 'WHERE guides_details.fk_id_purchase_order_detail = purchase_orders_details.id_purchase_order_detail) AS received '
                
                . 'FROM purchase_orders_details, materials, measures '
                . 'WHERE purchase_orders_details.fk_id_purchase_order=? '
                . 'AND materials.id_material = purchase_orders_details.fk_id_material '
                . 'AND measures.id_measure = materials.fk_id_measure'
                , array($fk_id_purchase_order)
        );
        return $this->getFetchAll();
    }

}
