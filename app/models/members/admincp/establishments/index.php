<?php

class IndexModel extends EstablishmentsModel {

    public function __construct() {
        parent::__construct();
    }

    public function loadEstablishments($paginate = '', $values = array()) {
        $this->query('SELECT * '
                . 'FROM establishments WHERE id_establishment<>1 ' . $paginate, $values);
        return $this->getFetchAll();
    }

    public function countFilteredItems($where = '', $values = array()) {
        $this->query('SELECT COUNT(*) AS count '
                . 'FROM establishments WHERE id_establishment<>1 ' . $where, $values);
        $cons = $this->getFetchAll();
        return (int) $cons[0]['count'];
    }

}
