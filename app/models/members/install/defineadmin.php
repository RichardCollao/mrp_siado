<?php

class DefineAdminModel extends InstallModel {

    public function __construct() {
        parent::__construct();
    }

    public function defineAdmin($values) {
        extract($values);
        $this->query('INSERT INTO users (fk_id_establishment, name, mail, password, state_acount, type_user, date_reg) '
                . 'VALUES (?, ?, ?, ?, ?, ?, ?)'
                , array($fk_id_establishment, $name, $mail, $password, $state_acount, $type_user, $date_reg));
        return $this->getLastInsertId();
    }

}
