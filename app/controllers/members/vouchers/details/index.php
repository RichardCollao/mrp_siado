<?php

class IndexController extends DetailsController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new IndexModel();
        $this->_id_voucher = (int) DecomposeUrl::getArgument(0);
        $this->_voucher = $this->_Model->loadVoucher(array(
            'id_voucher' => $this->_id_voucher)
        );
        $this->_details = $this->_Model->loadDetails(array(
            'fk_id_voucher' => $this->_id_voucher)
        );

        $this->_checkEstablishment($this->_voucher['fk_id_establishment']);
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

        $data['voucher'] = $this->_voucher;
        $data['rows'] = $this->_details;

        $this->_view($data);
    }

    private function _send($data) {
        
        $errors = $this->_validateForm($data);
        if ($data['quantity'] > $this->list_materials[$data['fk_id_material']]['stock']) {
            $errors[] = 'Esta intentando ingresar una cantidad mayor al stock disponible.';
        }

        if (is_empty($errors)) {
            $values = array(
                'fk_id_voucher' => $this->_id_voucher,
                'fk_id_material' => $data['fk_id_material'],
                'quantity' => $data['quantity']
            );

            if ($this->_Model->addItem($values)) {
                redirect(path::urlDomain('./' . $this->_id_voucher));
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
            'quantity' => trim($_POST['quantity'])
        );
    }

    private function _loadDataDefault() {
        return array(
            'fk_id_material' => 1,
            'quantity' => 1
        );
    }

    private function _validateForm($data) {
        extract($data);
        $errors = array();
        /**
          if (!array_key_exists($fk_id_material, $this->list_materials)) {
          $errors[] = 'El material no existe o no pertenece a la orden de compra.';
          }
         */
        if ($quantity <= 0) {
            $errors[] = 'Debe ingresar una cantidad mayor a 0';
        } elseif (!preg_match('/^[0-9]*(\.[0-9]+)?$/', $quantity)) {
            $errors[] = 'EL campo Cantidad no es valido';
        }
        return $errors;
    }

    private function _view($data) {
        $data['stock'] = is_empty($this->list_materials_with_stock) ? false : true;
        $data['action_form'] = path::urlDomain('./' . $this->_id_voucher);
        $data['link_edit'] = path::urlDomain('./edit/');
        $data['json_list_materials_with_stock'] = ForceObjToArray($this->list_materials_with_stock);

        $data['link_delete_item'] = path::urlDomain('./delete/');
        $data['link_finish'] = path::urlDomain('./../');
        View::keep(path::appViews('./index.php'), $data, 'content');
    }

}
