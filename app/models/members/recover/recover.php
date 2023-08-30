<?php

class RecoverModel extends MembersModel {

    public function __construct() {
        parent::__construct();
    }

    public function getUserByMail($mail) {
        $this->query('SELECT * '
                . 'FROM users '
                . 'WHERE mail=? '
                . 'LIMIT 1'
                , array($mail));
        return $this->getFetch();
    }

    public function saveHash($fk_id_user, $operation, $hash, $date_creation) {
        return $this->query('REPLACE INTO hash_security '
                        . 'SET fk_id_user=?, operation=?, hash=?, date_creation=?'
                        , array($fk_id_user, $operation, $hash, $date_creation));
    }

    public function loadHash($fk_id_user) {
        $this->query('SELECT * '
                . 'FROM hash_security '
                . 'WHERE fk_id_user=?'
                , array($fk_id_user));
        return $this->getFetch();
    }

    public function deletehash($fk_id_user) {
        return $this->query('DELETE '
                        . 'FROM hash_security '
                        . 'WHERE fk_id_user=?'
                        , array($fk_id_user));
    }

    public function changePass($pass, $id_user) {
        return $this->query('UPDATE users '
                        . 'SET password=? '
                        . 'WHERE id_user=?'
                        , array($pass, $id_user));
    }

    public function getUserById($id) {
        $this->query('SELECT * '
                . 'FROM users '
                . 'WHERE id_user=? LIMIT 1'
                , array($id));
        return $this->getFetch();
    }

}
