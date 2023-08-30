<?php

require_once(path::dirPublicModules('/FilesExplorer/class/FilesExplorerServer.php'));

class AttachmentsController extends PurchaseOrdersController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new PurchaseOrdersModel();
        $this->_id_purchase_order = (int) DecomposeUrl::getArgument(0);
        $this->_purchase_order = $this->_Model->loadPurchaseOrder(array(
            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'),
            'id_purchase_order' => $this->_id_purchase_order)
        );
        $this->_checkPermissions();
    }

    public function index() {

        $path = $this->relative_path_attachments_documents . 'purchase_order_' . $this->_id_purchase_order . '/';
        // Establece los parametros que no necesariamente deben ser conocidos por el navegador por cuestiones de seguridad.
        FilesExplorerServer::setBaseDirFiles(path::dirPublicResources($path));
        FilesExplorerServer::setAllowedActions(['upload', 'addfolder', 'rename', 'move', 'delete']);

        $data['path_server_controller'] = path::urlDomain('/members/files');
        $data['path_layout'] = path::urlModules('/FilesExplorer/public/views/default.layout.html');
        $data['path_relative'] = '';
        // Define el token con el cual se asegura la sesion
        $data['token'] = FilesExplorerServer::generateToken();

        $this->_view($data);
    }

    private function _view($data) {
        $data['reference'] = 'Archivos adjuntos en Orden de compra: ' . $this->_purchase_order['number'];
        $data['link_back'] = path::urlDomain('./');
        View::keep(path::appViews('/members/attachments.php'), $data, 'content');
    }

}
