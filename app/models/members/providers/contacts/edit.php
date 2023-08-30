<?php

class EditModel extends ProvidersModel {

    public function __construct() {
        parent::__construct();
    }

    public function loadProviderContact($values) {
        extract($values);
        $this->query('SELECT * '
                . 'FROM providers_contacts '
                . 'WHERE id_provider_contact=? '
                , array($id_provider_contact)
        );
        return $this->getFetch();
    }

    public function editContact($values) {
        extract($values);

        return $this->query('UPDATE providers_contacts '
                        . 'SET name=?, mail=?, phone=? '
                        . 'WHERE id_provider_contact=?'
                        , array($name, $mail, $phone, $id_provider_contact)
        );
    }

}
