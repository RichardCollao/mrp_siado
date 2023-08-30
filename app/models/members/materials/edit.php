<?php

class EditModel extends MaterialsModel {

    public function __construct() {
        parent::__construct();
    }

    public function loadMaterial($values) {
        extract($values);
        $this->query('SELECT materials.*, expense_accounts.name AS account_name, measures.abbreviation '
                . 'FROM materials, expense_accounts, measures '
                . 'WHERE materials.fk_id_establishment=? '
                . 'AND materials.id_material=? '
                . 'AND expense_accounts.id_expense_account =  materials.fk_id_expense_account '
                . 'AND measures.id_measure = materials.fk_id_measure '
                , array($fk_id_establishment, $id_material)
        );
        return $this->getFetch();
    }

    public function editMaterial($values) {
        extract($values);
        return $this->query('UPDATE materials '
                        . 'SET fk_id_measure=?, fk_id_expense_account=?, name=?, critical_stock=? '
                        . 'WHERE fk_id_establishment=? '
                        . 'AND id_material=?'
                        , array($fk_id_measure, $fk_id_expense_account, $name, $critical_stock, $fk_id_establishment, $id_material)
        );
    }

}
