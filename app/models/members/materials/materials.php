<?php

class MaterialsModel extends MembersModel {

    public function __construct() {
        parent::__construct();
    }

    public function listMaterials($values) {
        extract($values);
        $this->query('SELECT DISTINCT name '
                . 'FROM materials '
                . 'WHERE fk_id_establishment=? '
                . 'ORDER BY name ASC'
                , array($fk_id_establishment)
        );
        return $this->getFetchAll();
    }
    
    public function listMeasures($values) {
        extract($values);
        $this->query('SELECT * '
                . 'FROM measures '
                . 'WHERE fk_id_establishment=?'
                , array($fk_id_establishment)
        );
        return $this->getFetchAll();
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

}
