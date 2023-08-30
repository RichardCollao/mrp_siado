<?php

// AUTHENTICATED_
class SessionModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Busca los datos asosiados a la sesion activa.
     */
    public function loadSessions($session_id, $user_agent, $ip_current, $margin_life) {
        $this->query('SELECT fk_id_user '
                . 'FROM sessions '
                . 'WHERE session_id=? '
                . 'AND user_agent=? '
                . 'AND ip_current=INET_ATON(?) '
                . 'AND last_activity<? '
                . 'LIMIT 1'
                , array($session_id, $user_agent, $ip_current, $margin_life)
        );
        return $this->getFetch();
    }

    /**
     * Carga los dotos del usuario autenticado.
     */
    public function loadUserAuth($id_user) {
        $this->query('SELECT users.*, establishments.name AS name_establishment, establishments.address AS address_establishment '
                . 'FROM users, establishments '
                . 'WHERE users.id_user=? '
                . 'AND establishments.id_establishment = users.fk_id_establishment '
                . 'LIMIT 1'
                , array($id_user)
        );
        return $this->getFetch();
    }

    /**
     * Actualiza el la fecha actual segun haya actividad dentro del tiempo de vida de una sesion.
     */
    public function setLastActivity($date_current, $id_user) {
        $query = $this->query('UPDATE sessions '
                . 'SET last_activity=? '
                . 'WHERE fk_id_user=?'
                , array($date_current, $id_user)
        );
        return $query;
    }

    /**
     * Se actualizan los datos dentro de la tabla sesions.
     */
    public function updateSessions($values) {
        extract($values);
        return $this->query('REPLACE INTO sessions '
                        . 'SET fk_id_user=?, session_id=?, user_agent=?, ip_current=INET_ATON(?), last_activity=?, connection_status=?;'
                        , array($id_user, $session_id, $user_agent, $ip_current, $date_current, $connection_status)
        );
    }

}
