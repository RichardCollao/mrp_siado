<?php

class EstablishmentsAssociatedController extends LoginController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new EstablishmentsAssociatedModel();
    }

    public function index() {
        $data = array();
        if (!is_empty($_POST)) {
            $mail = trim($_POST['mail']);
            $data['establishments'] = $this->_loadDataBase(array('mail' => $mail));
        }
        $this->_view($data);
    }

    private function _loadDataBase($data) {
        // $errors = $this->_validateForm($data);
        $errors = array();
        if (is_empty($errors)) {
            $values = Array(
                'mail' => $data['mail'],
                'state_acount' => 'active'
            );
            return $this->_Model->getEstablishments($values);
        }
    }

    private function _view($data) {
        /* Limpiamos el búffer */
        ob_end_clean();
//        header("Content-type: application/json; charset=utf-8");
         header('Content-Type: application/json');
         echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

}
