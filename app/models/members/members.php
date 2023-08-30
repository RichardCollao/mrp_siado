<?php

class MembersModel extends Model {

//$this->getStrView
    public $view;

    public function __construct() {
        parent::__construct();
    }

    public function getPermissions($values) {
        extract($values);
        $this->query('SELECT * FROM users_permissions '
                . 'WHERE fk_id_user=? LIMIT 1'
                , array($fk_id_user));
        return $this->getFetch();
    }

    public function view_materials() {
        return 'SELECT materials.*, measures.abbreviation, measures.terminology, 
            expense_accounts.name AS ea_name, expense_accounts.number AS ea_number, 
                (SELECT COALESCE(SUM(guides_details.quantity), 0)  
                FROM guides_details, purchase_orders_details 
                WHERE purchase_orders_details.fk_id_material = materials.id_material 
                AND guides_details.fk_id_purchase_order_detail = purchase_orders_details.id_purchase_order_detail) 
                AS total_in_guides, 
                (SELECT COALESCE(SUM(vouchers_details.quantity), 0) 
                FROM vouchers_details 
                WHERE vouchers_details.fk_id_material = materials.id_material) 
                AS total_in_vouchers 
            FROM materials 
            INNER JOIN expense_accounts on expense_accounts.id_expense_account = materials.fk_id_expense_account 
            INNER JOIN measures on measures.id_measure = materials.fk_id_measure ';
    }

    public function view_purchase_orders() {
        return 'SELECT purchase_orders.*, providers.name AS provider_name, providers.rut AS provider_rut, 
            establishments.name AS establishments_name, 
            (SELECT SUM(purchase_orders_details.quantity * purchase_orders_details.value) 
            FROM purchase_orders_details 
            WHERE purchase_orders_details.fk_id_purchase_order = purchase_orders.id_purchase_order 
            ) AS total, 
            (SELECT SUM(bills_details.quantity * bills_details.value) 
            FROM bills_details, bills 
            WHERE bills_details.fk_id_bill = bills.id_bill 
            AND bills.fk_id_purchase_order = purchase_orders.id_purchase_order 
            ) AS bills_total, 
            (SELECT COUNT(*) FROM purchase_orders_details 
            WHERE purchase_orders_details.fk_id_purchase_order = purchase_orders.id_purchase_order) AS count_items,
        (SELECT COUNT(*) FROM bills WHERE bills.fk_id_purchase_order = purchase_orders.id_purchase_order) AS count_bills,  
        (SELECT COUNT(*) FROM guides WHERE guides.fk_id_purchase_order = purchase_orders.id_purchase_order) AS count_guides  
        FROM purchase_orders 
        INNER JOIN providers on purchase_orders.fk_id_provider = providers.id_provider 
        INNER JOIN establishments on purchase_orders.fk_id_establishment = establishments.id_establishment ';
    }

    public function view_bills() {
        return 'SELECT bills.*, 
        purchase_orders.fk_id_establishment, purchase_orders.number AS po_number, 
        providers.id_provider AS fk_id_provider, providers.name AS provider_name, providers.rut AS provider_rut, 
            (SELECT COALESCE(SUM(quantity * value), 0) 
            FROM bills_details 
            WHERE fk_id_bill = bills.id_bill 
            ) AS total, 
            (SELECT COALESCE(SUM(guides_details.quantity * purchase_orders_details.value), 0) 
            FROM guides_details, purchase_orders_details, guides  
            WHERE guides.fk_id_bill = bills.id_bill 
            AND guides_details.fk_id_guide = guides.id_guide 
            AND purchase_orders_details.id_purchase_order_detail = guides_details.fk_id_purchase_order_detail
            ) AS total_guides, 
        (SELECT COUNT(*) FROM bills_details WHERE bills_details.fk_id_bill = bills.id_bill) AS count_items, 
        (SELECT COUNT(*) FROM guides WHERE guides.fk_id_bill = bills.id_bill) AS count_guides 
        FROM bills 
        INNER JOIN purchase_orders on purchase_orders.id_purchase_order = bills.fk_id_purchase_order 
        INNER JOIN providers on providers.id_provider = purchase_orders.fk_id_provider ';
    }

    public function view_guides() {
        return 'SELECT guides.*, 
        purchase_orders.fk_id_establishment, purchase_orders.number AS po_number, 
        (SELECT bills.number FROM bills WHERE bills.id_bill = guides.fk_id_bill) AS bill_number,  
        providers.id_provider AS fk_id_provider, providers.name AS provider_name, providers.rut AS provider_rut,   
            (SELECT COALESCE(SUM(guides_details.quantity * purchase_orders_details.value), 0) 
            FROM guides_details, purchase_orders_details 
            WHERE guides_details.fk_id_guide = guides.id_guide 
            AND purchase_orders_details.id_purchase_order_detail = guides_details.fk_id_purchase_order_detail
            ) AS total, 
        (SELECT COUNT(*) FROM guides_details WHERE guides_details.fk_id_guide = guides.id_guide) AS count_items 
        FROM guides 
        INNER JOIN purchase_orders on purchase_orders.id_purchase_order = guides.fk_id_purchase_order 
        INNER JOIN providers on providers.id_provider = purchase_orders.fk_id_provider ';
    }

    public function view_vouchers() {
        return 'SELECT vouchers.*, 
        users_a.name AS user_name_autorized, users_t.name AS user_name_typist,
        (SELECT COUNT(*) FROM vouchers_details WHERE vouchers_details.fk_id_voucher = vouchers.id_voucher) AS count_items 
        FROM vouchers 
        INNER JOIN users AS users_a on users_a.id_user = vouchers.fk_id_user_autorized 
        INNER JOIN users AS users_t on users_t.id_user = vouchers.fk_id_user_typist ';
    }

}
