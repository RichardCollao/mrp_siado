<?php

class DisplayController extends BillsController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new DisplayModel();
        $this->_id_bill = (int) DecomposeUrl::getArgument(0);
        $this->_bill = $this->_Model->loadBill(array(
            'id_bill' => $this->_id_bill)
        );

        $this->_details = $this->_Model->loadDetails(array(
            'fk_id_bill' => $this->_id_bill)
        );

        $this->_checkEstablishment($this->_bill['fk_id_establishment']);
        $this->_checkPermissions();
        $this->loadLists();
        $this->_checkLists();
    }

    public function index() {
        $data['bill'] = $this->_bill;
        $data['rows'] = $this->_details;
        $this->_view($data);
    }

    private function _view($data) {
        $data['link_back'] = path::urlDomain('./');
        View::keep(path::appViews('./display.php'), $data, 'content');
    }

}
