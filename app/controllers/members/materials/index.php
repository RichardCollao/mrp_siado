<?php

class IndexController extends MaterialsController {

    private $_page;

    public function __construct() {

        parent::__construct();
        $this->_Model = new IndexModel();

        $this->_checkPermissions();

        extract(DecomposeUrl::getArgumentKeyValue(0));
        $this->_page = (int) $page > 1 ? (int) $page : 1;
    }

    public function index() {
        $this->filters();
        $data['rows'] = $this->_loadDataFromModel();

//        Debug::printRF($data['rows']);
        $this->_view($data);
    }

    public function filters() {
        $options = array(
            1 => "Stock igual a cero",
            2 => "Stock mayor a cero",
            3 => "En stock critico"
        );

        $this->Filter = new Filter(path::urlDomain('./'));
        $this->Filter->setHeaders(array('Nombre', 'Unidad', 'Número CC', 'Stock'));
        $this->Filter->addFieldInput('name', array('field' => 'name'));
        $this->Filter->addFieldInput('abbreviation', array('field' => 'abbreviation'));
        $this->Filter->addFieldInput('ea_number', array('field' => 'ea_number'));
        $this->Filter->addFieldSelectStock('stock', array('field' => 'stock', 'options' => $options));
    }

    public function _loadDataFromModel() {
        // Define paginacion.
        $offset = ($this->_page - 1) * constant('FW_ERP_ITEMS_PER_PAGE');
        $limit = constant('FW_ERP_ITEMS_PER_PAGE');

        // Define los filtros
        $q = (array) $this->Filter->getQuery();

        // Estructura la consulta
        $wheres = array('', array(constant('AUTH_ESTABLISHMENT')));
        $filters = array($q[0], (array) $q[1]);
        $limits = array(' LIMIT ?, ? ', array($offset, $limit));

        // Lanzar consultas
        $this->total_rows = $this->_Model->countRows($wheres, $filters);
        return $this->_Model->loadMaterials($wheres, $filters, $limits);
    }

    private function _view($data) {
        $Paginator = new Paginator();
        $Paginator->setCurrentPage($this->_page);
        $Paginator->setItemsPerPage(constant('FW_ERP_ITEMS_PER_PAGE'));
        $Paginator->setItemsTotal($this->total_rows['total']);
        $Paginator->setUrl(path::urlDomain('./[page]'));
        $data['pagination'] = $Paginator->getView();
        $data['bar_filters'] = $this->Filter->getBarFilters();

        $data['link_report_excel'] = path::urlDomain('reports/material/');
        $data['link_edit'] = path::urlDomain('./edit/');
        $data['link_create'] = path::urlDomain('./create/');
        $data['link_delete'] = path::urlDomain('./delete/');
        View::keep(path::appViews('./index.php'), $data, 'content');
        //View::keep('templates/bar.php', $data, 'content');
    }

}
