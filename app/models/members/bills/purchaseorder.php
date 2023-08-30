<?php

class PurchaseorderModel extends BillsModel {

    public function __construct() {
        parent::__construct();
    }

    public function loadBills($values) {
        extract($values);
        $this->query($this->view_bills() 
                . 'WHERE purchase_orders.fk_id_establishment = ? '
                . 'AND bills.fk_id_purchase_order = ?'
                , array($fk_id_establishment, $fk_id_purchase_order)
        );
        return $this->getFetchAll();
    }
    
    public function loadPurchaseOrder($values) {
        extract($values);
        $this->query('SELECT * '
                . 'FROM purchase_orders ' 
                . 'WHERE purchase_orders.id_purchase_order = ? '
                , array($id_purchase_order)
        );
        return $this->getFetch();
    }
}
