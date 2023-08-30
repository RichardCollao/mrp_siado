<?php

class MoldingsModel extends MembersModel {

    public function __construct() {
        parent::__construct();
    }

    public function listExpenseAccounts($values) {
        extract($values);
        $this->query('SELECT * '
                . 'FROM expense_accounts '
                . 'WHERE fk_id_establishment=?'
                , array($fk_id_establishment)
        );
        return $this->getFetchAll();
    }

    public function listProviders($values) {
        extract($values);
        $this->query('SELECT * '
                . 'FROM providers '
                . 'WHERE fk_id_establishment=? '
                . 'ORDER BY name ASC'
                , array($fk_id_establishment)
        );
        return $this->getFetchAll();
    }

    public function loadMolding($values) {
        extract($values);
        $this->query(
                'SELECT moldings.*, '
                . 'providers.name AS providers_name, '
                . 'expense_accounts.name AS ea_name, '
                . 'expense_accounts.number AS ea_number '
                . 'FROM moldings '
                . 'INNER JOIN providers ON providers.id_provider = moldings.fk_id_provider '
                . 'INNER JOIN expense_accounts ON expense_accounts.id_expense_account = moldings.fk_id_expense_account '
                . 'WHERE moldings.fk_id_establishment=? '
                . 'AND moldings.id_molding=?'
                , array($fk_id_establishment, $id_molding)
        );
        return $this->getFetch();
    }

}
