<?php

class PurchaseorderController extends BillsController {

    private $_page;

    public function __construct() {
        parent::__construct();

        $this->_Model = new PurchaseorderModel();
        $this->loadLists();

        $this->_id_purchase_order = (int) DecomposeUrl::getArgument(0);
        $this->_purchase_order = $this->_Model->loadPurchaseOrder(array(
            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'),
            'id_purchase_order' => $this->_id_purchase_order)
        );

        $this->_page = (int) DecomposeUrl::getArgument(0) > 1 ? (int) DecomposeUrl::getArgument(0) : 1;
     }

    public function index() {
        if (isset($_POST['filter'])) {
            $this->_saveFilters();
        } elseif (isset($_POST['reset'])) {
            $this->_resetFilters();
        }
        
        $data = $this->_purchase_order;
        $data['rows'] = $this->_loadDataFromModel();
        $data['number_purchase_order'] = $data['rows'][0]['po_number'];

        $this->_view($data);
    }

    public function _loadDataFromModel() {
        // Define paginacion.
        $offset = ($this->_page - 1) * constant('FW_ERP_ITEMS_PER_PAGE');
        $limit = constant('FW_ERP_ITEMS_PER_PAGE');

        return $this->_Model->loadBills(array(
                    'fk_id_purchase_order' => $this->_id_purchase_order,
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

        $data['link_display'] = path::urlDomain('./../bills/display/');
        $data['link_details'] = path::urlDomain('./details/');
        $data['link_guides'] = path::urlDomain('./guides/');
        $data['link_edit'] = path::urlDomain('./edit/');
        $data['link_create'] = path::urlDomain('./create/');
        $data['link_delete'] = path::urlDomain('./delete/');
        View::keep(path::appViews('./purchaseorder.php'), $data, 'content');
        //View::keep('templates/bar.php', $data, 'content');
    }

}
