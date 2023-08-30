<?php

require_once(path::dirPublicModules('/FilesExplorer/class/FilesExplorerServer.php'));

class AttachmentsController extends GuidesController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new GuidesModel();
        $this->_id_guide = (int) DecomposeUrl::getArgument(0);
        $this->_guide = $this->_Model->loadGuide(array(
            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'),
            'id_guide' => $this->_id_guide)
        );

        $this->_checkPermissions();
    }

    public function index() {
        $path = $this->relative_path_attachments_documents . 'guide_' . $this->_id_guide . '/';
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
        $data['reference'] = 'Archivos adjuntos en Guía: ' . $this->_guide['number'];
        $data['link_back'] = path::urlDomain('./');
        View::keep(path::appViews('/members/attachments.php'), $data, 'content');
    }

}
