<?php

class IndexModel extends GuidesModel {

    public function __construct() {
        parent::__construct();
    }

    public function addItem($values) {
        extract($values);
        $this->query('INSERT INTO guides_details '
                . '(fk_id_guide, fk_id_purchase_order_detail, quantity) '
                . 'VALUES (?, ?, ?)'
                , array($fk_id_guide, $fk_id_purchase_order_detail, $quantity)
        );
        return $this->getLastInsertId();
    }

    public function loadDetails($values) {
        extract($values);
        $this->query('SELECT guides_details.*, purchase_orders_details.value AS po_value, materials.name, '
                . 'measures.abbreviation, '
                . 'guides_details.*, (guides_details.quantity * purchase_orders_details.value) AS total '
                . 'FROM guides_details, purchase_orders_details, materials, measures '
                . 'WHERE guides_details.fk_id_guide = ? '
                . 'AND purchase_orders_details.id_purchase_order_detail = guides_details.fk_id_purchase_order_detail '
                . 'AND materials.id_material = purchase_orders_details.fk_id_material '
                . 'AND measures.id_measure = materials.fk_id_measure '
                , array($fk_id_guide)
        );
        return $this->getFetchAll();
    }

}
