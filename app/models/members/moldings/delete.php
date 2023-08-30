<?php

class DeleteModel extends MoldingsModel {

    public function __construct() {
        parent::__construct();
    }

    public function Delete($values) {
        extract($values);
        return $this->query('DELETE '
                . 'FROM moldings '
                . 'WHERE id_molding = ?'
                , array($id_molding)
        );
    }

}
