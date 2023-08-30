<?php

class DisplayController extends ProvidersController {

    private $_page;
    private $_query_filter;

    public function __construct() {
        parent::__construct();

        $this->_Model = new IndexModel();

        $this->_id_provider = (int) DecomposeUrl::getArgument(0);
        $this->_provider = $this->_Model->loadProvider(array(
            'id_provider' => $this->_id_provider
        ));
        $this->_contacts = $this->_Model->loadContacts(array(
            'fk_id_provider' => $this->_id_provider
        ));

        $this->_checkEstablishment($this->_provider['fk_id_establishment']);
        $this->_checkPermissions();
    }

    public function index() {
        $data['provider'] = $this->_provider;
        $data['rows'] = $this->_contacts;

        $this->_view($data);
    }

    private function _view($data) {
        $data['link_back'] = path::urlDomain('./');
        View::keep(path::appViews('./display.php'), $data, 'content');
        //View::keep('templates/bar.php', $data, 'content');
    }

}
