<?php

class GuidesController extends BillsController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new GuidesModel();
        $this->_id_bill = (int) DecomposeUrl::getArgument(0);
        
        $this->_bill = $this->_Model->loadBill(array(
            'id_bill' => $this->_id_bill)
        );
        $this->_guides = $this->_Model->loadGuides(array(
            'fk_id_purchase_order' => $this->_bill['fk_id_purchase_order'])
        );
        
        $this->_guides_associates = $this->_Model->loadGuidesAssociates(array(
            'fk_id_bill' => $this->_id_bill)
        );

        $this->_checkEstablishment($this->_bill['fk_id_establishment']);
        #$this->_checkPermissions();
        $this->loadLists();
        $this->_checkLists();
    }

    public function index() {
        if (!is_empty($_POST)) {
            $data = $this->_loadDataFromPost();
            $this->_send($data);
        }

        $data['bill'] = $this->_bill;
        $data['guides'] = $this->_guides;
        $data['rows'] = $this->_guides_associates;
        $this->_view($data);
    }

    private function _send($data) {
        $errors = $this->_validateForm($data);

        if (is_empty($errors)) {
            $values = array(
                'fk_id_bill' => $this->_id_bill,
                'id_guide' => $data['id_guide']
            );

            if ($this->_Model->associateGuide($values)) {
                redirect(path::urlDomain('./guides/' . $this->_id_bill));
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
            'id_guide' => trim($_POST['id_guide'])
        );
    }

    private function _validateForm($data) {
        extract($data);
        $errors = array();

        return $errors;
    }

    private function _view($data) {
        $data['action_form'] = path::urlDomain('./guides/' . $this->_id_bill);

        $data['link_display'] = path::urlDomain('./../guides/display/');
        $data['link_disassociate'] = path::urlDomain('./disassociate/');
        $data['link_finish'] = path::urlDomain('./');
        View::keep(path::appViews('./guides.php'), $data, 'content');
    }

}
