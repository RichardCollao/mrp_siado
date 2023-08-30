<?php

class MaterialsController extends MembersController {

    protected $list_measures;
    protected $list_expense_accounts;

    public function __construct() {
        parent::__construct();
    }

    public function loadLists() {
        $this->list_materials = $this->_Model->listMaterials(array(
            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT')));

        $measures = $this->_Model->listMeasures(array(
            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT')));
        // Construye el objeto que contiene las opciones del select 
        foreach ($measures as $measure) {
            $this->list_measures[] = array(
                'id' => $measure['id_measure'],
                'columns' => array(utf8_encode($measure['abbreviation']),
                    utf8_encode($measure['terminology']))
            );
        }

        $expense_accounts = $this->_Model->listExpenseAccounts(array(
            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT')));
        // Construye el objeto que contiene las opciones del select 
        foreach ($expense_accounts as $expense_account) {
            $this->list_expense_accounts[] = array(
                'id' => $expense_account['id_expense_account'],
                'columns' => array($expense_account['number'],
                    utf8_encode($expense_account['name']))
            );
        }
    }

    protected function _checkLists() {
        $errors = array();
        if (is_empty($this->list_measures)) {
            $errors[] = 'No se encontro ninguna lista de unidades de medida';
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
