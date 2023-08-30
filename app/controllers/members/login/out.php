<?php

class OutController extends LoginController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $_SESSION['session_id'] = array();
        // Aqui va un aviso pasado por sesion
        redirect(Path::urlDomain('./'));
    }

}
