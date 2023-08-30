<?php

class PurchaseOrdersModel extends MembersModel {

    public function __construct() {
        parent::__construct();
    }

    public function loadPurchaseOrder($values) {
        extract($values);
        $this->query($this->view_purchase_orders()
                . 'WHERE purchase_orders.id_purchase_order = ? '
                , array($id_purchase_order)
        );
        return $this->getFetch();
    }


    public function listMaterials($values) {
        extract($values);
        $this->query($this->view_materials()
                . 'WHERE materials.fk_id_establishment = ? '
                . 'ORDER BY materials.name'
                , array($fk_id_establishment)
        );
        return $this->getFetchAll();
    }

    public function listProviders($values) {
        extract($values);
        $this->query('SELECT * '
                . 'FROM providers '
                . 'WHERE fk_id_establishment=? '
                . 'ORDER BY name ASC'
                , array($fk_id_establishment)
        );
        return $this->getFetchAll();
    }

    public function duplicateNumber($values) {
        extract($values);
        $this->query('SELECT * '
                . 'FROM purchase_orders '
                . 'WHERE fk_id_establishment=? AND number=? AND id_purchase_order<>? '
                , array($fk_id_establishment, $number, $id_purchase_order)
        );
        return $this->getFetch();
    }

}
