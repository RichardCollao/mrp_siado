<?php

class SuccessController extends RecoverController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = array();
        // Carga la vista
        $this->_view($data);
    }

    private function _view($data) {
        $data['link_base'] = path::urlDomain('');
        View::keep(path::appViews('./success.php'), $data, 'content');
    }

}
