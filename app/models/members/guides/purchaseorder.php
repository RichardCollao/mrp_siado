<?php

class PurchaseorderModel extends GuidesModel {

    public function __construct() {
        parent::__construct();
    }

    public function loadGuides($values) {
        extract($values);
        $this->query($this->view_guides()
                . 'WHERE purchase_orders.fk_id_establishment = ? '
                . 'AND guides.fk_id_purchase_order = ?'
                , array($fk_id_establishment, $fk_id_purchase_order)
        );
        return $this->getFetchAll();
    }

    public function loadPurchaseOrder($values) {
        extract($values);
        $this->query($this->view_purchase_orders()
                . 'WHERE purchase_orders.id_purchase_order = ? '
                , array($id_purchase_order)
        );
        return $this->getFetch();
    }

}
