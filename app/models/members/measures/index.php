<?php

class IndexModel extends MeasuresModel {

    public function __construct() {
        parent::__construct();
    }

    public function countRows($wheres, $filters) {
        #extract($values);
        $this->query('SELECT count(*) AS total '
                . 'FROM measures '
                . 'WHERE fk_id_establishment=? '
                . $filters[0]
                , array_merge($wheres[1], $filters[1])
        );
        return $this->getFetch();
    }

    public function loadMeasures($wheres, $filters, $limits) {
        #extract($values);
        $this->query('SELECT * '
                . 'FROM measures '
                . 'WHERE fk_id_establishment=? '
                . $filters[0]
                . 'ORDER BY abbreviation ASC '
                . $limits[0]
                , array_merge($wheres[1], $filters[1], $limits[1])
        );
        return $this->getFetchAll();
    }

}
