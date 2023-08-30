<?php

class VouchersModel extends MembersModel {

    public function __construct() {
        parent::__construct();
    }

    public function loadVoucher($values) {
        extract($values);
        $this->query('SELECT vouchers.*, ut.name AS name_typist, ua.name AS name_autorized '
                . 'FROM vouchers, users ut, users ua '
                . 'WHERE vouchers.id_voucher = ? '
                . 'AND ut.id_user = vouchers.fk_id_user_typist '
                . 'AND ua.id_user = vouchers.fk_id_user_autorized '
                , array($id_voucher)
        );
        return $this->getFetch();
    }

    public function listSupervisors($values) {
        extract($values);
        $this->query('SELECT users.id_user, users.name '
                . 'FROM users, users_permissions '
                . 'WHERE users.fk_id_establishment = ? '
                . 'AND users_permissions.fk_id_user = users.id_user '
                . 'AND users_permissions.permissions LIKE "%authorize_vouchers%" '
                . 'ORDER BY users.name'
                , array($fk_id_establishment)
        );
        return $this->getFetchAll();
    }

    public function listMaterials($values) {
        extract($values);
        $this->query($this->view_materials()
                . 'WHERE materials.fk_id_establishment=? '
                . 'ORDER BY materials.name'
                , array($fk_id_establishment));
        return $this->getFetchAll();
    }

//    public function listUserNameRequestings($values) {
//        extract($values);
//        $this->query('SELECT DISTINCT user_name_requesting '
//                . 'FROM vouchers '
//                . 'WHERE fk_id_establishment=? '
//                . 'ORDER BY user_name_requesting ASC'
//                , array($fk_id_establishment));
//        return $this->getFetchAll();
//    }
//    
//    public function listDestinations($values) {
//        extract($values);
//        $this->query('SELECT DISTINCT destination '
//                . 'FROM vouchers '
//                . 'WHERE fk_id_establishment=? '
//                . 'ORDER BY destination ASC'
//                , array($fk_id_establishment));
//        return $this->getFetchAll();
//    }

    public function duplicateNumber($values) {
        extract($values);
        $this->query('SELECT * '
                . 'FROM vouchers '
                . 'WHERE fk_id_establishment=? '
                . 'AND number=? '
                . 'AND id_voucher<>? '
                , array($fk_id_establishment, $number, $id_voucher)
        );
        return $this->getFetch();
    }

}
