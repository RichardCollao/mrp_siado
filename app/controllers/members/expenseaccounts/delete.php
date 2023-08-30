<?php

class DeleteController extends ExpenseAccountsController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new DeleteModel();

        $this->_id_expense_account = (int) DecomposeUrl::getArgument(0);
        $this->_expense_account = $this->_Model->loadExpenseAccount(array(
            'id_expense_account' => $this->_id_expense_account)
        );

        $this->_checkEstablishment($this->_expense_account['fk_id_establishment']);
        $this->_checkPermissions();
    }

    public function index() {
        $this->_send($this->_expense_account);
    }

    private function _send($data) {
        $errors = array();
        $values = array(
            'id_expense_account' => $this->_id_expense_account
        );

        if (is_empty($this->_expense_account)) {
            $errors[] = 'El elemento seleccionado no existe';
        } else {
            try {
                $this->_Model->delete($values);

                $MsgBox = new MsgBox();
                $MsgBox->setEvent('success');
                $MsgBox->setMessage('La operacion solicitada se ha realizado satisfactoriamente.');
                $MsgBox->setItems($errors);
                $MsgBox->saveInSession();
                unset($MsgBox);

                redirect(path::urlDomain('./'));
            } catch (Exception $e) {
                $errors[] = 'Este recurso no puede ser eliminado mientras este siendo utilizado.';
            }
        }

        $MsgBox = new MsgBox();
        $MsgBox->setEvent('warning');
        $MsgBox->setMessage('No se ha podido completar la accion debido a los siguientes errores.');
        $MsgBox->setItems($errors);
        $MsgBox->saveInSession();
        unset($MsgBox);

        redirect(path::urlDomain('./'));
    }

}
