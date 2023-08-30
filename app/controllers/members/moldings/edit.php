<?php

class EditController extends MoldingsController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new EditModel();
        $this->_id_molding = (int) DecomposeUrl::getArgument(0);
        $this->_molding = $this->_Model->loadMolding(array(
            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'),
            'id_molding' => $this->_id_molding
        ));

        #$this->_checkPermissions();
        $this->loadLists();
        $this->_checkLists();
    }

    public function index() {
        if (!is_empty($_POST)) {
            $data = $this->_loadDataFromPost();
            $this->_send($data);
        } else {
            $data = $this->_molding;
        }
        $this->_view($data);
    }

    private function _send($data) {
        $errors = $this->_validateForm($data);

        if (is_empty($errors)) {
            $values = Array(
                'id_molding' => $this->_id_molding,
                'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'),
                'fk_id_provider' => $data['fk_id_provider'],
                'fk_id_expense_account' => $data['fk_id_expense_account'],
                'name' => $data['name']
            );

            if ($this->_Model->editMolding($values)) {
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
        $data = array(
            'name' => trim($_POST['name']),
            'fk_id_provider' => trim($_POST['fk_id_provider']),
            'fk_id_expense_account' => trim($_POST['fk_id_expense_account'])
        );
        return $data;
    }

    private function _validateForm($data) {
        extract($data);
        $errors = array();

        if (!preg_match('/[0-9a-zñ \/\-_"\#\$]+/i', $name)) {
            $errors[] = 'El nombre del tipo de moldaje no es valido';
        } elseif (strlen($name) > 128) {
            $errors[] = 'El nombre del tipo de moldaje no debe superar los 128 carateres';
        } elseif (strlen($name) < 3) {
            $errors[] = 'El nombre del tipo de moldaje no debe tener menos de 3 carateres';
        }
        /**
          if (!array_key_exists($fk_id_measure, $this->list_measures)) {
          $errors[] = 'Unidad de medida inexistente.';
          }

          if (!array_key_exists($fk_id_expense_account, $this->list_expense_accounts)) {
          $errors[] = 'Cuenta de costo inexistente.';
          }
         */
        return $errors;
    }

    private function _view($data) {
        $data['action_form'] = path::urlDomain('./edit/' . $this->_id_molding);
        $data['json_list_providers'] = ForceObjToArray($this->list_providers);
        $data['json_list_expense_accounts'] = ForceObjToArray($this->list_expense_accounts);

        View::keep(path::appViews('./edit.php'), $data, 'content');
    }

}
