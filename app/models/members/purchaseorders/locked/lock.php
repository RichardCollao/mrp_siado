<?php

class LockModel extends LockedModel {

    public function __construct() {
        parent::__construct();
    }

    public function lock($values) {
        extract($values);
        return $this->query('UPDATE purchase_orders '
                        . 'SET locked=true '
                        . 'WHERE fk_id_establishment=? '
                        . 'AND id_purchase_order=?'
                        , array($fk_id_establishment, $id_purchase_order)
        );
    }

}
