<?php

class IndexController extends ExpenseAccountsController {

    private $_page;

    public function __construct() {
        parent::__construct();

        $this->_Model = new IndexModel();
        $this->_checkPermissions();
    }

    public function index() {
        $this->filters();

        extract(DecomposeUrl::getArgumentKeyValue(0));
        $this->_page = (int) $page > 1 ? (int) $page : 1;

        $this->_expenseAccounts = $this->_loadDataFromModel();

        $data['rows'] = $this->_expenseAccounts;
        $this->_view($data);
    }

    public function filters() {
        $this->Filter = new Filter(path::urlDomain('./'));
        $this->Filter->setHeaders(array('Número', 'Nombre'));
        $this->Filter->addFieldInput('number', array('field' => 'expense_accounts.number'));
        $this->Filter->addFieldInput('name', array('field' => 'expense_accounts.name'));
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
        $wheres = array('', array(constant('AUTH_ESTABLISHMENT')));
        $filters = array($q[0], (array) $q[1]);
        $limits = array(' LIMIT ?, ? ', array($offset, $limit));

        // Lanzar consultas
        $this->total_rows = $this->_Model->countRows($wheres, $filters);
        return $this->_Model->loadExpenseAccounts($wheres, $filters, $limits);
    }

    private function _view($data) {
        $Paginator = new Paginator();
        $Paginator->setCurrentPage($this->_page);
        $Paginator->setItemsPerPage(constant('FW_ERP_ITEMS_PER_PAGE'));
        $Paginator->setItemsTotal($this->total_rows['total']);
        $Paginator->setUrl(path::urlDomain('./[page]'));
        $data['pagination'] = $Paginator->getView();
        $data['bar_filters'] = $this->Filter->getBarFilters();

        $data['link_edit'] = path::urlDomain('./edit/');
        $data['link_create'] = path::urlDomain('./create/');
        $data['link_delete'] = path::urlDomain('./delete/');
        View::keep(path::appViews('./index.php'), $data, 'content');
        //View::keep('templates/bar.php', $data, 'content');
    }

}
