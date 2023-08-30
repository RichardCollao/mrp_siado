<?php

class DeleteController extends ProvidersController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new DeleteModel();

        $this->_id_provider_contact = (int) DecomposeUrl::getArgument(0);
        $this->_provider_contact = $this->_Model->loadProviderContact(array(
            'id_provider_contact' => $this->_id_provider_contact
        ));
        $this->_provider = $this->_Model->loadProvider(array(
            'id_provider' => $this->_provider_contact['fk_id_provider']
        ));

        $this->_checkEstablishment($this->_provider['fk_id_establishment']);
        $this->_checkPermissions();
    }

    public function index() {
        $this->_send($this->_provider);
    }

    private function _send($data) {
        $errors = array();
        $values = array(
            'id_provider_contact' => $this->_id_provider_contact
        );

        if (is_empty($this->_provider_contact)) {
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

                redirect(path::urlDomain('./' . $this->_provider_contact['fk_id_provider']));
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
