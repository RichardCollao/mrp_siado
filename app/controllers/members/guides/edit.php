<?php

class EditController extends GuidesController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new EditModel();
        $this->_id_guide = (int) DecomposeUrl::getArgument(0);
        $this->_guide = $this->_Model->loadGuide(array(
            'id_guide' => $this->_id_guide)
        );

        $this->_checkEstablishment($this->_guide['fk_id_establishment']);
        $this->_checkPermissions();
        $this->_isBlocked();
        $this->loadLists();
        $this->_checkLists();
    }

    public function index() {
        if (!is_empty($_POST)) {
            $data = $this->_loadDataFromPost();
            $this->_send($data);
        } else {
            $data = $this->_guide;
        }

        $this->_view($data);
    }

    private function _send($data) {
        $errors = $this->_validateForm($data);

        if ($this->_guide['count_items'] > 0 && $data['fk_id_purchase_order'] != $this->_guide['fk_id_purchase_order']) {
            $errors[] = 'No se pude modificar el número de orden de compra cuando ya se han asociado materiales.';
        }

        if (is_empty($errors)) {
            $values = array(
                'id_guide' => $this->_id_guide,
                'fk_id_purchase_order' => $data['fk_id_purchase_order'],
                'number' => $data['number'],
                'issue_date' => $data['issue_date'],
                'created_at' => constant('FW_DATETIME_CURRENT'),
                'observation' => $data['observation'],
                'status' => 'correct'
            );

            if (!is_empty($this->_Model->duplicateNumber($values))) {
                $errors[] = 'El número de guía ya existe';
            } elseif ($this->_Model->editGuide($values)) {

                $MsgBox = new MsgBox();
                $MsgBox->setEvent('success');
                $MsgBox->setMessage('La operacion solicitada se ha realizado satisfactoriamente.');
                $MsgBox->setItems($errors);
                $MsgBox->saveInSession();
                unset($MsgBox);

                redirect(path::urlDomain('./'));
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
        $data['action_form'] = path::urlDomain('./edit/' . $this->_id_guide);
        $data['json_list_purchase_orders'] = ForceObjToArray($this->list_purchase_orders);
        View::keep(path::appViews('./edit.php'), $data, 'content');
    }

}
