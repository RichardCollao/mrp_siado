<?php

class PurchaseOrdersModel extends ReportsModel {

    public function __construct() {
        parent::__construct();
    }

    public function reports($values) {
        extract($values);
        $this->query('SELECT purchase_orders_details.*, purchase_orders_details.quantity * purchase_orders_details.value AS total, 
                    purchase_orders.number AS po_number, purchase_orders.fk_id_establishment, purchase_orders.issue_date,purchase_orders.observation,
                    providers.name AS provider_name,
                    materials.name, 
                    measures.abbreviation, 
                    expense_accounts.number AS ea_number, 
                    
                    (SELECT COALESCE(SUM(guides_details.quantity), 0) 
                    FROM guides_details 
                    WHERE guides_details.fk_id_purchase_order_detail = purchase_orders_details.id_purchase_order_detail) 
                    AS received

                    FROM purchase_orders_details 
                    INNER JOIN purchase_orders on purchase_orders.id_purchase_order = purchase_orders_details.fk_id_purchase_order 
                    INNER JOIN providers on providers.id_provider = purchase_orders.fk_id_provider 
                    INNER JOIN materials on materials.id_material = purchase_orders_details.fk_id_material 
                    INNER JOIN measures on measures.id_measure = materials.fk_id_measure 
                    INNER JOIN expense_accounts on expense_accounts.id_expense_account = fk_id_expense_account 
                    
                    WHERE purchase_orders.fk_id_establishment = ?'
                , array($fk_id_establishment)
        );
        return $this->getFetchAll();
    }

}
