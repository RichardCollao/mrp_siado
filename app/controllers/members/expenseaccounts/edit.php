<?php

class EditController extends ExpenseAccountsController {

    private $_id_expense_account;
    private $_expense_account;

    public function __construct() {
        parent::__construct();

        $this->_Model = new EditModel();

        $this->_id_expense_account = (int) DecomposeUrl::getArgument(0);
        $this->_expense_account = $this->_Model->loadExpenseAccount(
                array('fk_id_establishment' => constant('AUTH_ESTABLISHMENT'),
                    'id_expense_account' => $this->_id_expense_account));

        $this->_checkEstablishment($this->_expense_account['fk_id_establishment']);
        $this->_checkPermissions();
    }

    public function index() {
        if (!is_empty($_POST)) {
            $data = $this->_loadDataFromPost();
            $this->_send($data);
        } else {
            $data = $this->_expense_account;
        }

        $this->_view($data);
    }

    private function _send($data) {
        $errors = $this->_validateForm($data);

        if (is_empty($errors)) {
            $values = array(
                'id_expense_account' => $this->_id_expense_account,
                'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'),
                'number' => $data['number'],
                'name' => $data['name']
            );

            if (!is_empty($this->_Model->existAccountNumber($values))) {
                $errors[] = 'El número de la cuenta de costo ya existe';
            } elseif (!is_empty($this->_Model->existAccountName($values))) {
                $errors[] = 'El nombre de la cuenta de costo ya existe';
            } elseif ($this->_Model->editExpenseAccount($values)) {
                // Mensaje
                $MsgBox = new MsgBox();
                $MsgBox->setEvent('success');
                $MsgBox->setMessage('La operacion solicitada se ha realizado satisfactoriamente.');
                $MsgBox->saveInSession();
                unset($MsgBox);

                // Redireciona a la pagina principal.
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
        $data['action_form'] = path::urlDomain('./edit/' . $this->_id_expense_account);

        View::keep(path::appViews('./edit.php'), $data, 'content');
    }

}
