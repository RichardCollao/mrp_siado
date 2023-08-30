<?php

class CreateDataBaseController extends InstallController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new InstallModel();
    }

    public function index() {
        $this->_installDataBase();
        $this->_view(array());
    }

    private function _installDataBase() {
        $querys = extractSQL(Path::appModels('./database.sql'));
        foreach ($querys as $query) {
            $this->_Model->query($query, array());
        }
    }

    private function _view($data) {
        $data['link_next'] = Path::urlDomain('./defineadmin');

        // Llama al script que contiene la vista
        View::keep(path::appViews('./createdatabase.php'), $data, 'content');
    }

}
