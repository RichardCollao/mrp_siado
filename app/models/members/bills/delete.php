<?php

class DeleteModel extends BillsModel {

    public function __construct() {
        parent::__construct();
    }

    public function delete($values) {
        extract($values);
        return $this->query('DELETE '
                        . 'FROM bills '
                        . 'WHERE id_bill = ? '
                        , array($id_bill)
        );
    }

}
