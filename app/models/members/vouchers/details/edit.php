<?php

class EditModel extends DetailsModel {

    public function __construct() {
        parent::__construct();
    }

    public function editItem($values) {
        extract($values);
        return $this->query('UPDATE vouchers_details '
                . 'SET fk_id_material=?, quantity=? '
                . 'WHERE id_voucher_detail=?'
                , array($fk_id_material, $quantity, $id_voucher_detail)
        );
    }

    public function loadDetails($values) {
        extract($values);
        $this->query('SELECT vouchers_details.*, materials.name, measures.abbreviation '
                . 'FROM vouchers_details, materials, measures '
                . 'WHERE vouchers_details.fk_id_voucher=? '
                . 'AND vouchers_details.id_voucher_detail<>? '
                . 'AND materials.id_material = vouchers_details.fk_id_material '
                . 'AND measures.id_measure = materials.fk_id_measure '
                , array($fk_id_voucher, $id_voucher_detail)
        );
        return $this->getFetchAll();
    }

}
