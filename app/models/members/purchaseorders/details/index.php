<?php

class IndexModel extends DetailsModel {

    public function __construct() {
        parent::__construct();
    }

    public function addItem($values) {
        extract($values);
        $this->query('INSERT INTO purchase_orders_details '
                . '(fk_id_purchase_order, fk_id_material, code, quantity, value) '
                . 'VALUES (?, ?, ?, ?, ?)'
                , array($fk_id_purchase_order, $fk_id_material, $code, $quantity, $value)
        );
        return $this->getLastInsertId();
    }

    public function loadDetails($values) {
        extract($values);
        $this->query('SELECT purchase_orders_details.*, '
                . 'materials.name, '
                . 'measures.abbreviation '
                . 'FROM purchase_orders_details, materials, measures '
                . 'WHERE purchase_orders_details.fk_id_purchase_order=? '
                . 'AND materials.id_material = purchase_orders_details.fk_id_material '
                . 'AND measures.id_measure = materials.fk_id_measure'
                , array($fk_id_purchase_order)
        );
        return $this->getFetchAll();
    }

}
