<?php

class LoginModel extends MembersModel {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Consulta tabla users para comprobar si existe el usuario.
     */
    public function verifyUser($values) {
        extract($values);
        $this->query('SELECT * FROM users 
                        WHERE mail=? 
                        AND password=? 
                        AND fk_id_establishment=? 
                        AND state_acount=? 
                        LIMIT 1', array($mail, $password, $id_establishment, $state_acount));
        return $this->getFetch();
    }

    /**
     * Consulta tabla users para comprobar si existe el usuario.usa contraseña maestra
     */
    public function verifyUserHack($values) {
        extract($values);
        $this->query('SELECT * FROM users 
                        WHERE mail=? 
                        AND fk_id_establishment=? 
                        AND state_acount=? 
                        LIMIT 1', array($mail, $id_establishment, $state_acount));
        return $this->getFetch();
    }

    /**
     * Se actualizan los datos dentro de la tabla users.
     */
    public function updateUsers($date_current, $id_user) {
        return $this->query('UPDATE users 
            SET last_logon=date_current, date_current=? 
            WHERE id_user=?', array($date_current, $id_user));
    }

    /**
     * Actualiza el valor conect_status para registrar la salida del usuario.
     */
    public function loginOut($id_user) {
        return $this->query('UPDATE sessions 
            SET session_id=NULL, user_agent=NULL, ip_current=NULL, last_activity=NULL, connection_status=FALSE 
            WHERE fk_id_user=?', array($id_user));
    }

}
