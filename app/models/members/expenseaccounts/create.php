<?php

class CreateModel extends ExpenseAccountsModel {

    public function __construct() {
        parent::__construct();
    }

    public function createExpenseAccount($values) {
        extract($values);
        $this->query('INSERT INTO expense_accounts (fk_id_establishment, number, name) '
                . 'VALUES (?, ?, ?)'
                , array($fk_id_establishment, $number, $name));
        return $this->getLastInsertId();
    }

}
