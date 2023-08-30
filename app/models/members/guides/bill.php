<?php

class BillModel extends GuidesModel {

    public function __construct() {
        parent::__construct();
    }

    public function loadGuides($values) {
        extract($values);
        $this->query($this->view_guides()
                . 'WHERE purchase_orders.id_purchase_order = guides.fk_id_purchase_order '
                . 'AND purchase_orders.fk_id_establishment = ? '
                . 'AND guides.fk_id_bill = ?'
                , array($fk_id_establishment, $fk_id_bill)
        );
        return $this->getFetchAll();
    }

    public function loadBill($values) {
        extract($values);
        $this->query($this->view_bills()
                . 'WHERE bills.id_bill = ? '
                . 'AND purchase_orders.id_purchase_order = bills.fk_id_purchase_order'
                , array($id_bill)
        );
        return $this->getFetch();
    }

}
