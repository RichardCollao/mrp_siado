<?php

class ProvidersModel extends MembersModel {

    public function __construct() {
        parent::__construct();
    }

    public function loadProvider($values) {
        extract($values);
        $this->query('SELECT * '
                . 'FROM providers '
                . 'WHERE id_provider=? '
                , array($id_provider)
        );
        return $this->getFetch();
    }

    public function duplicateName($values) {
        extract($values);
        $this->query('SELECT * FROM providers ' .
                'WHERE fk_id_establishment=? AND name=? AND id_provider<>? '
                , array($fk_id_establishment, $name, $id_provider)
        );
        return $this->getFetch();
    }

    public function duplicateRut($values) {
        extract($values);
        $this->query('SELECT * FROM providers '
                . 'WHERE fk_id_establishment=? AND rut=? AND id_provider<>? '
                , array($fk_id_establishment, $rut, $id_provider)
        );
        return $this->getFetch();
    }

}
