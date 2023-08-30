<?php

class EditController extends DetailsController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new EditModel();
        $this->_id_detail = (int) DecomposeUrl::getArgument(0);

        $this->_detail = $this->_Model->loadDetail(array(
            'id_guide_detail' => $this->_id_detail
        ));
        $this->_details = $this->_Model->loadDetails(array(
            'id_guide_detail' => $this->_id_detail,
            'fk_id_guide' => $this->_detail['fk_id_guide']
        ));
        $this->_guide = $this->_Model->loadGuide(array(
            'id_guide' => $this->_detail['fk_id_guide']
        ));

        $this->_id_guide = $this->_detail['fk_id_guide'];

        $this->_checkEstablishment($this->_detail['fk_id_establishment']);
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
        $data['guide'] = $this->_guide;
        $data['rows'] = $this->_details;
        $this->_view($data);
    }

    private function _send($data) {
        $errors = $this->_validateForm($data);

        if (is_empty($errors)) {
            $values = array(
                'id_guide_detail' => $this->_id_detail,
                'fk_id_purchase_order_detail' => $data['fk_id_purchase_order_detail'],
                'quantity' => $data['quantity']
            );

            if ($this->_Model->editItem($values)) {
                redirect(path::urlDomain('./' . $this->_id_guide));
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
            'quantity' => trim($_POST['quantity'])
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
