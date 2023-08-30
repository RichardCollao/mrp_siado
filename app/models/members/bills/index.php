<?php

class IndexModel extends BillsModel {

    public function __construct() {
        parent::__construct();
    }

    public function countRows($wheres, $filters) {
        #extract($values);
        $this->query('SELECT count(*) AS total '
                . 'FROM bills '
                . 'INNER JOIN purchase_orders on purchase_orders.id_purchase_order = bills.fk_id_purchase_order '
                . 'INNER JOIN providers on providers.id_provider = purchase_orders.fk_id_provider '
                . 'WHERE purchase_orders.fk_id_establishment=? '
                . $filters[0]
                , array_merge($wheres[1], $filters[1])
        );
        return $this->getFetch();
    }

    public function loadBills($wheres, $filters, $limits) {
        #extract($values);
        $this->query($this->view_bills()
                . 'WHERE purchase_orders.fk_id_establishment=? '
                . $filters[0]
                . ' ORDER BY bills.created_at DESC '
                . $limits[0]
                , array_merge($wheres[1], $filters[1], $limits[1])
        );
        return $this->getFetchAll();
    }

}
