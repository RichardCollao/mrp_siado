<?php

class MoldingsModel extends ReportsModel {

    public function __construct() {
        parent::__construct();
    }

    public function loadMolding($values) {
        extract($values);
        $this->query('SELECT moldings.*, '
                . 'providers.name AS providers_name, '
                . 'expense_accounts.name AS ea_name, '
                . 'expense_accounts.number AS ea_number '
                . 'FROM moldings '
                . 'INNER JOIN providers ON providers.id_provider = moldings.fk_id_provider '
                . 'INNER JOIN expense_accounts ON expense_accounts.id_expense_account = moldings.fk_id_expense_account '
                . 'WHERE moldings.fk_id_establishment=? '
                . 'AND moldings.id_molding=?'
                , array($id_molding)
        );
        return $this->getFetch();
    }

    public function pieces($values) {
        extract($values);
        $this->query('SELECT * '
                . 'FROM moldings_pieces '
                . 'WHERE fk_id_molding=? '
                . 'ORDER BY name ASC'
                , array($fk_id_molding)
        );
        return $this->getFetchAll();
    }

    public function listReception($values) {
        extract($values);
        $this->query('SELECT DISTINCT id_molding_guide, number, issue_date 
                FROM moldings_guides  
                WHERE fk_id_molding=? 
                AND type="reception" 
                ORDER BY issue_date ASC'
                , array($fk_id_molding)
        );
        return $this->getFetchAll();
    }

    public function listReturned($values) {
        extract($values);
        $this->query('SELECT DISTINCT id_molding_guide, number, issue_date 
                FROM moldings_guides  
                WHERE fk_id_molding=? 
                AND type="returned" 
                ORDER BY issue_date ASC'
                , array($fk_id_molding)
        );
        return $this->getFetchAll();
    }

    public function reception($values) {
        extract($values);
        $this->query('SELECT mg.id_molding_guide, mg.number, mg.issue_date, 
                mp.id_molding_piece, mp.code, mp.name,  
                mgd.quantity 
                FROM moldings_guides AS mg 
                INNER JOIN moldings_guides_details AS mgd ON mgd.fk_id_molding_guide=mg.id_molding_guide 
                INNER JOIN moldings_pieces AS mp ON mp.id_molding_piece=mgd.fk_id_molding_piece 
                WHERE mp.fk_id_molding=? 
                AND mg.type="reception" 
                ORDER BY mg.number ASC'
                , array($fk_id_molding)
        );
        return $this->getFetchAll();
    }

    public function returned($values) {
        extract($values);
        $this->query('SELECT mg.id_molding_guide, mg.number, mg.issue_date, 
                mp.id_molding_piece, mp.code, mp.name,  
                mgd.quantity 
                FROM moldings_guides AS mg 
                INNER JOIN moldings_guides_details AS mgd ON mgd.fk_id_molding_guide=mg.id_molding_guide 
                INNER JOIN moldings_pieces AS mp ON mp.id_molding_piece=mgd.fk_id_molding_piece 
                WHERE mp.fk_id_molding=? 
                AND mg.type="returned" 
                ORDER BY mg.number ASC'
                , array($fk_id_molding)
        );
        return $this->getFetchAll();
    }

}
