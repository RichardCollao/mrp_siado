<?php

class GuidesModel extends MembersModel {

    public function __construct() {
        parent::__construct();
    }

    public function loadGuide($values) {
        extract($values);
        $this->query($this->view_guides()
                . 'WHERE guides.id_guide = ?'
                , array($id_guide)
        );
        return $this->getFetch();
    }

    public function listPurchaseOrders($values) {
        extract($values);
        $this->query('SELECT providers.name AS provider_name, purchase_orders.* '
                . 'FROM providers, purchase_orders '
                . 'WHERE purchase_orders.fk_id_establishment = ? '
                . 'AND purchase_orders.fk_id_provider = providers.id_provider '
                . 'ORDER BY purchase_orders.issue_date DESC, purchase_orders.id_purchase_order DESC'
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
        $this->query('SELECT materials.*, measures.abbreviation, measures.terminology, 
            purchase_orders_details.id_purchase_order_detail, purchase_orders_details.value, purchase_orders_details.quantity AS stock,
            expense_accounts.name AS ea_name, expense_accounts.number AS ea_number 

            FROM materials 
            INNER JOIN expense_accounts on expense_accounts.id_expense_account = materials.fk_id_expense_account 
            INNER JOIN measures on measures.id_measure = materials.fk_id_measure '
                // -------------------
                . 'INNER JOIN guides on guides.id_guide = ? '
                . 'INNER JOIN purchase_orders_details on purchase_orders_details.fk_id_purchase_order = guides.fk_id_purchase_order '
                . 'WHERE materials.id_material = purchase_orders_details.fk_id_material '
                . 'ORDER BY materials.name'
                , array($id_guide)
        );
        return $this->getFetchAll();
    }

    public function duplicateNumber($values) {
        extract($values);
        $this->query('SELECT guides.* '
                . 'FROM guides, purchase_orders '
                . 'WHERE guides.id_guide<>? '
                . 'AND guides.number=? '
                . 'AND purchase_orders.id_purchase_order = ? '
                . 'AND purchase_orders.id_purchase_order = guides.fk_id_purchase_order '
                . 'AND purchase_orders.fk_id_provider'
                , array($id_guide, $number, $fk_id_purchase_order)
        );
        return $this->getFetch();
    }

}
