<?php

class EditModel extends EstablishmentsModel {

    public function __construct() {
        parent::__construct();
    }

    public function loadEstablishment($id_establishment) {
        $this->query('SELECT * FROM establishments WHERE id_establishment=?'
                , array($id_establishment)
        );
        return $this->getFetch();
    }

    public function editEstablishment($values) {
        extract($values);
        return $this->query('UPDATE establishments '
                        . 'SET name_business=?, rut_business=?, address_business=?, phone_business=?, '
                        . 'name=?, address=?, phone=? '
                        . 'WHERE id_establishment=?'
                        , array($name_business, $rut_business, $address_business, $phone_business
                    , $name, $address, $phone, $id_establishment)
        );
    }

}
