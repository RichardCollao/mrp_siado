<?php

class Welcome extends Login {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if (constant('AUTHENTICATED') !== TRUE)
            redirect(Path::dir('#sessions_conflicts'));
    }

    /*
     * Sobreescribe el metodo showPage()
     */
    public function showPage() {
        View::setLayout(path::appViews('welcome'));
        Header::addSheetsCss('css/general.css', TRUE);
        Header::addSheetsCss('css/reset.css', TRUE);
        View::callLayout();
        die();
    }

}