<?php

class AjaxUXModel extends MembersModel {

    public function __construct() {
        parent::__construct();
    }

    public function loadDestination($values) {
        extract($values);
        $this->query('SELECT DISTINCT destination '
                . 'FROM vouchers '
                . 'WHERE fk_id_establishment=? '
                . 'AND destination LIKE ? '
                . 'LIMIT 15'
                , array($fk_id_establishment, '%' . $str . '%')
        );
        return $this->getFetchAll();
    }

    public function loadRequesting($values) {
        extract($values);
        $this->query('SELECT DISTINCT user_name_requesting '
                . 'FROM vouchers '
                . 'WHERE fk_id_establishment=? '
                . 'AND user_name_requesting LIKE ? '
                . 'LIMIT 15'
                , array($fk_id_establishment, '%' . $str . '%')
        );
        return $this->getFetchAll();
    }

}
