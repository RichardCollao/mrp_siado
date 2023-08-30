<?php

class CreateModel extends PurchaseOrdersModel {

    public function __construct() {
        parent::__construct();
    }

    public function createPurchaseOrder($values) {
        extract($values);
        $this->query('INSERT INTO purchase_orders '
                . '(fk_id_establishment, fk_id_provider, number, issue_date, created_at, status, '
                . 'vendor_name, vendor_contact, '
                . 'dispatch_name, dispatch_contact, dispatch_address,'
                . 'number_material_request, number_quotation, way_to_pay, observation, footer) '
                . 'VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
                , array($fk_id_establishment, $fk_id_provider, $number, $issue_date, $created_at, $status, 
                    $vendor_name, $vendor_contact, 
                    $dispatch_name, $dispatch_contact, $dispatch_address,
                    $number_material_request, $number_quotation, $way_to_pay, $observation, $footer)
        );
        return $this->getLastInsertId();
    }

}
