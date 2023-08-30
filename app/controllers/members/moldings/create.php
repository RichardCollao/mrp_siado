<?php

class CreateController extends MoldingsController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new CreateModel();

        #$this->_checkPermissions();
        $this->loadLists();
        $this->_checkLists();
    }

    public function index() {
        if (!is_empty($_POST)) {
            $data = $this->_loadDataFromPost();
            $this->_send($data);
        } else {
            $data = $this->_loadDataDefault();
        }
        $this->_view($data);
    }

    private function _send($data) {
        $errors = $this->_validateForm($data);

        if (is_empty($errors)) {
            $values = Array(
                'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'),
                'fk_id_provider' => $data['fk_id_provider'],
                'fk_id_expense_account' => $data['fk_id_expense_account'],
                'name' => $data['name']
            );

            
            if ($this->_Model->createMoldings($values)) {
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
            'fk_id_provider' => trim($_POST['fk_id_provider']),
            'fk_id_expense_account' => trim($_POST['fk_id_expense_account'])
        );
    }

    private function _loadDataDefault() {
        return array(
            'number' => '',
            'fk_id_provider' => 0,
            'fk_id_expense_account' => 0,
        );
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
        $data['json_list_providers'] = ForceObjToArray($this->list_providers);
        $data['json_list_expense_accounts'] = ForceObjToArray($this->list_expense_accounts);
        View::keep(path::appViews('./create.php'), $data, 'content');
    }

}
