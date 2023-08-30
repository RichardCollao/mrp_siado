<?php

class IndexModel extends DetailsModel {

    public function __construct() {
        parent::__construct();
    }

    public function addItem($values) {
        extract($values);
        $this->query('INSERT INTO vouchers_details '
                . '(fk_id_voucher, fk_id_material, quantity) '
                . 'VALUES (?, ?, ?)'
                , array($fk_id_voucher, $fk_id_material, $quantity)
        );
        return $this->getLastInsertId();
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
