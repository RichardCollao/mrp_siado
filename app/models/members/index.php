<?php

class IndexModel extends MembersModel {

    public function __construct() {
        parent::__construct();
    }

    public function loadPurchaseOrders($values) {
        extract($values);
        $this->query($this->view_purchase_orders()
                . 'WHERE purchase_orders.fk_id_establishment=? '
                . 'ORDER BY purchase_orders.created_at DESC '
                . 'LIMIT 10'
                , array($fk_id_establishment)
        );
        return $this->getFetchAll();
    }

    public function loadBills($values) {
        extract($values);
        $this->query($this->view_bills()
                . 'WHERE purchase_orders.fk_id_establishment=? '
                . 'ORDER BY bills.created_at DESC '
                . 'LIMIT 10'
                , array($fk_id_establishment)
        );
        return $this->getFetchAll();
    }

    public function loadGuides($values) {
        extract($values);
        $this->query($this->view_guides()
                . 'WHERE purchase_orders.fk_id_establishment=? '
                . 'ORDER BY guides.created_at DESC '
                . 'LIMIT 10'
                , array($fk_id_establishment)
        );
        return $this->getFetchAll();
    }

}
