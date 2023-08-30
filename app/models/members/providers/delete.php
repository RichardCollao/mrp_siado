<?php

class DeleteModel extends ProvidersModel {

    public function __construct() {
        parent::__construct();
    }

    public function Delete($values) {
        extract($values);
        return $this->query('DELETE '
                . 'FROM providers '
                . 'WHERE id_provider = ?'
                , array($id_provider)
        );
    }

    public function loadProvider($values) {
        extract($values);
        $this->query('SELECT * '
                . 'FROM providers '
                . 'WHERE id_provider = ? '
                , array($id_provider)
        );
        return $this->getFetch();
    }

}
