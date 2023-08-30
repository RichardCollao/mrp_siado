<?php

class EditController extends DetailsOrdersController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new EditModel();
        $this->_id_detail = (int) DecomposeUrl::getArgument(0);

        $this->_detail = $this->_Model->loadDetail(array(
            'id_purchase_order_detail' => $this->_id_detail
        ));
        $this->_details = $this->_Model->loadDetails(array(
            'fk_id_purchase_order' => $this->_detail['fk_id_purchase_order'],
            'id_detail' => $this->_id_detail
        ));
        $this->_purchase_order = $this->_Model->loadPurchaseOrder(array(
            'id_purchase_order' => $this->_detail['fk_id_purchase_order']
        ));

        $this->_id_purchase_order = $this->_detail['fk_id_purchase_order'];

        $this->_checkEstablishment($this->_detail['fk_id_establishment'], './../');
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

        $data = $this->_detail;
        $data['purchase_order'] = $this->_purchase_order;
        $data['rows'] = $this->_details;
        $this->_view($data);
    }

    private function _send($data) {
        $errors = $this->_validateForm($data);

        if (is_empty($errors)) {
            $values = array(
                'id_purchase_order_detail' => $this->_id_detail,
                'fk_id_material' => $data['fk_id_material'],
                'code' => $data['code'],
                'quantity' => $data['quantity'],
                'value' => $data['value']
            );
            if ($this->_Model->editItem($values)) {
                redirect(path::urlDomain('./' . $this->_id_purchase_order));
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
            'fk_id_material' => trim($_POST['fk_id_material']),
            'code' => trim($_POST['code']),
            'quantity' => trim($_POST['quantity']),
            'value' => trim($_POST['value'])
        );
    }

    private function _validateForm($data) {
        extract($data);
        $errors = array();
        /**
          if (!array_key_exists($fk_id_material, $this->list_materials)) {
          $errors[] = 'El material no existe.';
          }
         */
        if (!is_empty($code)) {
            if (!preg_match('/^[0-9a-z\.\-\_\s]+$/i', $code)) {
                $errors[] = 'EL campo Code no es valido';
            }
        }
        
        if ($quantity <= 0) {
            $errors[] = 'Debe ingresar una cantidad mayor a 0';
        } elseif (!preg_match('/^[0-9]*(\.[0-9]+)?$/', $quantity)) {
            $errors[] = 'EL campo Cantidad no es valido';
        }

        if ($value <= 0) {
            $errors[] = 'Debe ingresar un valor mayor a 0';
        } elseif (!preg_match('/^[0-9]*(\.[0-9]+)?$/', $value)) {
            $errors[] = 'EL campo Valor no es valido';
        }
        return $errors;
    }

    private function _view($data) {
        $data['action_form'] = path::urlDomain('./edit/' . $this->_id_detail);
        $data['json_list_materials'] = ForceObjToArray($this->list_materials);
        $data['link_edit'] = path::urlDomain('./edit/');
        $data['link_delete_item'] = path::urlDomain('./delete/');
        $data['link_finish'] = path::urlDomain('./../');
        View::keep(path::appViews('./edit.php'), $data, 'content');
    }

}
