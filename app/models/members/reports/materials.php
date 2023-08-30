<?php

class MaterialsModel extends ReportsModel {

    public function __construct() {
        parent::__construct();
    }

    public function reports($values) {
        extract($values);
        $this->query('SELECT materials.*, measures.abbreviation, measures.terminology, 
                    expense_accounts.name AS ea_name, expense_accounts.number AS ea_number, 
                    (SELECT COALESCE(SUM(guides_details.quantity), 0)  
                    FROM guides_details, purchase_orders_details 
                    WHERE purchase_orders_details.fk_id_material = materials.id_material 
                    AND guides_details.fk_id_purchase_order_detail = purchase_orders_details.id_purchase_order_detail) AS total_in_guides,

                    (SELECT COALESCE(SUM(vouchers_details.quantity), 0) 
                    FROM vouchers_details 
                    WHERE vouchers_details.fk_id_material = materials.id_material) AS total_in_vouchers  
                    
                    FROM materials 
                    INNER JOIN expense_accounts on expense_accounts.id_expense_account = materials.fk_id_expense_account 
                    INNER JOIN measures on measures.id_measure = materials.fk_id_measure

                    WHERE materials.fk_id_establishment = ? ORDER BY materials.name'
                , array($fk_id_establishment)
        );
        return $this->getFetchAll();
    }

}
