<?php

class EditModel extends VouchersModel {

    public function __construct() {
        parent::__construct();
    }

    public function editVoucher($values) {
        extract($values);
        return $this->query('UPDATE vouchers '
                        . 'SET fk_id_user_autorized=?, user_name_requesting=?, number=?, '
                        . 'issue_date=?, destination=?, observation=? '
                        . 'WHERE id_voucher=?'
                        , array($fk_id_user_autorized, $user_name_requesting, $number
                    , $issue_date, $destination, $observation, $id_voucher)
        );
    }

}
