<?php

class EditController extends GuidesController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new EditModel();
        $this->_id_molding_guide_detail = (int) DecomposeUrl::getArgument(0);
        $this->_detail = $this->_Model->loadDetail(array(
            'id_molding_guide_detail' => $this->_id_molding_guide_detail
        ));
        $this->_details = $this->_Model->loadDetails(array(
            'id_molding_guide_detail' => $this->_id_molding_guide_detail,
            'fk_id_molding_guide' => $this->_detail['fk_id_molding_guide']
        ));
        $this->_molding_guide = $this->_Model->loadMoldingGuide(array(
            'id_molding_guide' => $this->_detail['fk_id_molding_guide']
        ));
        $this->_id_guide = $this->_detail['fk_id_guide'];

        $this->_id_molding = $this->_molding_guide['fk_id_molding'];
        #$this->_checkPermissions();
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
                'id_molding_guide_detail' => $this->_id_molding_guide_detail,
                'fk_id_molding_piece' => $data['fk_id_molding_piece'],
                'quantity' => $data['quantity']
            );

            if ($this->_Model->editItem($values)) {
                redirect(path::urlDomain('./' . $this->_detail['fk_id_molding_guide']));
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
            'fk_id_molding_piece' => trim($_POST['fk_id_molding_piece']),
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
        if (!preg_match('/^[1-9][0-9]*(\.[0-9]+)?$/', $quantity)) {
            $errors[] = 'EL campo Cantidad no es valido';
        }
        return $errors;
    }

    private function _view($data) {
        $data['action_form'] = path::urlDomain('./edit/' . $this->_id_molding_guide_detail);
        $data['json_list_pieces'] = ForceObjToArray($this->list_pieces);
        $data['link_edit'] = path::urlDomain('./edit/');
        $data['link_delete_item'] = path::urlDomain('./delete/');
        $data['link_finish'] = path::urlDomain('./' . $this->_detail['fk_id_molding_guide']);
        View::keep(path::appViews('./edit.php'), $data, 'content');
    }

}
