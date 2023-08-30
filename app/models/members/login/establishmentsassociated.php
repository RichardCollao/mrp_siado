<?php

class EstablishmentsAssociatedModel extends MembersModel {

    public function __construct() {
        parent::__construct();
    }

    //        Rutina en desarrollo para usuarios que tienen el mismo mail para mas de una cuenta
    /**
     * Devuelve un lista de las obras en la que el usuario es miembro 
     */
    public function getEstablishments($values) {
        extract($values);
        $this->query('SELECT establishments.id_establishment, establishments.name AS establishments_name 
                        FROM users, establishments 
                        WHERE users.fk_id_establishment = establishments.id_establishment 
                        AND users.mail=? 

                        AND users.state_acount=?', 
                array($mail, $state_acount));
        return $this->getFetchAll();
    }


}
