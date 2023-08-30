<?php

class CreateController extends MeasuresController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new CreateModel();
        
        $this->_checkPermissions();
    }

    public function index() {
        if (!is_empty($_POST)) {
            $data = $this->_loadDataFromPost();
            $this->_send($data);
        } else {
            $data = array();
        }

        $this->_view($data);
    }

    private function _send($data) {
        $errors = $this->_validateForm($data);

        if (is_empty($errors)) {
            $values = array(
                'id_measure' => 0,
                'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'),
                'abbreviation' => $data['abbreviation'],
                'terminology' => $data['terminology']
            );
            if (!is_empty($this->_Model->duplicateAbbreviation($values))) {
                $errors[] = 'La abreviacion de la medida ya existe';
            } elseif ($this->_Model->createMeasure($values)) {
                // Mensaje
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
            'abbreviation' => trim($_POST['abbreviation']),
            'terminology' => trim($_POST['terminology'])
        );
    }

    private function _validateForm($data) {
        extract($data);
        $errors = array();
        if (!preg_match('/[a-z0-9\/]+/i', $abbreviation)) {
            $errors[] = 'La abreviacion de la medida no es valida';
        } elseif (strlen($abbreviation) > 16) {
            $errors[] = 'La abreviacion de la unidad de medida no debe superar los 16 carateres';
        }

        if (!preg_match('/[a-z0-9\/]+/i', $terminology)) {
            $errors[] = 'La terminologia de la unidad de medida no es valida';
        } elseif (strlen($terminology) > 32) {
            $errors[] = 'La terminologia de la unidad de medida no debe superar los 32 carateres';
        }
        return $errors;
    }

    private function _view($data) {
        $data['action_form'] = path::urlDomain('./create');

        View::keep(path::appViews('./create.php'), $data, 'content');
    }

}
