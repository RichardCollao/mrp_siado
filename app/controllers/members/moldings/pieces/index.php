<?php

class IndexController extends PiecesController {

    private $_page;

    public function __construct() {

        parent::__construct();
        $this->_Model = new IndexModel();

        #$this->_checkPermissions();
        extract(DecomposeUrl::getArgumentKeyValue(1));
        $this->_page = (int) $page > 1 ? (int) $page : 1;

        $this->_id_molding = (int) DecomposeUrl::getArgument(0);

        $this->_molding = $this->_Model->loadMolding(array(
            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'),
            'id_molding' => $this->_id_molding)
        );
//        Debug::printRF($this->_molding);

        extract(DecomposeUrl::getArgumentKeyValue(0));
        $this->_page = (int) $page > 1 ? (int) $page : 1;
    }

    public function index() {
        $this->filters();
        $data['molding'] = $this->_molding;
        $data['rows'] = $this->_loadDataFromModel();
        $this->_view($data);
    }

    public function filters() {
        $this->Filter = new Filter(path::urlDomain('./'. $this->_id_molding));
        $this->Filter->setHeaders(array('Codigo', 'Nombre'));
        $this->Filter->addFieldInput('code', array('field' => 'code'));
        $this->Filter->addFieldInput('name', array('field' => 'name'));
        #$this->Filter->addFieldSelect('id_provider', array('field' => 'purchase_orders.fk_id_provider', 'options' => $this->list_providers));
        #$this->Filter->addFieldDate('issue_date', array('field' => 'bills.issue_date'));
    }

    public function _loadDataFromModel() {
        // Define paginacion.
        $offset = ($this->_page - 1) * constant('FW_ERP_ITEMS_PER_PAGE');
        $limit = constant('FW_ERP_ITEMS_PER_PAGE');

        // Define los filtros
        $q = (array) $this->Filter->getQuery();

        // Estructura la consulta
        $wheres = array('', array($this->_id_molding));
        $filters = array($q[0], (array) $q[1]);
        $limits = array(' LIMIT ?, ? ', array($offset, $limit));

        // Lanzar consultas
        $this->total_rows = $this->_Model->countRows($wheres, $filters);
        return $this->_Model->loadPieces($wheres, $filters, $limits);
    }

    private function _view($data) {
        $Paginator = new Paginator();
        $Paginator->setCurrentPage($this->_page);
        $Paginator->setItemsPerPage(constant('FW_ERP_ITEMS_PER_PAGE'));
        $Paginator->setItemsTotal($this->total_rows['total']);
        $Paginator->setUrl(path::urlDomain('./' . $this->_id_molding . '/[page]'));
        $data['pagination'] = $Paginator->getView();


        $data['bar_filters'] = $this->Filter->getBarFilters();

        $data['link_edit'] = path::urlDomain('./edit/');
        $data['link_create'] = path::urlDomain('./create/' . $this->_id_molding);
        $data['link_delete'] = path::urlDomain('./delete/');
        View::keep(path::appViews('./index.php'), $data, 'content');
        //View::keep('templates/bar.php', $data, 'content');
    }

}
