<?php

require_once(path::dirPublicModules('/FilesExplorer/class/FilesExplorerServer.php'));

class AttachmentsController extends MembersController {

    public function __construct() {
        parent::__construct();

//        $this->_checkPermissions();
    }

    public function index() {
        $path = $this->relative_path_attachments_documents . 'shared/';
        // Establece los parametros que no necesariamente deben ser conocidos por el navegador por cuestiones de seguridad.
        FilesExplorerServer::setBaseDirFiles(path::dirPublicResources($path));
        FilesExplorerServer::setAllowedActions(['upload', 'addfolder', 'download', 'rename', 'move', 'delete']);

        $data['path_server_controller'] = path::urlDomain('/members/files');
        $data['path_layout'] = path::urlModules('/FilesExplorer/public/views/default.layout.html');
        $data['path_relative'] = '';
        // Define el token con el cual se asegura la sesion
        $data['token'] = FilesExplorerServer::generateToken();

        $this->_view($data);
    }

    private function _view($data) {
        $data['reference'] = 'Archivos comunes';
        $data['link_back'] = path::urlDomain('./');
        View::keep(path::appViews('/members/attachments.php'), $data, 'content');
    }

}
