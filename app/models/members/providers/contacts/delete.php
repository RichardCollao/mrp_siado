<?php

class DeleteModel extends ProvidersModel {

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

    public function delete($values) {
        extract($values);
        return $this->query('DELETE '
                        . 'FROM providers_contacts '
                        . 'WHERE id_provider_contact = ?'
                        , array($id_provider_contact)
        );
    }

}
