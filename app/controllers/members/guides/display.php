<?php

class DisplayController extends GuidesController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new DisplayModel();
        $this->_id_guide = (int) DecomposeUrl::getArgument(0);

        $this->_guide = $this->_Model->loadGuide(array(
            'id_guide' => $this->_id_guide)
        );

        $this->_details = $this->_Model->loadDetails(array(
            'fk_id_guide' => $this->_id_guide)
        );

        $this->_checkEstablishment($this->_guide['fk_id_establishment']);
        $this->_checkPermissions();
        $this->loadLists();
        $this->_checkLists();
    }

    public function index() {
        $data['guide'] = $this->_guide;
        $data['rows'] = $this->_details;
        $this->_view($data);
    }

    private function _view($data) {
        $data['link_back'] = path::urlDomain('./');
        View::keep(path::appViews('./display.php'), $data, 'content');
    }

}
