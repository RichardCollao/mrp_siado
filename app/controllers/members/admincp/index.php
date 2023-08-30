<?php

class IndexController extends AdmincpController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = array();

        $this->_view($data);
    }

    private function _view($data) {
        View::keep(path::appViews('./index.php'), $data, 'content');
    }

}