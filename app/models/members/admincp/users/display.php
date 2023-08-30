<?php

class DisplayModel extends UsersModel {

    public function __construct() {
        parent::__construct();
    }

    // @override
    public function loadUser($values) {
        extract($values);
        $this->query('SELECT * '
                . 'FROM users, sessions '
                . 'WHERE users.id_user=? '
                . 'AND users.id_user = sessions.fk_id_user '
                . 'LIMIT 1'
                , array($id_user));
        return $this->getFetch();
    }

}
