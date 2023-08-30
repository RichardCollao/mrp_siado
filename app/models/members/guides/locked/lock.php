<?php

class LockModel extends LockedModel {

    public function __construct() {
        parent::__construct();
    }

    public function lock($values) {
        extract($values);
        return $this->query('UPDATE guides '
                        . 'SET locked=true '
                        . 'WHERE id_guide=?'
                        , array($id_guide)
        );
    }

}
