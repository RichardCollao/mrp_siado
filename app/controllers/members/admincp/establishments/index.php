<?php

class IndexController extends EstablishmentsController {

    private $_page;

    public function __construct() {
        parent::__construct();

        $this->_Model = new IndexModel();

        $this->_page = (int) DecomposeUrl::getArgument(0);
        if ($this->_page < 1) {
            $this->_page = 1;
        }
    }

    public function index() {
        if (isset($_POST['filter'])) {
            $this->_saveFilters();
        } elseif (isset($_POST['reset'])) {
            $this->_resetFilters();
        }
        $data = $this->_loadDataFromModel();

        $this->_view($data);
    }

    public function _loadDataFromModel() {
        // Define paginacion.
        $offset = ($this->_page - 1) * constant('FW_ERP_ITEMS_PER_PAGE');
        $limit = constant('FW_ERP_ITEMS_PER_PAGE');
        $paginate = ' LIMIT ?,?';

        $data['rows'] = $this->_Model->loadEstablishments($paginate, array($offset, $limit));

        return $data;
    }

    /**
     * Muestra la vista asociada recibe como argumento la variable data que contiene los valores
     * correspondientes a los campos ya sea desde la base de datos o por repopulacion del formulario.
     */
    private function _view($data) {



        $Paginator = new Paginator();
        $Paginator->setCurrentPage($this->_page);
        $Paginator->setItemsPerPage(constant('FW_ERP_ITEMS_PER_PAGE'));
        $Paginator->setItemsTotal($this->total_rows['total']);
        $Paginator->setUrl(path::urlDomain('./[page]'));

        $data['link_edit'] = path::urlDomain('./edit/');
        $data['link_create'] = path::urlDomain('./create/');
        $data['link_delete'] = path::urlDomain('./delete/');
        View::keep(path::appViews('./index.php'), $data, 'content');
        //View::keep('templates/bar.php', $data, 'content');
    }

}
