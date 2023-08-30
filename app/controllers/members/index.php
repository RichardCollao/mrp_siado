<?php

class IndexController extends MembersController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new IndexModel();

        $this->purchase_orders = $this->_Model->loadPurchaseOrders(array(
            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT')
        ));
        $this->bills = $this->_Model->loadBills(array(
            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT')
        ));
        $this->guides = $this->_Model->loadGuides(array(
            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT')
        ));
    }

    public function index() {
        $data = array();
        $data['purchase_orders'] = $this->purchase_orders;
        $data['bills'] = $this->bills;
        $data['guides'] = $this->guides;
        
        $this->_view($data);
    }

    private function _view($data) {
        // Llama al script que contiene la vista
        View::keep(path::appViews('./index.php'), $data, 'content');
    }

}
