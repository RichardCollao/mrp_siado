<?php

class IndexController extends ImportsController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->_createObjPHPExcel();
        
        $this->_view();
    }

    private function _view($data =array()) {

//        $data['link_vouchers'] = path::urlDomain('./details/');
//        $data['link_purchase_orders'] = path::urlDomain('./edit/');
//        $data['link_guides'] = path::urlDomain('./create/');
//        $data['link_bills'] = path::urlDomain('./delete/');
//        View::keep(path::appViews('./index.php'), $data, 'content');
//        //View::keep('templates/bar.php', $data, 'content');
    }

}
