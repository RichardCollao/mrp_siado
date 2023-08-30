<?php

class IndexController extends VouchersController {

    private $_page;

    public function __construct() {
        parent::__construct();

        $this->_Model = new IndexModel();
        $this->_checkPermissions();

        extract(DecomposeUrl::getArgumentKeyValue(0));
        $this->_page = (int) $page > 1 ? (int) $page : 1;

        $this->loadLists();
    }

    public function index() {
        $this->filters();

        $data['rows'] = $this->_loadDataFromModel();
        foreach ($data['rows'] as $key => $value) {
            $path = $this->relative_path_attachments_documents . 'voucher_' . $value['id_voucher'] . '/';
            $data['rows'][$key]['count_files'] = count(getFilesExtension(path::dirPublicResources($path)));
        }

        $this->_view($data);
    }

    public function filters() {
        $this->Filter = new Filter(path::urlDomain('./'));
        $this->Filter->setHeaders(array('Número', 'Solicita', 'Autoriza', 'Fecha', 'Destino'));
        $this->Filter->addFieldInput('number', array('field' => 'number'));
        $this->Filter->addFieldInput('user_name_requesting', array('field' => 'user_name_requesting'));
        $this->Filter->addFieldSelect('fk_id_user_autorized', array('field' => 'fk_id_user_autorized', 'options' => $this->list_supervisors));
        $this->Filter->addFieldDate('issue_date', array('field' => 'issue_date'));
        $this->Filter->addFieldInput('destination', array('field' => 'destination'));
    }

    private function _loadDataFromModel() {
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
        return $this->_Model->loadVouchers($wheres, $filters, $limits);
    }

    private function _view($data) {
        $Paginator = new Paginator();
        $Paginator->setCurrentPage($this->_page);
        $Paginator->setItemsPerPage(constant('FW_ERP_ITEMS_PER_PAGE'));
        $Paginator->setItemsTotal($this->total_rows['total']);
        $Paginator->setUrl(path::urlDomain('./[page]'));
        $data['pagination'] = $Paginator->getView();
        $data['bar_filters'] = $this->Filter->getBarFilters();

        $data['link_display'] = path::urlDomain('./display/');
        $data['link_view_bills'] = path::urlDomain('./bills/');
        $data['link_view_guides'] = path::urlDomain('./guides/');

        $data['link_details'] = path::urlDomain('./details/');
        $data['link_edit'] = path::urlDomain('./edit/');
        $data['link_lock'] = path::urlDomain('./locked/lock/');
        $data['link_unlock'] = path::urlDomain('./locked/unlock/');
        $data['link_attachments'] = path::urlDomain('./attachments/');
        $data['link_create'] = path::urlDomain('./create/');
        $data['link_delete'] = path::urlDomain('./delete/');
        View::keep(path::appViews('./index.php'), $data, 'content');
        //View::keep('templates/bar.php', $data, 'content');
    }

}
