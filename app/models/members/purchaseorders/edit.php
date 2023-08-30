<?php

class EditModel extends PurchaseOrdersModel {

    public function __construct() {
        parent::__construct();
    }

    public function editPurchaseOrder($values) {
        extract($values);
        return $this->query('UPDATE purchase_orders '
                        . 'SET fk_id_provider=?, number=?, issue_date=?, '
                        . 'vendor_name=?, vendor_contact=?, '
                        . 'dispatch_name=?, dispatch_contact=?, dispatch_address=?, '
                        . 'number_material_request=?, number_quotation=?, way_to_pay=?, observation=?, footer=? '
                        . 'WHERE fk_id_establishment=? AND id_purchase_order=?'
                        , array($fk_id_provider, $number, $issue_date,
                    $vendor_name, $vendor_contact, 
                    $dispatch_name, $dispatch_contact, $dispatch_address,
                    $number_material_request, $number_quotation, $way_to_pay, $observation, $footer, 
                    $fk_id_establishment, $id_purchase_order)
        );
    }

}
