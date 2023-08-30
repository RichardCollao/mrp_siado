<?php

class CreateModel extends ProvidersModel {

    public function __construct() {
        parent::__construct();
    }

    public function createContact($values) {
        extract($values);
        
        return $this->query('INSERT INTO providers_contacts (fk_id_provider, name, mail, phone) '
                . 'VALUES (?, ?, ?, ?)'
                , array($fk_id_provider, $name, $mail, $phone)
        );
    }

}
