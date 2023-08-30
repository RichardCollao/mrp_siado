<?php

class DeleteModel extends MaterialsModel {

    public function __construct() {
        parent::__construct();
    }

    public function Delete($values) {
        extract($values);
        return $this->query('DELETE '
                . 'FROM materials '
                . 'WHERE id_material = ?'
                , array($id_material)
        );
    }

    public function loadMaterial($values) {
        extract($values);
        $this->query('SELECT * '
                . 'FROM materials '
                . 'WHERE id_material = ?'
                , array($id_material)
        );
        return $this->getFetch();
    }

}
