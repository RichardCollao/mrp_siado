<?php

class DisplayController extends VouchersController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new DisplayModel();
        $this->_id_voucher = (int) DecomposeUrl::getArgument(0);
        $this->_voucher = $this->_Model->loadVoucher(array(
            'id_voucher' => $this->_id_voucher)
        );
        $this->_details = $this->_Model->loadDetails(array(
            'fk_id_voucher' => $this->_id_voucher)
        );

        $this->_checkEstablishment($this->_voucher['fk_id_establishment']);
        $this->_checkPermissions();
        $this->loadLists();
        $this->_checkLists();
    }

    public function index() {
        $data['voucher'] = $this->_voucher;
        $data['rows'] = $this->_details;

        $this->_view($data);
    }

    private function _view($data) {
        $data['link_back'] = path::urlDomain('./');
        View::keep(path::appViews('./display.php'), $data, 'content');
    }

}
