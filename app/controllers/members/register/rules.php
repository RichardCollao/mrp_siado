<?php

class Rules extends Register
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->_checkUrl();
        $this->_view();
    }

    public function _view()
    {
        $data = array();
        $data['action_form']    = Url::link('register/');
        $data['url_base']       = url::tag('', '<b>aqui</b>');

        View::keep('register' . DS . 'rules', $data, 'content');
    }
}

?>