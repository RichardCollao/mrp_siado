<?php

class EstablishmentsModel extends AdmincpModel {

    public function __construct() {
        parent::__construct();
    }

    public function duplicateName($values) {
        extract($values);
        $this->query('SELECT * '
                . 'FROM establishments ' .
                'WHERE name=? '
                . 'AND id_establishment<>? '
                , array($name, $id_establishment)
        );
        return $this->getFetch();
    }
}
