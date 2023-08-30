<?php

class VouchersController extends MembersController {

    protected $list_supervisors = array();
    protected $list_materials = array();
    protected $list_materials_with_stock = array();
    protected $array_materials_with_stock = array();
    // Atributos para ser usados en DataList y mejorar la experiencia de usuario
    protected $list_user_name_requestings = array();
    protected $list_destinations = array();

    public function __construct() {
        parent::__construct();
    }

    public function loadLists() {
//        $this->list_destinations = $this->_Model->listDestinations(array(
//            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'))
//        );
//        debug::printRF($this->list_destinations);
//        $this->list_user_name_requestings = $this->_Model->listUserNameRequestings(array(
//            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'))
//        );
//        debug::printRF($this->list_user_name_requesting);

        $supervisors = $this->_Model->listSupervisors(array(
            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'))
        );
        foreach ($supervisors as $supervisor) {
            $this->list_supervisors[$supervisor['id_user']] = $supervisor['name'];
        }

        $materials = $this->_Model->listMaterials(array(
            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'))
        );
        foreach ($materials as $row) {
            $row['stock'] = $row['total_in_guides'] - $row['total_in_vouchers'];
            $this->list_materials[$row['id_material']] = $row;

            // variable boleana que establece la exepcion para mostrar un material con stock 0
            // cuando se esta editando el mismo material desde el controlador edit_detail.
            $edit_detail = $row['id_material'] == $this->_detail['fk_id_material'];

            if ($row['stock'] > 0 || $edit_detail) {
                $this->list_materials_with_stock[] = array(
                    'id' => $row['id_material'],
                    'columns' => array(
                        $row['name'],
                        numberFormat($row['stock']),
                        $row['abbreviation'],
                        $row['ea_name']
                    )
                );
            }
        }
    }

    protected function _checkLists() {
        $errors = array();
        if (is_empty($this->list_supervisors)) {
            $errors[] = 'No se encontro ningun usuario con permisos para autorizar vales';
        }

        if (is_empty($this->list_materials_with_stock)) {
            $errors[] = 'No se encontro ninguna lista de materiales';
        }

        if (!is_empty($errors)) {
            $MsgBox = new MsgBox();

            $MsgBox->setEvent('info');
            $MsgBox->setMessage('Antes de continuar primero debe corregir los siguientes errores.');
            $MsgBox->setItems($errors);
            $MsgBox->saveInSession();
            unset($MsgBox);

            redirect(path::urlDomain('./'));
        }
    }

    protected function _isBlocked() {
        if ($this->_voucher['locked']) {
            $errors = array();
            $errors[] = 'El recurso se encuentra bloqueado.';
            $MsgBox = new MsgBox();
            $MsgBox->setEvent('warning');
            $MsgBox->setMessage('No se ha podido completar la accion debido a los siguientes errores.');
            $MsgBox->setItems($errors);
            $MsgBox->saveInSession();
            unset($MsgBox);
            redirect(path::urlDomain('./'));
        }
    }

}
