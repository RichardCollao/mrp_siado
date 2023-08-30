<?php

class ExpenseAccountsModel extends MembersModel {

    public function __construct() {
        parent::__construct();
    }

    public function loadExpenseAccount($values) {
        extract($values);
        $this->query('SELECT * '
                . 'FROM expense_accounts '
                . 'WHERE fk_id_establishment=? '
                . 'AND id_expense_account=? '
                . 'LIMIT 1', 
                array($fk_id_establishment, $id_expense_account));
        return $this->getFetch();
    }

    public function existAccountNumber($values) {
        extract($values);
        $this->query(
                'SELECT * '
                . 'FROM expense_accounts '
                . 'WHERE fk_id_establishment=? '
                . 'AND number=? '
                . 'AND id_expense_account<>? '
                . 'LIMIT 1', 
                array($fk_id_establishment, $number, $id_expense_account));
        return $this->getFetch();
    }

    public function existAccountName($values) {
        extract($values);
        $this->query(
                'SELECT * '
                . 'FROM expense_accounts '
                . 'WHERE fk_id_establishment=? '
                . 'AND name=? '
                . 'AND id_expense_account<>? '
                . 'LIMIT 1', 
                array($fk_id_establishment, $name, $id_expense_account));
        return $this->getFetch();
    }

}
