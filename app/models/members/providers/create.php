<?php

class CreateModel extends ProvidersModel {

    public function __construct() {
        parent::__construct();
    }

    public function createProvider($values) {
        extract($values);
        $this->query('INSERT INTO providers (fk_id_establishment, name, activity, rut, mail, address, phone) '
                . 'VALUES (?, ?, ?, ?, ?, ?, ?)'
                , array($fk_id_establishment, $name, $activity, $rut, $mail, $address, $phone)
        );
        return $this->getLastInsertId();
    }

}
