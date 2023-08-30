<?php

class CreateModel extends MeasuresModel {

    public function __construct() {
        parent::__construct();
    }

    public function createMeasure($values) {
        extract($values);
        $this->query('INSERT INTO measures (fk_id_establishment, abbreviation, terminology) '
                . 'VALUES (?, ?, ?)'
                , array($fk_id_establishment, $abbreviation, $terminology)
        );
        return $this->getLastInsertId();
    }

}
