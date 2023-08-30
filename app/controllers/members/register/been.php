<?php

class BeenController extends RegisterController {

    public function __construct() {
        parent::__construct();

        $this->_id_user = (int) DecomposeUrl::getArgument(0);
        $this->_user = $this->_Model->loadUser($this->_id_user);
    }

    public function index() {
        $this->_view($data);
    }

    public function _view($data = array()) {
        $data['name'] = $this->_user['name'];
        $data['url_base'] = $data['link_base'] = Path::urlDomain('/');

        View::keep(path::appViews('./been.php'), $data, 'content');
    }

}