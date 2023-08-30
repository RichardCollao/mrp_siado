<?php

class AjaxContactsController extends ProvidersController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new AjaxContactsModel();

        $this->_id_provider = (int) DecomposeUrl::getArgument(0);
        $this->_provider = $this->_Model->loadProvider(array(
            'id_provider' => $this->_id_provider
        ));
        $this->_contacts = $this->_Model->loadContacts(array(
            'fk_id_provider' => $this->_id_provider
        ));
        #$this->_checkPermissions();
    }

    public function index() {
        $data['provider'] = $this->_provider;
        $this->_view($data);
    }

    private function _view($data) {
        header('Content-Type: application/json');
        echo json_encode($this->_contacts, JSON_UNESCAPED_UNICODE);
        die();
    }

}
