<?php

class FinishedController extends InstallController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->_view(array());
    }

    private function _view($data) {
        $data['link_base'] = Path::urlDomain('/');

        # Llama al script que contiene la vista
        View::keep(path::appViews('./finished.php'), $data, 'content');
    }

}
