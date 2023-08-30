<?php

class IndexModel extends MoldingsModel {

    public function __construct() {
        parent::__construct();
    }

    public function countRows($wheres, $filters) {
        #extract($values);
        $this->query('SELECT count(*) AS total '
                . 'FROM moldings '
                . 'INNER JOIN providers ON providers.id_provider = moldings.fk_id_provider '
                . 'INNER JOIN expense_accounts ON expense_accounts.id_expense_account = moldings.fk_id_expense_account '
                . 'WHERE moldings.fk_id_establishment=? '
                . $filters[0]
                , array_merge($wheres[1], $filters[1])
        );
        return $this->getFetch();
    }

    public function loadMoldings($wheres, $filters, $limits) {
        #extract($values);
        $this->query(
                'SELECT moldings.*, '
                . 'providers.name AS providers_name, '
                . 'expense_accounts.name AS ea_name, '
                . 'expense_accounts.number AS ea_number '
                . 'FROM moldings '
                . 'INNER JOIN providers ON providers.id_provider = moldings.fk_id_provider '
                . 'INNER JOIN expense_accounts ON expense_accounts.id_expense_account = moldings.fk_id_expense_account '
                . 'WHERE moldings.fk_id_establishment=? '
                . $filters[0]
                . 'ORDER BY moldings.name ASC '
                . $limits[0]
                , array_merge($wheres[1], $filters[1], $limits[1])
        );
        return $this->getFetchAll();
    }

}
