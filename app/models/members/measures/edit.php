<?php

class EditModel extends MeasuresModel {

    public function __construct() {
        parent::__construct();
    }

    public function loadMeasure($values) {
        extract($values);
        $this->query('SELECT * FROM measures '
                . 'WHERE fk_id_establishment=? AND id_measure=? '
                . 'LIMIT 1'
                , array($fk_id_establishment, $id_measure)
        );
        return $this->getFetch();
    }

    public function editMeasure($values) {
        extract($values);
        return $this->query('UPDATE measures '
                        . 'SET abbreviation=?, terminology=? '
                        . 'WHERE id_measure=?'
                        , array($abbreviation, $terminology, $id_measure)
        );
    }

}
