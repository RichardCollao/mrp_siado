<?php

class UnlockModel extends LockedModel {

    public function __construct() {
        parent::__construct();
    }

    public function unlock($values) {
        extract($values);
        return $this->query('UPDATE purchase_orders '
                        . 'SET locked=false '
                        . 'WHERE fk_id_establishment=? '
                        . 'AND id_purchase_order=?'
                        , array($fk_id_establishment, $id_purchase_order)
        );
    }

}
