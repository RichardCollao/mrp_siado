<?php

class DeleteModel extends GuidesModel {

    public function __construct() {
        parent::__construct();
    }

    public function delete($values) {
        extract($values);
        return $this->query('DELETE '
                        . 'FROM guides '
                        . 'WHERE id_guide = ? '
                        , array($id_guide)
        );
    }

}
