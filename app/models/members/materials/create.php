<?php

class CreateModel extends MaterialsModel {

    public function __construct() {
        parent::__construct();
    }

    public function createMaterial($values) {
        extract($values);
        $this->query('INSERT INTO materials '
                . '(fk_id_establishment, fk_id_measure, fk_id_expense_account, name, critical_stock) '
                . 'VALUES (?, ?, ?, ?, ?)'
                , array($fk_id_establishment, $fk_id_measure, $fk_id_expense_account, $name, $critical_stock)
        );
        return $this->getLastInsertId();
    }

}
