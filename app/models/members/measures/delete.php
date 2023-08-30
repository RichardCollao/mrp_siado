<?php

class DeleteModel extends MeasuresModel {

    public function __construct() {
        parent::__construct();
    }

    public function Delete($values) {
        extract($values);
        return $this->query('DELETE '
                . 'FROM measures '
                . 'WHERE id_measure = ?'
                , array($id_measure)
        );
    }

    public function loadMeasure($values) {
        extract($values);
        $this->query('SELECT * '
                . 'FROM measures '
                . 'WHERE id_measure = ?'
                , array($id_measure)
        );
        return $this->getFetch();
    }

}
