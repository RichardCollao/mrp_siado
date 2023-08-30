<?php

class DeleteModel extends DetailsModel {

    public function __construct() {
        parent::__construct();
    }

    public function DeleteItem($values) {
        extract($values);
        return $this->query('DELETE FROM bills_details '
                        . 'WHERE id_bill_detail = ?'
                        , array($id_bill_detail)
        );
    }

}
