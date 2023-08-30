<?php

class BillController extends GuidesController {

    private $_page;

    public function __construct() {
        parent::__construct();
        $this->_Model = new BillModel();
        $this->loadLists();

        $this->_id_bill = (int) DecomposeUrl::getArgument(0);
        $this->_bill = $this->_Model->loadBill(array(
            'id_bill' => $this->_id_bill)
        );

        $this->_checkEstablishment($this->_bill['fk_id_establishment']);
        $this->_checkPermissions();

        $this->_page = (int) DecomposeUrl::getArgument(0) > 1 ? (int) DecomposeUrl::getArgument(0) : 1;
    }

    public function index() {
        if (isset($_POST['filter'])) {
            $this->_saveFilters();
        } elseif (isset($_POST['reset'])) {
            $this->_resetFilters();
        }
        $data = $this->_bill;
        $data['rows'] = $this->_loadDataFromModel();
        #printArray($data['rows']);

        $this->_view($data);
    }

    public function _loadDataFromModel() {
        // Define paginacion.
        $offset = ($this->_page - 1) * constant('FW_ERP_ITEMS_PER_PAGE');
        $limit = constant('FW_ERP_ITEMS_PER_PAGE');

        return $this->_Model->loadGuides(array(
                    'fk_id_bill' => $this->_id_bill,
                    'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'),
                    'offset' => $offset,
                    'limit' => $limit)
        );
    }

    private function _view($data) {
        $Paginator = new Paginator();
        $Paginator->setCurrentPage($this->_page);
        $Paginator->setItemsPerPage(constant('FW_ERP_ITEMS_PER_PAGE'));
        $Paginator->setItemsTotal($this->total_rows['total']);
        $Paginator->setUrl(path::urlDomain('./[page]'));

        $data['link_display'] = path::urlDomain('./display/');
        $data['link_details'] = path::urlDomain('./details/');
        $data['link_edit'] = path::urlDomain('./edit/');
        $data['link_create'] = path::urlDomain('./create/');
        $data['link_delete'] = path::urlDomain('./delete/');
        View::keep(path::appViews('./bill.php'), $data, 'content');
        //View::keep('templates/bar.php', $data, 'content');
    }

}
