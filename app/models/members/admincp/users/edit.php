<?php

class EditModel extends UsersModel {

    public function __construct() {
        parent::__construct();
    }

    public function editUser($values) {
        extract($values);
        return $this->query('UPDATE users '
                        . 'SET name=?, mail=?, state_acount=?, password=?, phone=?, fk_id_establishment=? '
                        . 'WHERE id_user=?'
                        , array($name, $mail, $state_acount, $password, $phone, $fk_id_establishment, $id_user));
    }

}
