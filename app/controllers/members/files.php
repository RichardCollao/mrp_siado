<?php

class FilesController extends MembersController {

    public function __construct() {
        parent::__construct();
        require_once(path::dirPublicModules('/FilesExplorer/class/FilesExplorerServer.php'));
        die();
    }

    public function index() {
        // ...
    }


}
