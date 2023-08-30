<?php

class EstablishmentsModel extends MembersModel {

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

    public function loadEstablishment($id_establishment) {
        $this->query('SELECT * FROM establishments WHERE id_establishment=?'
                , array($id_establishment)
        );
        return $this->getFetch();
    }

}
