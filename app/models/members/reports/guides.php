<?php

class GuidesModel extends ReportsModel {

    public function __construct() {
        parent::__construct();
    }

    public function reports($values) {
        extract($values);
        $this->query('SELECT guides.number, guides.issue_date, guides.observation,
                    guides_details.quantity, 
                    purchase_orders.fk_id_establishment, purchase_orders.number AS po_number, 
                    (SELECT bills.number FROM bills WHERE bills.id_bill = guides.fk_id_bill) AS bill_number, 
                    purchase_orders_details.value AS po_value, guides_details.quantity * purchase_orders_details.value AS po_total, 
                    materials.name AS material,
                    measures.abbreviation, 
                    expense_accounts.number AS ea_number, 
                    providers.name AS provider_name 
                    FROM guides_details 
                    INNER JOIN guides on guides.id_guide = guides_details.fk_id_guide 
                    INNER JOIN purchase_orders on purchase_orders.id_purchase_order = guides.fk_id_purchase_order 
                    INNER JOIN purchase_orders_details on purchase_orders_details.id_purchase_order_detail = guides_details.fk_id_purchase_order_detail 
                    INNER JOIN materials on materials.id_material = purchase_orders_details.fk_id_material 
                    INNER JOIN measures on measures.id_measure = materials.fk_id_measure 
                    INNER JOIN expense_accounts on expense_accounts.id_expense_account = materials.fk_id_expense_account 
                    INNER JOIN providers on providers.id_provider = purchase_orders.fk_id_provider 
                    
                    WHERE purchase_orders.fk_id_establishment = ? '
                , array($fk_id_establishment)
        );
        return $this->getFetchAll();
    }

}
