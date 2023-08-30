<?php

class EditModel extends UsersModel {

    public function __construct() {
        parent::__construct();
    }

    public function editUser($values) {
        extract($values);
        try {
            return $this->query('UPDATE users '
                            . 'SET name=?, mail=?, state_acount=?, type_user=?, phone=? '
                            . 'WHERE id_user=?'
                            , array($name, $mail, $state_acount, $type_user, $phone, $id_user));
        } catch (Exception $ex) {
            return false;
        }
    }

}
