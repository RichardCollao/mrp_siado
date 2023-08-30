<?php

class EditModel extends DetailsModel {

    public function __construct() {
        parent::__construct();
    }

    public function editItem($values) {
        extract($values);
        return $this->query('UPDATE guides_details '
                . 'SET fk_id_purchase_order_detail=?, quantity=? '
                . 'WHERE id_guide_detail=?'
                , array($fk_id_purchase_order_detail, $quantity, $id_guide_detail)
        );
    }

    // @override
    public function loadDetails($values) {
        extract($values);
        $this->query('SELECT guides_details.*, purchase_orders_details.value AS po_value, materials.name, '
                . 'measures.abbreviation, '
                . 'guides_details.*, (guides_details.quantity * purchase_orders_details.value) AS total '
                . 'FROM guides_details, purchase_orders_details, materials, measures '
                . 'WHERE guides_details.fk_id_guide = ? '
                . 'AND guides_details.id_guide_detail <> ? '
                . 'AND purchase_orders_details.id_purchase_order_detail = guides_details.fk_id_purchase_order_detail '
                . 'AND materials.id_material = purchase_orders_details.fk_id_material '
                . 'AND measures.id_measure = materials.fk_id_measure '
                , array($fk_id_guide, $id_guide_detail)
        );
        return $this->getFetchAll();
    }

}
