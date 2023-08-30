<?php

class DetailsModel extends GuidesModel {

    public function __construct() {
        parent::__construct();
    }

    public function loadDetail($values) {
        extract($values);
        $this->query('SELECT guides_details.*, '
                . 'purchase_orders.fk_id_establishment, '
                . 'purchase_orders_details.value AS po_value, '
                . 'materials.name, '
                . 'measures.abbreviation, '
                . 'guides_details.*, (guides_details.quantity * purchase_orders_details.value) AS total, '
                
                . '(SELECT COALESCE(SUM(guides_details.quantity), 0)  
                   FROM guides_details, purchase_orders_details 
                   WHERE purchase_orders_details.fk_id_material = materials.id_material
                   AND guides_details.fk_id_purchase_order_detail = purchase_orders_details.id_purchase_order_detail) 
                   - 
                   (SELECT COALESCE(SUM(vouchers_details.quantity), 0) 
                   FROM vouchers_details 
                   WHERE vouchers_details.fk_id_material = materials.id_material) AS stock '
                
                . 'FROM guides_details, purchase_orders, purchase_orders_details, materials, measures '
                . 'WHERE guides_details.id_guide_detail = ? '
                . 'AND purchase_orders_details.id_purchase_order_detail = guides_details.fk_id_purchase_order_detail '
                . 'AND purchase_orders.id_purchase_order = purchase_orders_details.fk_id_purchase_order '
                . 'AND materials.id_material = purchase_orders_details.fk_id_material '
                . 'AND measures.id_measure = materials.fk_id_measure '
                . 'LIMIT 1'
                , array($id_guide_detail)
        );
        return $this->getFetch();
    }

}
