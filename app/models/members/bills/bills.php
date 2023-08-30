<?php

class BillsModel extends MembersModel {

    public function __construct() {
        parent::__construct();
    }

    public function loadBill($values) {
        extract($values);
        $this->query($this->view_bills()
                . 'WHERE bills.id_bill = ? '
                , array($id_bill)
        );
        return $this->getFetch();
    }

    public function listPurchaseOrders($values) {
        extract($values);
        $this->query('SELECT providers.name AS provider_name, purchase_orders.* '
                . 'FROM providers, purchase_orders '
                . 'WHERE purchase_orders.fk_id_establishment = ? '
                . 'AND purchase_orders.fk_id_provider = providers.id_provider'
                , array($fk_id_establishment)
        );
        return $this->getFetchAll();
    }

    public function listProviders($values) {
        extract($values);
        $this->query('SELECT * '
                . 'FROM providers '
                . 'WHERE fk_id_establishment=? '
                . 'ORDER BY name ASC'
                , array($fk_id_establishment)
        );
        return $this->getFetchAll();
    }

    public function listMaterials($values) {
        extract($values);
        $this->query(
                'SELECT materials.*, measures.abbreviation, measures.terminology, 
                expense_accounts.name AS ea_name, expense_accounts.number AS ea_number, 
                    (SELECT COALESCE(SUM(guides_details.quantity), 0)  
                    FROM guides_details, purchase_orders_details 
                    WHERE purchase_orders_details.fk_id_material = materials.id_material 
                    AND guides_details.fk_id_purchase_order_detail = purchase_orders_details.id_purchase_order_detail) 
                    - 
                    (SELECT COALESCE(SUM(vouchers_details.quantity), 0) 
                    FROM vouchers_details 
                    WHERE vouchers_details.fk_id_material = materials.id_material) AS stock , 
                    purchase_orders_details.id_purchase_order_detail
                FROM materials 
                INNER JOIN expense_accounts on expense_accounts.id_expense_account = materials.fk_id_expense_account 
                INNER JOIN measures on measures.id_measure = materials.fk_id_measure '
                //-------------------
                . 'INNER JOIN bills on bills.id_bill = ? '
                . 'INNER JOIN purchase_orders_details on purchase_orders_details.fk_id_purchase_order = bills.fk_id_purchase_order '
                . 'WHERE materials.id_material = purchase_orders_details.fk_id_material'
                , array($id_bill)
        );
        return $this->getFetchAll();
    }

    public function duplicateNumber($values) {
        extract($values);
        $this->query('SELECT bills.* '
                . 'FROM bills, purchase_orders '
                . 'WHERE bills.id_bill<>? '
                . 'AND bills.number=? '
                . 'AND purchase_orders.id_purchase_order = ? '
                . 'AND purchase_orders.id_purchase_order = bills.fk_id_purchase_order '
                . 'AND purchase_orders.fk_id_provider'
                , array($id_bill, $number, $fk_id_purchase_order)
        );
        return $this->getFetch();
    }

}
