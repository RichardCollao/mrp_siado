<?php

class IndexController extends UsersController {

    private $_page;

    public function __construct() {
        parent::__construct();

        extract(DecomposeUrl::getArgumentKeyValue(0));
        $this->_page = (int) $page > 1 ? (int) $page : 1;

        $this->_Model = new IndexModel();
        $this->_checkPermissions();
    }

    public function index() {
        $this->filters();

        $data['rows'] = $this->_loadDataFromModel();
        $this->_view($data);
    }

    public function filters() {
        $this->Filter = new Filter(path::urlDomain('./'));
        $this->Filter->setHeaders(array('Nombre', 'Correo', 'Estado'));
        $this->Filter->addFieldInput('name', array('field' => 'users.name'));
        $this->Filter->addFieldInput('mail', array('field' => 'mail'));
        $this->Filter->addFieldSelect('state_acount', array('field' => 'state_acount', 'options' => $this->list_state_acounts));
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
        return $this->_Model->loadUsers($wheres, $filters, $limits);
    }

    private function _view($data) {
        $Paginator = new Paginator();
        $Paginator->setCurrentPage($this->_page);
        $Paginator->setItemsPerPage(constant('FW_ERP_ITEMS_PER_PAGE'));
        $Paginator->setItemsTotal($this->total_rows['total']);
        $Paginator->setUrl(path::urlDomain('./[page]'));
        $data['pagination'] = $Paginator->getView();
        $data['bar_filters'] = $this->Filter->getBarFilters();
        $data['link_permissions'] = path::urlDomain('./permissions/');
        $data['link_edit'] = path::urlDomain('./edit/');
        $data['link_create'] = path::urlDomain('./create/');
        $data['link_delete'] = path::urlDomain('./delete/');
        View::keep(path::appViews('./index.php'), $data, 'content');
        //View::keep('templates/bar.php', $data, 'content');
    }

}
