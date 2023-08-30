<?php

class PermissionsController extends UsersController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new PermissionsModel();

        $this->_id_user = (int) DecomposeUrl::getArgument(0);
        $this->_user = $this->_Model->loadUser(array(
            'id_user' => $this->_id_user)
        );

        $this->_user_permission = $this->_Model->loadUserPermission(array(
            'fk_id_user' => $this->_id_user
        ));

        $this->_checkEstablishment($this->_user['fk_id_establishment']);
        $this->_checkPermissions();
    }

    public function index() {
        if (!is_empty($_POST)) {
            $data = $this->_loadDataFromPost();
            $this->_send($data);
        } else {
            $data['permissions'] = array();
            if (!is_empty($this->_user_permission['permissions'])) {
                $data['permissions'] = explode(';', $this->_user_permission['permissions']);
            }
        }

        $this->_view($data);
    }

    private function _send($data) {
        $errors = $this->_validateForm($data);

        if (is_empty($errors)) {
            $values = array(
                'fk_id_user' => $this->_id_user,
                'permissions' => implode(';', (Array) $data['permissions'])
            );
            if ($this->_Model->editUserPermission($values)) {

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
    }

    private function _loadDataFromPost() {
        return array(
            'permissions' => array_keys((Array) $_POST['permissions'])
        );
    }

    private function _validateForm($data) {
        extract($data);
        $errors = array();

        return $errors;
    }

    private function _view($data) {
        $data['action_form'] = path::urlDomain('./permissions/' . $this->_id_user);
        // list_permissions es un recurso de la capa configs
        $data['list_permissions'] = $this->PermissionsHandler->getArrayPermissions();
//        Debug::printRF($this->list_permissions);
        $data['user_name'] = $this->_user['name'];
        View::keep(path::appViews('./permissions.php'), $data, 'content');
    }

}
