<?php

class ModifyModel extends EstablishmentsModel {

    public function __construct() {
        parent::__construct();
    }

    public function modifyEstablishment($values) {
        extract($values);
        return $this->query('UPDATE establishments '
                        . 'SET name_business=?, activity_business=?, rut_business=?, address_business=?, phone_business=?, '
                        . 'name=?, address=?, phone=? '
                        . 'WHERE id_establishment=?'
                        , array($name_business, $activity_business, $rut_business, $address_business, $phone_business
                    , $name, $address, $phone, $id_establishment)
        );
    }

}
