<?php
class AjaxContactsModel extends ProvidersModel {

    public function __construct() {
        parent::__construct();
    }

   
//    public function loadContacts($values) {
//        extract($values);
//        $this->query('SELECT providers_contacts.* '
//                . 'FROM providers_contacts '
//                . 'INNER JOIN purchase_orders on purchase_orders.fk_id_provider = providers_contacts.fk_id_provider '
//                . 'WHERE providers_contacts.fk_id_provider=? '
//                . 'ORDER BY providers_contacts.name ASC '
//                , array($fk_id_provider)
//        );
//        return $this->getFetchAll();
//    }
//   
    public function loadContacts($values) {
        extract($values);
        $this->query('SELECT * '
                . 'FROM providers_contacts '
                . 'WHERE fk_id_provider=? '
                . 'ORDER BY name ASC '
                , array($fk_id_provider)
        );
        return $this->getFetchAll();
    }
}
