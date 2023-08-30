<?php

class PiecesController extends MoldingsController {

    protected $list_measures;
    protected $list_expense_accounts;

    public function __construct() {
        parent::__construct();
    }

    public function loadLists() {
        // ...
    }

    protected function _checkLists() {
        // ...
    }

}
