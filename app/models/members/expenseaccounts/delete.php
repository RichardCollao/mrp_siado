<?php

class DeleteModel extends ExpenseAccountsModel {

    public function __construct() {
        parent::__construct();
    }

    public function Delete($values) {
        extract($values);
        return $this->query('DELETE '
                . 'FROM expense_accounts '
                . 'WHERE id_expense_account = ?'
                , array($id_expense_account)
        );
    }

    public function loadExpenseAccount($values) {
        extract($values);
        $this->query('SELECT * '
                . 'FROM expense_accounts '
                . 'WHERE id_expense_account = ? '
                , array($id_expense_account)
        );
        return $this->getFetch();
    }

}
