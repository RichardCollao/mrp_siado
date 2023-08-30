<?php

class DocumentController extends PurchaseOrdersController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new DocumentModel();
        $this->_id_purchase_order = (int) DecomposeUrl::getArgument(0);
        $this->_purchase_order = $this->_Model->loadPurchaseOrder(array(
            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'),
            'id_purchase_order' => $this->_id_purchase_order)
        );

        $this->_checkPermissions();
        #$this->loadLists();
        #$this->_checkLists();
    }

    public function index() {
        $this->_view($data);
    }

    private function _view($data) {
        $data['number'] = $this->_purchase_order['number'];
        $data['link_document']= path::urlLibraries("/pdfjs-1.7.225-dist/web/viewer.html?file=");
        $data['link_document'].= path::urlDomain('./pdf/' . $this->_id_purchase_order);
        // La libreria pdf.js obtiene el nombre desde la URL por lo tanto este debe ser pasado como parametro
        $data['link_document'].= '/OC ' . $this->_purchase_order['number'] . '.pdf';

        View::keep(path::appViews('./document.php'), $data, 'content');
    }

}
