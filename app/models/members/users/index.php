<?php

class IndexModel extends UsersModel {

    public function __construct() {
        parent::__construct();
    }

    public function countRows($wheres, $filters) {
//        extract($values);
        $this->query('SELECT count(*) AS total '
                . 'FROM users '
                . 'WHERE fk_id_establishment=? '
                . 'AND type_user<>"super_admin" '
                . $filters[0]
                , array_merge($wheres[1], $filters[1])
        );
        return $this->getFetch();
    }

    public function loadUsers($wheres, $filters, $limits) {
//        extract($values);
        $this->query('SELECT users.*, establishments.name AS establishment '
                . 'FROM users, establishments '
                . 'WHERE users.fk_id_establishment=? '
                . 'AND users.fk_id_establishment=establishments.id_establishment '
                . 'AND users.type_user<>"super_admin" '
                . $filters[0]
                . 'ORDER BY users.name ASC '
                . $limits[0]
                , array_merge($wheres[1], $filters[1], $limits[1])
        );
        return $this->getFetchAll();
    }

}
