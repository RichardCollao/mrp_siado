<?php

class DisplayController extends UsersController {

    private $_id_user;
    private $_user;

    public function __construct() {
        parent::__construct();

        $this->_Model = new DisplayModel();

        $this->_id_user = (int) DecomposeUrl::getArgument(0);
        $this->_user = $this->_Model->loadUser(array(
            'id_user' => $this->_id_user)
        );
    }

    public function index() {
        $data['user'] = $this->_user;

        $this->_view($data);
    }

    private function _view($data) {
        $data['link_back'] = path::urlDomain('./');
        View::keep(path::appViews('./display.php'), $data, 'content');
        //View::keep('templates/bar.php', $data, 'content');
    }

}
