<?php

class CreateController extends PurchaseOrdersController {

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
            $data = $this->_loadDataDefault();
        }
        $this->_view($data);
    }

    private function _send($data) {
        $errors = $this->_validateForm($data);

        if (is_empty($errors)) {
            $values = array(
                'id_purchase_order' => 0,
                'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'),
                'fk_id_provider' => $data['fk_id_provider'],
                'number' => $data['number'],
                'issue_date' => $data['issue_date'],
                'created_at' => constant('FW_DATETIME_CURRENT'),
                'status' => 'pending',
                'vendor_name' => $data['vendor_name'],
                'vendor_contact' => $data['vendor_contact'],
                'dispatch_name' => $data['dispatch_name'],
                'dispatch_contact' => $data['dispatch_contact'],
                'dispatch_address' => $data['dispatch_address'],
                'number_material_request' => $data['number_material_request'],
                'number_quotation' => $data['number_quotation'],
                'way_to_pay' => $data['way_to_pay'],
                'observation' => $data['observation'],
                'footer' => $data['footer']
            );

            if (!is_empty($this->_Model->duplicateNumber($values))) {
                $errors[] = 'El número de orden de compra ya existe';
            } elseif ($this->_Model->createPurchaseOrder($values)) {
                redirect(path::urlDomain('./details/' . $this->_Model->getLastInsertId()));
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
            'number' => trim($_POST['number']),
            'fk_id_provider' => (int) $_POST['fk_id_provider'],
            'issue_date' => trim($_POST['issue_date']),
            'vendor_name' => trim($_POST['vendor_name']),
            'vendor_contact' => trim($_POST['vendor_contact']),
            'dispatch_name' => trim($_POST['dispatch_name']),
            'dispatch_contact' => trim($_POST['dispatch_contact']),
            'dispatch_address' => trim($_POST['dispatch_address']),
            'number_material_request' => trim($_POST['number_material_request']),
            'number_quotation' => trim($_POST['number_quotation']),
            'way_to_pay' => trim($_POST['way_to_pay']),
            'observation' => trim($_POST['observation']),
            'footer' => trim($_POST['footer'])
        );
    }

    private function _loadDataDefault() {
        $dispatch_contact = array();

        if (!is_empty(constant('AUTH_MAIL'))) {
            $dispatch_contact[] = 'correo: ' . constant('AUTH_MAIL');
        }
        if (!is_empty(constant('AUTH_PHONE'))) {
            $dispatch_contact[] = 'telefono: ' . constant('AUTH_PHONE');
        }
        
        return array(
            'number' => '',
            'fk_id_provider' => $this->list_providers[0]['id'],
            'issue_date' => constant('FW_DATE_CURRENT'),
            'dispatch_name' => constant('AUTH_NAME'),
            'dispatch_contact' => implode(', ', $dispatch_contact),
            'dispatch_address' => AUTH_ADDRESS_ESTABLISHMENT,
            'way_to_pay' => 'Pago 30 dias desde la recepcion de la factura',
            'footer' => "Toda Factura, Debera venir acompañada de su respectiva copia de Orden de Compra, No se recibiran facturas sin su Copia."
        );
    }

    private function _validateForm($data) {
        extract($data);
        $errors = array();
        if (!preg_match('/^[0-9a-z\.\-\_\s]+$/i', $number)) {
            $errors[] = 'EL campo <b>número</b> no es valido';
        }
        /**
          if (!array_key_exists($fk_id_provider, $this->list_providers)) {
          $errors[] = 'El campo <b>provedor</b> no es valido';
          }
         */
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $issue_date)) {
            $errors[] = 'EL campo <b>fecha</b> no es valido, utilice el siguiente formato 2016-12-25';
        } elseif (!checkRealDate($issue_date)) {
            $errors[] = 'El campo <b>fecha</b> ingresada es invalida';
        }

        if (!empty($vendor_name)) {
            if (Validate::name($vendor_name) !== TRUE) {
                $errors[] = 'El campo <b>nombre vendedor</b> no es valido';
            }
        }

        if (!empty($vendor_contact)) {
            if (Validate::contact($vendor_contact) !== TRUE) {
                $errors[] = 'El campo <b>contacto vendedor</b> no es valido';
            }
        }

        if (Validate::name($dispatch_name) !== TRUE) {
            $errors[] = 'El campo <b>nombre recepcionador</b> no es valido';
        }

        if (Validate::contact($dispatch_contact) !== TRUE) {
            $errors[] = 'El campo <b>contacto recepcionador</b> no es valido';
        }

        if (Validate::address($dispatch_address) !== true) {
            $errors[] = 'El campo <b>direccion recepcion</b> no es valido, caracteres pemitidos espacios, a-z0-9/.,#-_"';
        }

        if (!is_empty($way_to_pay)) {
            if (Validate::observation($way_to_pay) !== true) {
                $errors[] = 'El campo <b>forma de pago</b> no es valido';
            }
        }

        if (!is_empty($observation)) {
            if (Validate::observation($observation) !== true) {
                $errors[] = 'El campo <b>Observación</b> no es valido';
            }
        }
        return $errors;
    }

    private function _view($data) {
        $data['action_form'] = path::urlDomain('./create');
        $data['json_list_providers'] = ForceObjToArray($this->list_providers);
        $data['link_ajaxcontacts'] = path::urlDomain('providers/contacts/ajaxcontacts/');

        View::keep(path::appViews('./create.php'), $data, 'content');
    }

}
