<?php

class RegisterModel extends MembersModel {

    public function __construct() {
        parent::__construct();
    }

    public function createNewAcount($values) {
        extract($values);
        // Desctiva el modo "autocommit".
        $this->_dbh->beginTransaction();
        $this->query('INSERT INTO users (name, mail, password, state_acount, type_user, birthdate, 
                        residence_city, residence_country, date_reg) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)'
                , array($name, $mail, $password, $state_acount, $type_user, $birthdate,
            $residence_city, $residence_country, $date_reg)
        );

        $id_user = $this->getLastInsertId();

        // Crea el registro SESSIONS con el mismo id de usuario.
        $this->query('INSERT INTO sessions (fk_id_user) VALUES (?)', array($id_user));

        // Consigna la transacción
        if ($this->_dbh->commit() === TRUE) {
            return $id_user;
        }
        return FALSE;
    }

    public function loadUser($id_user) {
        $this->query('SELECT * FROM users WHERE id_user=? LIMIT 1', array($id_user));
        return $this->getFetch();
    }

    public function logMail($from_mail, $from_name, $address, $subject, $body, $date_send, $status) {
        $this->query('INSERT INTO messages (from_mail, from_name, address, subject, body, date_send, status) '
                . 'VALUES (?,?,?,?,?,?,?)', array($from_mail, $from_name, $address, $subject, $body, $date_send, $status));
    }

}
