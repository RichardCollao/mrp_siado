<?php

class UsersModel extends AdmincpModel {

    public function __construct() {
        parent::__construct();
    }

    public function loadUser($values) {
        extract($values);
        $this->query('SELECT * '
                . 'FROM users '
                . 'WHERE id_user=? '
                . 'LIMIT 1'
                , array($id_user));
        return $this->getFetch();
    }

    public function listEstablishments($values) {
        extract($values);
        $this->query('SELECT * '
                . 'FROM establishments '
                . 'WHERE id_establishment<>1'
                , array());
        return $this->getFetchAll();
    }

    public function duplicateName($values) {
        extract($values);
        $this->query('SELECT * '
                . 'FROM users '
                . 'WHERE name=? '
                . 'AND id_user<>? '
                . 'AND fk_id_establishment=? '
                . 'LIMIT 1'
                , array($name, $id_user, $fk_id_establishment)
        );
        return $this->getFetch();
    }

    public function duplicateMail($values) {
        extract($values);
        $this->query('SELECT * '
                . 'FROM users '
                . 'WHERE mail=? '
                . 'AND id_user<>? '
                . 'AND fk_id_establishment=? '
                . 'LIMIT 1'
                , array($mail, $id_user, $fk_id_establishment)
        );
        return $this->getFetch();
    }

}
