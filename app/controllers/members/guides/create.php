<?php

class CreateController extends GuidesController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new CreateModel();

        $this->_checkPermissions();
        $this->loadLists();
        $this->_checkLists();
    }

    public function index() {
        if (!is_empty($_POST)) {
            $data = $this->_loadDataFromPost();
            $this->_send($data);
        } else {
            $data = $this->_loadDataDefault();
        }

        $this->_view($data);
    }

    private function _send($data) {
        $errors = $this->_validateForm($data);

        if (is_empty($errors)) {
            $values = array(
                'id_guide' => 0,
                'fk_id_purchase_order' => $data['fk_id_purchase_order'],
                'number' => $data['number'],
                'issue_date' => $data['issue_date'],
                'created_at' => constant('FW_DATETIME_CURRENT'),
                'observation' => $data['observation'],
                'status' => 'correct'
            );

            if (!is_empty($this->_Model->duplicateNumber($values))) {
                $errors[] = 'El número de guía ya existe para este proveedor';
            } elseif ($this->_Model->createGuide($values)) {
                redirect(path::urlDomain('./details/' . $this->_Model->getLastInsertId()));
            }
        }

        $MsgBox = new MsgBox();
        $MsgBox->setEvent('warning');
        $MsgBox->setMessage('No se ha podido completar la accion debido a los siguientes errores.');
        $MsgBox->setItems($errors);
        $MsgBox->saveInSession();
        unset($MsgBox);
    }

    private function _loadDataFromPost() {
        return array(
            'number' => trim($_POST['number']),
            'fk_id_purchase_order' => (int) $_POST['fk_id_purchase_order'],
            'issue_date' => trim($_POST['issue_date']),
            'observation' => trim($_POST['observation'])
        );
    }

    private function _loadDataDefault() {
        return array(
            'number' => '',
            'fk_id_purchase_order' => 0,
            'issue_date' => constant('FW_DATE_CURRENT'),
            'observation' => ''
        );
    }

    private function _validateForm($data) {
        extract($data);
        $errors = array();
        if (!preg_match('/^[0-9a-z\.\-\_\s]+$/i', $number)) {
            $errors[] = 'EL campo Número no es valido';
        }
        
        /**
          if (!array_key_exists($fk_id_purchase_order, $this->list_purchase_orders)) {
          $errors[] = 'El provedor no existe.';
          }
         */
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $issue_date)) {
            $errors[] = 'EL campo fecha no es valido, utilice el siguiente formato 2016-12-25';
        } elseif (!checkRealDate($issue_date)) {
            $errors[] = 'La fecha ingresada es invalida';
        }

        if (!is_empty($observation)) {
            if (Validate::observation($observation) !== true) {
                $errors[] = 'El campo <b>Observación</b> no es valido';
            }
        }

        return $errors;
    }

    private function _view($data) {
        $data['action_form'] = path::urlDomain('./create');
        $data['json_list_purchase_orders'] = ForceObjToArray($this->list_purchase_orders);
        View::keep(path::appViews('./create.php'), $data, 'content');
    }

}
