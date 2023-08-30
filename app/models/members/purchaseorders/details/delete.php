<?php

class DeleteModel extends DetailsModel {

    public function __construct() {
        parent::__construct();
    }

    public function DeleteItem($values) {
        extract($values);
        return $this->query('DELETE FROM purchase_orders_details '
                . 'WHERE id_purchase_order_detail = ?'
                , array($id_purchase_order_detail)
        );
    }

}
