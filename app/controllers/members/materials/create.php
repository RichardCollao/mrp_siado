<?php

class CreateController extends MaterialsController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new CreateModel();

        $this->_checkPermissions();
        $this->loadLists();
        $this->_checkLists();
    }

    public function index() {
        if (!is_empty($_POST)) {
            $data = $this->_loadDataFromPost();
            $this->_send($data);
        } else {
            $data = array();
        }
        $this->_view($data);
    }

    private function _send($data) {
        $errors = $this->_validateForm($data);

        if (is_empty($errors)) {
            $values = Array(
                'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'),
                'fk_id_measure' => $data['fk_id_measure'],
                'fk_id_expense_account' => $data['fk_id_expense_account'],
                'name' => $data['name'],
                'critical_stock' => $data['critical_stock']
            );

            if ($this->_Model->createMaterial($values)) {
                $MsgBox = new MsgBox();
                $MsgBox->setEvent('success');
                $MsgBox->setMessage('La operacion solicitada se ha realizado satisfactoriamente.');
                $MsgBox->setItems($errors);
                $MsgBox->saveInSession();
                unset($MsgBox);

                redirect(path::urlDomain('./'));
            } else {
                $errors[] = 'Se produjo un error en la base de datos';
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
            'name' => trim($_POST['name']),
            'fk_id_measure' => trim($_POST['fk_id_measure']),
            'fk_id_expense_account' => trim($_POST['fk_id_expense_account']),
            'critical_stock' => $_POST['critical_stock']
        );
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
          if (!array_key_exists($id_measure, $this->list_measures)) {
          $errors[] = 'La unidad de medida no existe.';
          }

          if (!array_key_exists($id_expense_account, $this->list_expense_accounts)) {
          $errors[] = 'La unidad de medida no existe.';
          }
         * */
        return $errors;
    }

    private function _view($data) {
        $data['action_form'] = path::urlDomain('./create');
        $data['list_materials'] = $this->list_materials;
        $data['json_list_measures'] = ForceObjToArray($this->list_measures);
        $data['json_list_expense_accounts'] = ForceObjToArray($this->list_expense_accounts);

        View::keep(path::appViews('./create.php'), $data, 'content');
    }

}
