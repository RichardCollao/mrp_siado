<?php

class UnlockModel extends LockedModel {

    public function __construct() {
        parent::__construct();
    }

    public function unlock($values) {
        extract($values);
        return $this->query('UPDATE bills '
                        . 'SET locked=false '
                        . 'WHERE id_bill=?'
                        , array($id_bill)
        );
    }

}
