<?php

class MeasuresModel extends MembersModel {

    public function __construct() {
        parent::__construct();
    }

    public function duplicateAbbreviation($values) {
        extract($values);
        $this->query('SELECT * FROM measures '
                . 'WHERE fk_id_establishment=? '
                . 'AND BINARY abbreviation=? AND id_measure<>? '
                , array($fk_id_establishment, $abbreviation, $id_measure)
        );
        return $this->getFetch();
    }

    public function duplicateTerminology($values) {
        extract($values);
        $this->query('SELECT * FROM measures '
                . 'WHERE fk_id_establishment=? '
                . 'AND terminology=? AND id_measure<>? '
                , array($fk_id_establishment, $terminology, $id_measure)
        );
        return $this->getFetch();
    }

}
