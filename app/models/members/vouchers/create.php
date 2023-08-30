<?php

class CreateModel extends VouchersModel {

    public function __construct() {
        parent::__construct();
    }

    public function createVoucher($values) {
        extract($values);
        $this->query('INSERT INTO vouchers ('
                . 'fk_id_establishment, fk_id_user_typist, fk_id_user_autorized, user_name_requesting, '
                . 'number, issue_date, created_at, destination, observation) '
                . 'VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)'
                , array($fk_id_establishment, $fk_id_user_typist, $fk_id_user_autorized, $user_name_requesting
            , $number, $issue_date, $created_at, $destination, $observation)
        );
        return $this->getLastInsertId();
    }

}
