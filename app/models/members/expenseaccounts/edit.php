<?php

class EditModel extends ExpenseAccountsModel {

    public function __construct() {
        parent::__construct();
    }

    public function editExpenseAccount($values) {
        extract($values);
        return $this->query('UPDATE expense_accounts '
                        . 'SET number=?, name=? '
                        . 'WHERE fk_id_establishment=? '
                        . 'AND id_expense_account=?'
                        , array($number, $name, $fk_id_establishment, $id_expense_account));
    }

}
