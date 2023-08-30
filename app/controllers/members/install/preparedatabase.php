<?php

class PrepareDataBaseController extends InstallController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->_view(array());
    }

    private function _view($data) {
        $redirect = Path::dir('createdatabase');

        $data['redirect'] = $redirect;
        $data['img_progress'] = 'images/progress.gif';

        // Llama al script que contiene la vista
        View::keep(path::appViews('preparedatabase.php'), $data, 'content');
    }

}
