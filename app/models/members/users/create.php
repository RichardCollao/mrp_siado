<?php

class CreateModel extends UsersModel {

    public function __construct() {
        parent::__construct();
    }

    public function createUser($values) {
        extract($values);
        try {
            return $this->query('INSERT INTO users (fk_id_establishment, name, mail, password, '
                            . 'phone, state_acount, type_user, date_reg) '
                            . 'VALUES (?, ?, ?, ?, ?, ?, ?, ?)'
                            , array($fk_id_establishment, $name, $mail, $password, $phone, $state_acount, $type_user, $date_reg)
            );
        } catch (Exception $ex) {
            return false;
        }
    }

}
