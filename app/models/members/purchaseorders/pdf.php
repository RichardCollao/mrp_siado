<?php

class PdfModel extends PurchaseOrdersModel {

    public function __construct() {
        parent::__construct();
    }

    public function loadPurchaseOrders($values) {
        extract($values);
        $this->query('SELECT  * '
                . 'FROM purchase_orders '
                . 'WHERE id_purchase_order = ? '
                , array($id_purchase_order)
        );
        return $this->getFetchAll();
    }

    public function loadPurchaseOrderDetails($values) {
        extract($values);
        $this->query('SELECT purchase_orders_details.*, materials.name, measures.abbreviation '
                . 'FROM purchase_orders_details, materials, measures '
                . 'WHERE  purchase_orders_details.fk_id_purchase_order=? '
                . 'AND purchase_orders_details.fk_id_material=materials.id_material '
                . 'AND measures.id_measure = materials.fk_id_measure'
                , array($id_purchase_order)
        );
        return $this->getFetchAll();
    }

    public function loadEstablishment($values) {
        extract($values);
        $this->query('SELECT * '
                . 'FROM establishments '
                . 'WHERE id_establishment = ?'
                , array($id_establishment)
        );
        return $this->getFetch();
    }

    public function loadProvider($values) {
        extract($values);
        $this->query('SELECT * '
                . 'FROM providers '
                . 'WHERE id_provider = ?'
                , array($id_provider)
        );
        return $this->getFetch();
    }

}
