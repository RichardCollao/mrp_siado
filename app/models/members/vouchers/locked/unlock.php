<?php

class UnlockModel extends LockedModel {

    public function __construct() {
        parent::__construct();
    }

    public function unlock($values) {
        extract($values);
        return $this->query('UPDATE vouchers '
                        . 'SET locked=false '
                        . 'WHERE id_voucher=?'
                        , array($id_voucher)
        );
    }

}
