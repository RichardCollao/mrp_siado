<?php

class CreateModel extends GuidesModel {

    public function __construct() {
        parent::__construct();
    }

    public function createGuide($values) {
        extract($values);
        $this->query('INSERT INTO moldings_guides '
                . '(fk_id_molding, number, type, issue_date, created_at, observation) '
                . 'VALUES (?, ?, ?, ?, ?, ?)'
                , array($fk_id_molding, $number, $type, $issue_date, $created_at, $observation)
        );
        return $this->getLastInsertId();
    }

}
