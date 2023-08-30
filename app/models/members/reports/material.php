<?php

class MaterialModel extends ReportsModel {

    public function __construct() {
        parent::__construct();
    }

    public function loadMaterial($values) {
        extract($values);
        $this->query($this->view_materials()
                . 'WHERE materials.fk_id_establishment=? '
                . 'AND materials.id_material=? '
                , array($fk_id_establishment, $id_material)
        );
        return $this->getFetch();
    }

    public function materialInGuides($values) {
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
                    
                    WHERE purchase_orders.fk_id_establishment = ? 
                    AND materials.id_material = ?'
                , array($fk_id_establishment, $id_material)
        );
        return $this->getFetchAll();
    }

    public function materialInVouchers($values) {
        extract($values);
        $this->query('SELECT vouchers.*, 
                    users_a.name AS user_name_autorized, users_t.name AS user_name_typist,
                    materials.name AS material, 
                    measures.abbreviation, measures.terminology AS measure_name,  
                    vouchers_details.quantity, 
                    expense_accounts.number AS ea_number, expense_accounts.name AS ea_name
                    FROM vouchers 
                    INNER JOIN vouchers_details on vouchers_details.fk_id_voucher = vouchers.id_voucher 
                    INNER JOIN users AS users_a on vouchers.fk_id_user_autorized = users_a.id_user 
                    INNER JOIN users AS users_t on vouchers.fk_id_user_typist = users_t.id_user 
                    INNER JOIN materials on materials.id_material = vouchers_details.fk_id_material 
                    INNER JOIN measures on measures.id_measure = materials.fk_id_measure 
                    INNER JOIN expense_accounts on expense_accounts.id_expense_account = materials.fk_id_expense_account 
                    
                    WHERE vouchers.fk_id_establishment = ? 
                    AND materials.id_material = ?'
                , array($fk_id_establishment, $id_material)
        );
        return $this->getFetchAll();
    }

    public function materialInPurchaseOrders($values) {
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
                    
                    WHERE purchase_orders.fk_id_establishment = ? 
                    AND materials.id_material = ?'
                , array($fk_id_establishment, $id_material)
        );
        return $this->getFetchAll();
    }

}
