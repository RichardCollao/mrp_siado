<?php

class IndexModel extends ProvidersModel {

    public function __construct() {
        parent::__construct();
    }

    public function countRows($wheres, $filters) {
        #extract($values);
        $this->query('SELECT count(*) AS total '
                . 'FROM providers '
                . 'WHERE fk_id_establishment=? '
                . $filters[0]
                , array_merge($wheres[1], $filters[1])
        );
        return $this->getFetch();
    }

    public function loadProviders($wheres, $filters, $limits) {
        #extract($values);
        $this->query('SELECT * ,'
                . '(SELECT COUNT(*) '
                . 'FROM providers_contacts '
                . 'WHERE providers_contacts.fk_id_provider = providers.id_provider) AS count_contacts '
                . 'FROM providers '
                . 'WHERE fk_id_establishment=? '
                . $filters[0]
                . 'ORDER BY name ASC '
                . $limits[0]
                , array_merge($wheres[1], $filters[1], $limits[1])
        );
        return $this->getFetchAll();
    }

}
