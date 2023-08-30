<?php

class IndexModel extends EstablishmentsModel {

    public function __construct() {
        parent::__construct();
    }

    public function loadEstablishment($values) {
        extract($values);
        $this->query('SELECT * '
                . 'FROM establishments '
                . 'WHERE id_establishment=? '
                . 'ORDER BY name ASC'
                , array($id_establishment));
        return $this->getFetch();
    }

}
