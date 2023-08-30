<?php

class AjaxUXController extends MembersController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new AjaxUXModel();
    }

    public function index() {
        if (constant('AUTHENTICATED') !== TRUE) {
            return;
        }

        // RECORDAR !!! SANITIZAR VARIABLE POST
        $data = $_POST;

        // $data["action"] = "loadDestination";
        // $data["action"] = "loadRequesting";
        // $data["str"] = "juan";

        $action = $data["action"];
        if (is_callable(array($this, $action))) {
            $this->$action($data);
        } else {
            throw new Exception("Action no callable");
        }
    }

    private function loadRequesting($data) {
        $values = Array(
            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'),
            'str' => $data['str']
        );

        $result = $this->_Model->loadRequesting($values);
        $list = array();
        foreach ($result as $row) {
            $list[] = $row['user_name_requesting'];
        }
        $this->_view($list);
    }

    private function loadDestination($data) {
        $values = Array(
            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'),
            'str' => $data['str']
        );

        $result = $this->_Model->loadDestination($values);
        $list = array();
        foreach ($result as $row) {
            $list[] = $row['destination'];
        }
        $this->_view($list);
    }

    private function _view($data) {
        /* Limpiamos el búfer */
        ob_end_clean();
        header('Content-Type: application/json');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

}
