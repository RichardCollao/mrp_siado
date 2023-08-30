<?php

class DisplayController extends PurchaseOrdersController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new DisplayModel();
        $this->_id_purchase_order = (int) DecomposeUrl::getArgument(0);
        $this->_purchase_order = $this->_Model->loadPurchaseOrder(array(
            'id_purchase_order' => $this->_id_purchase_order)
        );
        $this->_details = $this->_Model->loadDetails(array(
            'fk_id_purchase_order' => $this->_id_purchase_order)
        );

        $this->_checkEstablishment($this->_purchase_order['fk_id_establishment']);
        $this->_checkPermissions();
        $this->loadLists();
        $this->_checkLists();
    }

    public function index() {
        $data['purchase_order'] = $this->_purchase_order;
        $data['rows'] = $this->_details;
        $this->_view($data);
    }

    private function _view($data) {
        $data['link_back'] = path::urlDomain('./');
        View::keep(path::appViews('./display.php'), $data, 'content');
    }

}
