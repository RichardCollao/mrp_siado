<?php

class EditModel extends ProvidersModel {

    public function __construct() {
        parent::__construct();
    }

    public function loadProvider($values) {
        extract($values);
        $this->query('SELECT * FROM providers '
                . 'WHERE fk_id_establishment=? AND id_provider=? '
                . 'LIMIT 1', array($fk_id_establishment, $id_provider)
        );
        return $this->getFetch();
    }

    public function editProvider($values) {
        extract($values);
        return $this->query('UPDATE providers '
                        . 'SET name=?, activity=?, rut=?, mail=?, address=?, phone=? '
                        . 'WHERE fk_id_establishment=? AND id_provider=?'
                        , array($name, $activity, $rut, $mail, $address, $phone, $fk_id_establishment, $id_provider)
        );
    }

}
