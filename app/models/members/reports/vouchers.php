<?php

class VouchersModel extends ReportsModel {

    public function __construct() {
        parent::__construct();
    }

    public function reports($values) {
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
                    ORDER BY vouchers.issue_date ASC'
                , array($fk_id_establishment)
        );
        return $this->getFetchAll();
    }

}
