<?php

class DetailsModel extends VouchersModel {

    public function __construct() {
        parent::__construct();
    }

    public function loadDetail($values) {
        extract($values);
        $this->query('SELECT vouchers.fk_id_establishment, vouchers_details.*, materials.name, measures.abbreviation '
                . 'FROM vouchers, vouchers_details, materials, measures '
                . 'WHERE vouchers_details.id_voucher_detail=? '
                . 'AND vouchers.id_voucher=vouchers_details.fk_id_voucher '
                . 'AND materials.id_material = vouchers_details.fk_id_material '
                . 'AND measures.id_measure = materials.fk_id_measure '
                . 'LIMIT 1'
                , array($id_voucher_detail)
        );
        return $this->getFetch();
    }
}
