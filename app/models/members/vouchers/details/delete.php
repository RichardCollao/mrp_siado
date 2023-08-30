<?php

class DeleteModel extends DetailsModel {

    public function __construct() {
        parent::__construct();
    }

    public function DeleteItem($values) {
        extract($values);
        return $this->query('DELETE FROM vouchers_details '
                        . 'WHERE id_voucher_detail = ?'
                        , array($id_voucher_detail)
        );
    }

}
