<?php

class EditController extends MeasuresController {

    private $_id_measure;
    private $_measure;

    public function __construct() {
        parent::__construct();

        $this->_Model = new EditModel();

        $this->_id_measure = (int) DecomposeUrl::getArgument(0);
        $this->_measure = $this->_Model->loadMeasure(
                array('fk_id_establishment' => constant('AUTH_ESTABLISHMENT'),
                    'id_measure' => $this->_id_measure));

        $this->_checkEstablishment($this->_measure['fk_id_establishment']);
        $this->_checkPermissions();
    }

    public function index() {
        if (!is_empty($_POST)) {
            $data = $this->_loadDataFromPost();
            $this->_send($data);
        } else {
            $data = $this->_measure;
        }

        $this->_view($data);
    }

    private function _send($data) {
        $errors = $this->_validateForm($data);

        if (is_empty($errors)) {
            $values = array(
                'id_measure' => $this->_id_measure,
                'fk_id_establishment' => $this->_measure['fk_id_establishment'],
                'abbreviation' => $data['abbreviation'],
                'terminology' => $data['terminology']
            );

            if (!is_empty($this->_Model->duplicateAbbreviation($values))) {
                $errors[] = 'La abreviacion de la medida ya existe';
            } elseif ($this->_Model->editMeasure($values)) {

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
        #redirect(Path::urlDomain('./'));
    }

    private function _loadDataFromPost() {
        $data = array(
            'abbreviation' => trim($_POST['abbreviation']),
            'terminology' => trim($_POST['terminology'])
        );
        return $data;
    }

    private function _validateForm($data) {
        extract($data);
        $errors = array();
        if (!preg_match('/[a-z0-9\/]+/i', $abbreviation)) {
            $errors[] = 'La abreviacion de la medida no es valida';
        } elseif (count($abbreviation) > 16) {
            $errors[] = 'La abreviacion de la unidad de medida no debe superar los 16 carateres';
        }

        if (!preg_match('/[a-z0-9\/]+/i', $terminology)) {
            $errors[] = 'La terminologia de la unidad de medida no es valida';
        } elseif (count($terminology) > 32) {
            $errors[] = 'La terminologia de la unidad de medida no debe superar los 32 carateres';
        }
        return $errors;
    }

    private function _view($data) {
        $data['action_form'] = path::urlDomain('./edit/') . $this->_id_measure;

        // Prepara la vista
        View::keep(path::appViews('./edit.php'), $data, 'content');
    }

}
