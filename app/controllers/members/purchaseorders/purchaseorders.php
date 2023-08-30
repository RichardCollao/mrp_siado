<?php

class PurchaseOrdersController extends MembersController {

    protected $list_providers = array();
    protected $list_materials = array();
    protected $root_attachments;

    public function __construct() {
        parent::__construct();
    }

    public function loadLists() {
        $providers = $this->_Model->listProviders(array(
            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'))
        );

        foreach ($providers as $provider) {
            $this->list_providers[] = array(
                'id' => $provider['id_provider']
                , "columns" => array($provider['name'], $provider['rut'])
            );
        }

        $materials = $this->_Model->listMaterials(array(
            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'))
        );
        foreach ($materials as $material) {
            $this->list_materials[] = array(
                'id' => $material['id_material']
                , "columns" => array(
                    $material['name'],
                    $material['abbreviation'],
                    $material['ea_name']
                )
            );
        }
        $this->list_divisa = array('CLP', 'USD', 'EUR');
    }

    protected function _checkLists() {
        $errors = array();
        if (is_empty($this->list_providers)) {
            $errors[] = 'No se encontro ninguna lista de proveedores';
        }
        if (is_empty($this->list_materials)) {
            $errors[] = 'No se encontro ninguna lista de materiales';
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
        if ($this->_purchase_order['locked']) {
            $errors = array();
            $errors[] = 'El recurso se encuentra bloqueado.';
            $MsgBox = new MsgBox();
            $MsgBox->setEvent('warning');
            $MsgBox->setMessage('No se ha podido completar la accion debido a los siguientes errores.');
            $MsgBox->setItems($errors);
            $MsgBox->saveInSession();
            unset($MsgBox);

            redirect(path::urlDomain('./../'));
        }
    }

}
