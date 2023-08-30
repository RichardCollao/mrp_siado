<?php

class PermissionsModel extends UsersModel {

    public function __construct() {
        parent::__construct();
    }

    public function loadUserPermission($values) {
        extract($values);
        $this->query('SELECT * '
                . 'FROM users_permissions '
                . 'WHERE fk_id_user = ?'
                , array($fk_id_user)
        );
        return $this->getFetch();
    }


    public function editUserPermission($values) {
        extract($values);
        return $this->query('REPLACE INTO users_permissions (fk_id_user, permissions) 
                            VALUES (?,?)'
                        , array($fk_id_user, $permissions)
        );
    }

}
