<?php

class EditModel extends DetailsModel {

    public function __construct() {
        parent::__construct();
    }

    public function editItem($values) {
        extract($values);
        return $this->query('UPDATE purchase_orders_details '
                . 'SET fk_id_material=?, code=?, quantity=?, value=? '
                . 'WHERE id_purchase_order_detail=?'
                , array($fk_id_material, $code, $quantity, $value, $id_purchase_order_detail)
        );
    }

    public function loadDetails($values) {
        extract($values);
        $this->query('SELECT purchase_orders_details.*, '
                . 'materials.name, '
                . 'measures.abbreviation '
                . 'FROM purchase_orders_details, materials, measures '
                . 'WHERE purchase_orders_details.fk_id_purchase_order=? '
                . 'AND purchase_orders_details.id_purchase_order_detail<>? '
                . 'AND materials.id_material = purchase_orders_details.fk_id_material '
                . 'AND measures.id_measure = materials.fk_id_measure'
                , array($fk_id_purchase_order, $id_detail)
        );
        return $this->getFetchAll();
    }

}
