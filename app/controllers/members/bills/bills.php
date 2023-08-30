<?php

class BillsController extends MembersController {

    protected $list_purchase_orders = array();
    protected $list_providers = array();
    protected $list_materials = array();
    
    public function __construct() {
        parent::__construct();
    }

    public function loadLists() {
        $purchase_orders = $this->_Model->listPurchaseOrders(array(
            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'))
        );
        foreach ($purchase_orders as $row) {
            $this->list_purchase_orders[] = array(
                'id' => $row['id_purchase_order'],
                "columns" => array($row['number'],
                    $row['provider_name'])
            );
        }

        $providers = $this->_Model->listProviders(array(
            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'))
        );
        foreach ($providers as $provider) {
            $this->list_providers[] = array('id' => $provider['id_provider'],
                'columns' => array(
                    $provider['name'], $provider['rut'])
            );
        }

        if (isset($this->_id_bill)) {
            $materials = $this->_Model->listMaterials(array(
                'id_bill' => $this->_id_bill)
            );
            foreach ($materials as $row) {
                $this->list_materials[] = array(
                    'id' => $row['id_purchase_order_detail'],
                    'columns' => array(
                        $row['name'],
                        $row['stock'],
                        $row['abbreviation'],
                        $row['ea_name']
                    )
                );
            }
        }
    }

    protected function _checkLists() {
        $errors = array();
        if (is_empty($this->list_purchase_orders)) {
            $errors[] = 'No se encontro ninguna lista de ordenes de compra';
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

    protected function _isBlocked() {
        if ($this->_bill['locked']) {
            $errors = array();
            $errors[] = 'El recurso se encuentra bloqueado.';
            $MsgBox = new MsgBox();
            $MsgBox->setEvent('warning');
            $MsgBox->setMessage('No se ha podido completar la accion debido a los siguientes errores.');
            $MsgBox->setItems($errors);
            $MsgBox->saveInSession();
            unset($MsgBox);
            redirect(path::urlDomain('./'));
        }
    }
}
