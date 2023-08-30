<?php

class EditModel extends GuidesModel {

    public function __construct() {
        parent::__construct();
    }

    public function editGuide($values) {
        extract($values);
        return $this->query('UPDATE moldings_guides '
                        . 'SET number=?, type=?, issue_date=?, observation=? '
                        . 'WHERE id_molding_guide=?'
                        , array($number, $type, $issue_date, $observation, $id_molding_guide)
        );
    }

}
