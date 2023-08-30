<?php

class EditController extends MaterialsController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new EditModel();
        $this->_id_material = (int) DecomposeUrl::getArgument(0);
        $this->_material = $this->_Model->loadMaterial(array(
            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'),
            'id_material' => $this->_id_material)
        );

        $this->_checkEstablishment($this->_material['fk_id_establishment']);
        $this->_checkPermissions();
        $this->loadLists();
        $this->_checkLists();
    }

    public function index() {
        if (!is_empty($_POST)) {
            $data = $this->_loadDataFromPost();
            $this->_send($data);
        } else {
            $data = $this->_material;
        }
        $this->_view($data);
    }

    private function _send($data) {
        $errors = $this->_validateForm($data);

        if (is_empty($errors)) {
            $values = Array(
                'id_material' => $this->_id_material,
                'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'),
                'fk_id_measure' => $data['fk_id_measure'],
                'fk_id_expense_account' => $data['fk_id_expense_account'],
                'name' => $data['name'],
                'critical_stock' => $data['critical_stock']
            );

            if ($this->_Model->editMaterial($values)) {
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
            'fk_id_measure' => trim($_POST['fk_id_measure']),
            'fk_id_expense_account' => trim($_POST['fk_id_expense_account']),
            'critical_stock' => $_POST['critical_stock']
        );
        return $data;
    }

    private function _validateForm($data) {
        extract($data);
        $errors = array();

        if (!preg_match('/[0-9a-zñ \/\-_"\#\$]+/i', $name)) {
            $errors[] = 'El nombre del material no es valido';
        } elseif (strlen($name) > 128) {
            $errors[] = 'El nombre del material no debe superar los 128 carateres';
        } elseif (strlen($name) < 3) {
            $errors[] = 'El nombre del material no debe tener menos de 3 carateres';
        }

        if (validate::numberDecimal($critical_stock, 'stock critico') !== true) {
            $errors[] = validate::numberDecimal($critical_stock, 'stock critico');
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
        $data['action_form'] = path::urlDomain('./edit/' . $this->_id_material);
        $data['list_materials'] = $this->list_materials;
        $data['json_list_measures'] = ForceObjToArray($this->list_measures);
        $data['json_list_expense_accounts'] = ForceObjToArray($this->list_expense_accounts);

        View::keep(path::appViews('./edit.php'), $data, 'content');
    }

}
