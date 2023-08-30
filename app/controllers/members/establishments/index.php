<?php

class IndexController extends EstablishmentsController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new IndexModel();
        $this->_checkPermissions();
    }

    public function index() {
        $data = $this->_Model->loadEstablishment(array(
            'id_establishment' => constant('AUTH_ESTABLISHMENT')
        ));
        $this->_view($data);
    }

    /**
     * Muestra la vista asociada recibe como argumento la variable data que contiene los valores
     * correspondientes a los campos ya sea desde la base de datos o por repopulacion del formulario.
     */
    private function _view($data) {
        $data['link_modify'] = path::urlDomain('./modify/');
        $data['link_logo'] = path::urlDomain('./logo/');
        $data['src_logo'] = path::urlResources($this->relative_path_logos . 'logo.png?nocache=' . md5(time()));

        View::keep(path::appViews('./index.php'), $data, 'content');
        //View::keep('templates/bar.php', $data, 'content');
    }

}
