<?php

class BillsModel extends ReportsModel {

    public function __construct() {
        parent::__construct();
    }

    public function reports($values) {
        extract($values);
        $this->query('SELECT bills.number, bills.issue_date, bills.observation,
                    bills_details.quantity, bills_details.value, bills_details.quantity * bills_details.value AS total, 
                    purchase_orders.fk_id_establishment, purchase_orders.number AS po_number, 
                    purchase_orders_details.value AS po_value, bills_details.quantity * purchase_orders_details.value AS po_total, 
                    (SELECT guides.number FROM guides WHERE guides.fk_id_bill = bills.id_bill) AS guide_number,
                    materials.name AS material,
                    measures.abbreviation, 
                    expense_accounts.number AS ea_number, 
                    providers.name AS provider_name  
                    FROM bills_details
                    INNER JOIN bills on bills.id_bill = bills_details.fk_id_bill 
                    INNER JOIN purchase_orders on purchase_orders.id_purchase_order = bills.fk_id_purchase_order
                    INNER JOIN purchase_orders_details on purchase_orders_details.id_purchase_order_detail = bills_details.fk_id_purchase_order_detail 
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
