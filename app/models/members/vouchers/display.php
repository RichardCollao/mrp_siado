<?php

class DisplayModel extends VouchersModel {

    public function __construct() {
        parent::__construct();
    }

    public function loadDetails($values) {
        extract($values);
        $this->query('SELECT vouchers_details.*, materials.name, measures.abbreviation '
                . 'FROM vouchers_details, materials, measures '
                . 'WHERE vouchers_details.fk_id_voucher=? '
                . 'AND materials.id_material = vouchers_details.fk_id_material '
                . 'AND measures.id_measure = materials.fk_id_measure '
                , array($fk_id_voucher)
        );
        return $this->getFetchAll();
    }

}
