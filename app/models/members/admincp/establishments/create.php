<?php

class CreateModel extends EstablishmentsModel {

    public function __construct() {
        parent::__construct();
    }

    public function createEstablishment($values) {
        extract($values);
        try {
            $this->_dbh->beginTransaction();
            $this->query('INSERT INTO establishments (name_business, rut_business, '
                    . 'address_business, phone_business, name, address, phone) '
                    . 'VALUES (?, ?, ?, ?, ?, ?, ?)'
                    , array($name_business, $rut_business, $address_business, $phone_business, 
                        $name, $address, $phone)
            );
            $id_establishment = $this->getLastInsertId();

            // Inserta las medidas por defecto
            foreach ($values['defaults_measures'] as $key => $value) {
                $this->query('INSERT INTO measures (fk_id_establishment, abbreviation, terminology) '
                        . 'VALUES (?, ?, ?)'
                        , array($id_establishment, $key, $value)
                );
            }            
            
            $this->_dbh->commit();
            return $id_establishment;
        } catch (Exception $e) {
            $this->_dbh->rollBack();
        }
    }

}
