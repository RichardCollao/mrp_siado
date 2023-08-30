<?php

class IndexModel extends PurchaseOrdersModel {

    public function __construct() {
        parent::__construct();
    }

    public function countRows($wheres, $filters) {
        #extract($values);
        $this->query('SELECT count(*) AS total '
                . 'FROM purchase_orders '
                . 'INNER JOIN providers on purchase_orders.fk_id_provider = providers.id_provider '
                . 'WHERE purchase_orders.fk_id_establishment=? '
                . $filters[0]
                , array_merge($wheres[1], $filters[1])
        );
        return $this->getFetch();
    }

    public function loadPurchaseOrders($wheres, $filters, $limits) {
        #extract($values);
        $this->query($this->view_purchase_orders()
                . ' WHERE purchase_orders.fk_id_establishment=? '
                . $filters[0]
                . ' ORDER BY purchase_orders.created_at DESC '
                . $limits[0]
                , array_merge($wheres[1], $filters[1], $limits[1])
        );
        return $this->getFetchAll();
    }

    public function listProvidersUseds($values) {
        extract($values);
        $this->query('
                SELECT DISTINCT providers.id_provider, providers.name, providers.rut  
                FROM providers 
                INNER JOIN purchase_orders on purchase_orders.fk_id_provider = providers.id_provider 
                WHERE purchase_orders.fk_id_establishment=? 
                ORDER BY name'
                , array($fk_id_establishment)
        );
        return $this->getFetchAll();
    }

}
