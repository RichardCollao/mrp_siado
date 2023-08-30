<?php

class IndexModel extends ProvidersModel {

    public function __construct() {
        parent::__construct();
    }

   
    public function loadContacts($values) {
        extract($values);
        $this->query('SELECT * '
                . 'FROM providers_contacts '
                . 'WHERE fk_id_provider=? '
                . 'ORDER BY name ASC '
                , array($fk_id_provider)
        );
        return $this->getFetchAll();
    }

}
