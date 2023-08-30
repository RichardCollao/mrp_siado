<?php

class CreateModel extends UsersModel {

    public function __construct() {
        parent::__construct();
    }

    public function createUser($values) {
        extract($values);
        $this->_dbh->beginTransaction();
        try {
            $this->query('INSERT INTO users (fk_id_establishment, name, mail, password, phone, state_acount, type_user, date_reg) '
                    . 'VALUES (?, ?, ?, ?, ?, ?, ?, ?)'
                    , array($fk_id_establishment, $name, $mail, $password, $phone, $state_acount, $type_user, $date_reg)
            );

            $last_insert_id = $this->getLastInsertId();
            // Nota: Ver si es mejor opcion usar REPLACE INTO
            $this->query('REPLACE INTO users_permissions (fk_id_user, permissions) 
                            VALUES (?,?)'

                    , array($last_insert_id, $permissions));

            $this->_dbh->commit();
            return $last_insert_id;
        } catch (Exception $e) {
            echo $e->getMessage();
            $this->_dbh->rollBack();
        }
    }

}
