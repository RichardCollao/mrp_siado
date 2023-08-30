<?php

class DeleteController extends UsersController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new DeleteModel();

        $this->_id_user = (int) DecomposeUrl::getArgument(0);
        $this->_user = $this->_Model->loadUser(array(
            'id_user' => $this->_id_user)
        );
    }

    public function index() {
        $this->_send($this->_user);
    }

    private function _validate($data) {
        extract($data);
        $errors = array();

        if (is_empty($this->_user)) {
            $errors[] = 'El elemento seleccionado no existe';
        } else {
            if ($this->_user['type_user'] === 'super_admin') {
                $errors[] = 'No esta permitido eliminar la cuenta de super administrador';
            }
        }

        return $errors;
    }

    private function _send($data) {

        $errors = $this->_validate($data);

        if (is_empty($errors)) {
            $values = array(
                'id_user' => $this->_id_user
            );

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
