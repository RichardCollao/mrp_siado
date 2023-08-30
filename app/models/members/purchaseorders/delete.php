<?php

class DeleteModel extends PurchaseOrdersModel {

    public function __construct() {
        parent::__construct();
    }

    public function delete($values) {
        extract($values);
        return $this->query('DELETE '
                    . 'FROM purchase_orders '
                    . 'WHERE id_purchase_order = ? '
                    , array($id_purchase_order)
            );
    }

    public function loadPurchaseOrder($values) {
        extract($values);
        $this->query('SELECT * '
                . 'FROM purchase_orders '
                . 'WHERE id_purchase_order = ? '
                , array($id_purchase_order)
        );
        return $this->getFetch();
    }

}
