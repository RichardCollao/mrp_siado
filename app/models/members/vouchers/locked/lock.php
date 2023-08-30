<?php

class LockModel extends LockedModel {

    public function __construct() {
        parent::__construct();
    }

    public function lock($values) {
        extract($values);
        return $this->query('UPDATE vouchers '
                        . 'SET locked=true '
                        . 'WHERE id_voucher=?'
                        , array($id_voucher)
        );
    }

}
