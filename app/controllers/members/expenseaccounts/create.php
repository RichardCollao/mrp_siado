<?php

class CreateController extends ExpenseAccountsController {

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
                'id_expense_account' => 0,
                'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'),
                'number' => $data['number'],
                'name' => $data['name']
            );

            if (!is_empty($this->_Model->existAccountNumber($values))) {
                $errors[] = 'El número de la cuenta de costo ya existe';
            } elseif (!is_empty($this->_Model->existAccountName($values))) {
                $errors[] = 'El nombre de la cuenta de costo ya existe';
            } elseif ($this->_Model->createExpenseAccount($values)) {
                $MsgBox = new MsgBox();
                $MsgBox->setEvent('success');
                $MsgBox->setMessage('La operacion solicitada se ha realizado satisfactoriamente.');
                $MsgBox->saveInSession();
                unset($MsgBox);

                redirect(path::urlDomain('./'));
            }
        }

        // Mensaje
        $MsgBox = new MsgBox();
        $MsgBox->setEvent('warning');
        $MsgBox->setMessage('No se ha podido completar la accion debido a los siguientes errores.');
        $MsgBox->setItems($errors);
        $MsgBox->saveInSession();
        unset($MsgBox);
    }

    // Obtiene los valores para los campos desde el array $_POST.
    private function _loadDataFromPost() {
        return array(
            'number' => trim($_POST['number']),
            'name' => trim($_POST['name'])
        );
    }

    private function _validateForm($data) {
        extract($data);
        $errors = array();
        if (!preg_match('/^[0-9a-z\.\-\_\s]+$/i', $number)) {
            $errors[] = 'El campo "<b>Número de cuenta</b>" no es valido.';
        }
        
        if (strlen($name) < 3 || strlen($name) > 128) {
            $errors[] = 'El campo <b>Nombre de cuenta</b> debe contener entre 3 y 128 carateres';
        }

        return $errors;
    }

    private function _view($data) {
        $data['action_form'] = path::urlDomain('./create');

        View::keep(path::appViews('./create.php'), $data, 'content');
    }

}
