<?php

class IndexModel extends VouchersModel {

    public function __construct() {
        parent::__construct();
    }

    public function countRows($wheres, $filters) {
        #extract($values);
        $this->query('SELECT count(*) AS total '
                . 'FROM vouchers '
                . 'WHERE fk_id_establishment=? '
                . $filters[0]
                , array_merge($wheres[1], $filters[1])
        );
        return $this->getFetch();
    }

    public function loadVouchers($wheres, $filters, $limits) {
        #extract($values);
        $this->query($this->view_vouchers()
                . 'WHERE vouchers.fk_id_establishment=? '
                . $filters[0]
                . 'ORDER BY vouchers.created_at DESC '
                . $limits[0]
                , array_merge($wheres[1], $filters[1], $limits[1])
        );
        return $this->getFetchAll();
    }

}
