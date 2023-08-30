<?php

class IndexController extends DetailsController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new IndexModel();
        $this->_id_bill = (int) DecomposeUrl::getArgument(0);
        $this->_bill = $this->_Model->loadBill(array(
            'id_bill' => $this->_id_bill)
        );
        $this->_details = $this->_Model->loadDetails(array(
            'fk_id_bill' => $this->_id_bill)
        );

        $this->_checkEstablishment($this->_bill['fk_id_establishment']);
        $this->_checkPermissions();
        $this->_isBlocked();
        $this->loadLists();
        $this->_checkLists();
    }

    public function index() {
        if (!is_empty($_POST)) {
            $data = $this->_loadDataFromPost();
            $this->_send($data);
        }

        $data['bill'] = $this->_bill;
        $data['rows'] = $this->_details;
        $this->_view($data);
    }

    private function _send($data) {
        $errors = $this->_validateForm($data);

        if (is_empty($errors)) {
            $values = array(
                'fk_id_bill' => $this->_id_bill,
                'fk_id_purchase_order_detail' => $data['fk_id_purchase_order_detail'],
                'quantity' => $data['quantity'],
                'value' => $data['value']
            );

            if ($this->_Model->addItem($values)) {
                redirect(path::urlDomain('./' . $this->_id_bill));
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
            'fk_id_purchase_order_detail' => trim($_POST['fk_id_purchase_order_detail']),
            'quantity' => trim($_POST['quantity']),
            'value' => trim($_POST['value'])
        );
    }

    private function _loadDataDefault() {
        return array(
            'fk_id_material_purchase_order' => 1,
            'quantity' => 1,
            'value' => 0
        );
    }

    private function _validateForm($data) {
        extract($data);
        $errors = array();
        /**
          if (!array_key_exists($fk_id_purchase_order_detail, $this->list_materials)) {
          $errors[] = 'La unidad de medida no existe.';
          }
         */
        if ($quantity <= 0) {
            $errors[] = 'Debe ingresar una cantidad mayor a 0';
        } elseif (!preg_match('/^[0-9]*(\.[0-9]+)?$/', $quantity)) {
            $errors[] = 'EL campo Cantidad no es valido';
        }
        if (!preg_match('/^[1-9][0-9]*(\.[0-9]+)?$/', $value)) {
            $errors[] = 'EL campo Valor no es valido';
        }

        return $errors;
    }

    private function _view($data) {
        $data['action_form'] = path::urlDomain('./index/' . $this->_id_bill);
        $data['json_list_materials'] = ForceObjToArray($this->list_materials);
        $data['link_edit'] = path::urlDomain('./edit/');
        $data['link_delete_item'] = path::urlDomain('./delete/');
        $data['link_finish'] = path::urlDomain('./../');
        View::keep(path::appViews('./index.php'), $data, 'content');
    }

}
