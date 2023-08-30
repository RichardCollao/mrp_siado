<?php

class IndexModel extends MaterialsModel {

    public function __construct() {
        parent::__construct();
    }

    public function countRows($wheres, $filters) {
        #extract($values);
        $this->query('SELECT count(*) AS total '
                . 'FROM (' . $this->view_materials(). ') as materials '
                . 'WHERE materials.fk_id_establishment=? '
                . $filters[0]
                , array_merge($wheres[1], $filters[1])
        );
        return $this->getFetch();
    }

    public function loadMaterials($wheres, $filters, $limits) {
        #extract($values);
        $this->query('SELECT * '
                . 'FROM (' . $this->view_materials(). ') as materials '
                . 'WHERE materials.fk_id_establishment=? '
                . $filters[0]
                . 'ORDER BY materials.name ASC '
                . $limits[0]
                , array_merge($wheres[1], $filters[1], $limits[1])
        );
        return $this->getFetchAll();
    }

}
