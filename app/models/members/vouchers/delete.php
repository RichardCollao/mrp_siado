<?php

class DeleteModel extends VouchersModel {

    public function __construct() {
        parent::__construct();
    }

    public function delete($values) {
        extract($values);
        $this->query('DELETE '
                . 'FROM vouchers '
                . 'WHERE id_voucher=?'
                , array($id_voucher)
        );
    }

    public function loadvoucher($values) {
        extract($values);
        $this->query('SELECT * '
                . 'FROM vouchers '
                . 'WHERE id_voucher=? '
                , array($id_voucher)
        );
        return $this->getFetch();
    }

}
