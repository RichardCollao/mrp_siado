<?php

class UnlockModel extends LockedModel {

    public function __construct() {
        parent::__construct();
    }

    public function unlock($values) {
        extract($values);
        return $this->query('UPDATE guides '
                        . 'SET locked=false '
                        . 'WHERE id_guide=?'
                        , array($id_guide)
        );
    }

}
