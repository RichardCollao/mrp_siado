<?php

class Fail extends Register
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

    public function _view($data = array())
    {
        $data['url_base'] = url::tag('', '<b>aqui</b>');

        View::keep('register' . DS . 'fail', $data, 'content');
    }
}

?>