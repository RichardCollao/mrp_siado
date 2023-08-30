<?php

class DisplayController extends GuidesController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new DisplayModel();
        $this->_id_molding_guide = (int) DecomposeUrl::getArgument(0);
        $this->_molding_guide = $this->_Model->loadMoldingGuide(array(
            'id_molding_guide' => $this->_id_molding_guide)
        );

        $this->_details = $this->_Model->loadDetails(array(
            'fk_id_molding_guide' => $this->_id_molding_guide)
        );
        $this->_id_molding = $this->_molding_guide['fk_id_molding'];
        #$this->_checkPermissions();
        $this->loadLists();
        $this->_checkLists();
    }

    public function index() {
        $data['molding_guide'] = $this->_molding_guide;
        $data['rows'] = $this->_details;
        $this->_view($data);
    }

    private function _view($data) {
        $data['link_back'] = path::urlDomain('./' . $this->_id_molding);
        View::keep(path::appViews('./display.php'), $data, 'content');
    }

}
