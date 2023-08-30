<?php

class IndexController extends InstallController
{
    public function __construct()
    {
        parent::__construct();

        #require_once ($this->_DIR_MODELS . 'index.php');

        #$this->_Model = new IndexModel();
    }

    public function index()
    {
        $this->_view(array());
    }

    private function _view($data)
    {
        $data['link_next'] = path::urlDomain('./checkenvironmental');
        // Llama al script que contiene la vista
        View::keep(path::appViews('./index.php'), $data, 'content');
    }
}