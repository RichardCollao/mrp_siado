<?php

class IndexModel extends GuidesModel {

    public function __construct() {
        parent::__construct();
    }

    public function countRows($wheres, $filters) {
        #extract($values);
        $this->query('SELECT count(*) AS total '
                . 'FROM moldings_guides '
                . 'WHERE fk_id_molding=?'
                . $filters[0]
                , array_merge($wheres[1], $filters[1])
        );
        return $this->getFetch();
    }

    public function loadGuides($wheres, $filters, $limits) {

        #extract($values);
        $this->query('SELECT moldings_guides.*,moldings.name, '
                
                . '(SELECT COUNT(*) '
                . 'FROM moldings_guides_details '
                . 'WHERE moldings_guides_details.fk_id_molding_guide=moldings_guides.id_molding_guide ) AS count_items '
                
                . 'FROM moldings_guides, moldings '
                . 'WHERE fk_id_molding=? '
                . 'AND moldings.id_molding=moldings_guides.fk_id_molding '
                . $filters[0]
                . 'ORDER BY issue_date DESC, number DESC '
                . $limits[0]
                , array_merge($wheres[1], $filters[1], $limits[1])
        );
        return $this->getFetchAll();
    }

}
