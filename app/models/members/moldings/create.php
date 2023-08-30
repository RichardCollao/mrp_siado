<?php

class CreateModel extends MoldingsModel {

    public function __construct() {
        parent::__construct();
    }

    public function createMoldings($values) {
        extract($values);
        $this->query('INSERT INTO moldings '
                . '(fk_id_establishment, fk_id_provider, fk_id_expense_account, name) '
                . 'VALUES (?, ?, ?, ?)'
                , array($fk_id_establishment, $fk_id_provider, $fk_id_expense_account, $name)
        );
        return $this->getLastInsertId();
    }

}
