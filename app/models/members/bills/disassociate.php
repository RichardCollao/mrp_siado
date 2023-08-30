<?php

class GuidesModel extends BillsModel {

    public function __construct() {
        parent::__construct();
    }

    public function loadGuide($values) {
        extract($values);
        $this->query('
                SELECT *  
                FROM guides 
                WHERE id_guide = ? '
                , array($id_guide)
        );
        return $this->getFetch();
    }
    
    public function disassociateGuide($values) {
        extract($values);
        return $this->query('
                        UPDATE guides  
                        SET fk_id_bill=null
                        WHERE id_guide=?'
                        , array($id_guide)
        );
    }

}
