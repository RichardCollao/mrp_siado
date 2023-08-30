<?php

class ControllerNotFound extends AdministrationMod
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->notice('notice_invalid_link', array());
    }
}

?>