<?php

class GuidesModel extends BillsModel {

    public function __construct() {
        parent::__construct();
    }

    public function associateGuide($values) {
        extract($values);
        return $this->query('
                        UPDATE guides  
                        SET fk_id_bill=? 
                        WHERE id_guide=?'
                        , array($fk_id_bill, $id_guide)
        );
    }

    public function loadGuides($values) {
        extract($values);
        $this->query($this->view_guides()
                . 'WHERE guides.fk_id_purchase_order = ? '
                . 'AND guides.fk_id_bill IS NULL'
                , array($fk_id_purchase_order)
        );
        return $this->getFetchAll();
    }

    public function loadGuidesAssociates($values) {
        extract($values);
        $this->query($this->view_guides()
                . 'WHERE guides.fk_id_bill = ? '
                , array($fk_id_bill)
        );
        return $this->getFetchAll();
    }

}
