<?php

class IndexModel extends ExpenseAccountsModel {

    public function __construct() {
        parent::__construct();
    }

    public function countRows($wheres, $filters) {
        #extract($values);
        $this->query('SELECT count(*) AS total '
                . 'FROM expense_accounts '
                . 'WHERE fk_id_establishment=? '
                . $filters[0]
                , array_merge($wheres[1], $filters[1])
        );
        return $this->getFetch();
    }

    public function loadExpenseAccounts($wheres, $filters, $limits) {
        #extract($values);
        $this->query('SELECT * '
                . 'FROM expense_accounts '
                . 'WHERE fk_id_establishment=? '
                . $filters[0]
                . 'ORDER BY number ASC '
                . $limits[0]
                , array_merge($wheres[1], $filters[1], $limits[1])
        );
        return $this->getFetchAll();
    }

}
