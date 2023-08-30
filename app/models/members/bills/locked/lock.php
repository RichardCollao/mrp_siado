<?php

class LockModel extends LockedModel {

    public function __construct() {
        parent::__construct();
    }

    public function lock($values) {
        extract($values);
        return $this->query('UPDATE bills '
                        . 'SET locked=true '
                        . 'WHERE id_bill=?'
                        , array($id_bill)
        );
    }

}
