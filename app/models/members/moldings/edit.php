<?php

class EditModel extends MoldingsModel {

    public function __construct() {
        parent::__construct();
    }

    public function loadMolding($values) {
        extract($values);
        $this->query('SELECT moldings.*, expense_accounts.name AS ea_name, providers.name AS provider_name '
                . 'FROM moldings, expense_accounts, providers '
                . 'WHERE moldings.fk_id_establishment=? '
                . 'AND moldings.id_molding=? '
                . 'AND expense_accounts.id_expense_account =  moldings.fk_id_expense_account '
                . 'AND providers.id_provider = moldings.fk_id_provider '
                , array($fk_id_establishment, $id_molding)
        );
        return $this->getFetch();
    }

    public function editMolding($values) {
        extract($values);
        return $this->query('UPDATE moldings '
                        . 'SET fk_id_provider=?, fk_id_expense_account=?, name=? '
                        . 'WHERE fk_id_establishment=? '
                        . 'AND id_molding=?'
                        , array($fk_id_provider, $fk_id_expense_account, $name, 
                            $fk_id_establishment, $id_molding)
        );
    }

}
