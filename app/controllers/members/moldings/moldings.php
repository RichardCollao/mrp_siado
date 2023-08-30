<?php

class MoldingsController extends MembersController {

    public function __construct() {
        parent::__construct();
    }

    public function loadLists() {

        $expense_accounts = $this->_Model->listExpenseAccounts(array(
            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT')));
        // Construye el objeto que contiene las opciones del select 
        foreach ($expense_accounts as $expense_account) {
            $this->list_expense_accounts[] = array('id' => $expense_account['id_expense_account'], 'columns' =>
                array($expense_account['number'], utf8_encode($expense_account['name']))
            );
        }

        $providers = $this->_Model->listProviders(array(
            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'))
        );
        foreach ($providers as $provider) {
            $this->list_providers[] = array(
                'id' => $provider['id_provider']
                , "columns" => array($provider['name'], $provider['rut'])
            );
        }
        
        
    }

    protected function _checkLists() {
        $errors = array();
        if (is_empty($this->list_providers)) {
            $errors[] = 'No se encontro ninguna lista de proveedores';
        }
        
        if (is_empty($this->list_expense_accounts)) {
            $errors[] = 'No se encontro ninguna lista de cuentas de costos';
        }

        if (!is_empty($errors)) {
            $MsgBox = new MsgBox();

            $MsgBox->setEvent('info');
            $MsgBox->setMessage('Antes de continuar primero debe corregir los siguientes errores.');
            $MsgBox->setItems($errors);
            $MsgBox->saveInSession();
            unset($MsgBox);

            redirect(path::urlDomain('./'));
        }
    }

}
