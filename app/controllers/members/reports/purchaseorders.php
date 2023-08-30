<?php

class PurchaseOrdersController extends ReportsController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new PurchaseOrdersModel();
        $this->_purchase_order = $this->_Model->reports(array(
            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'))
        );
//        Debug::printRF($this->_purchase_order);
    }

    public function index() {
        $filename = "reporte ordenes de compra";

        $column_names = array('Número', 'Fecha', 'Codigo', 'Material', 'Medida', 'Proveedor',
            'Cuenta de costo', 'Cantidad', 'Recepcionado', 'Saldo', 'Valor', 'Total', 'Observación');

        foreach ($this->_purchase_order as $row) {
            $f = function() use ($row) {
                extract($row);
                $residue = $quantity - $received;

                return array($po_number, $issue_date, $code, $name, $abbreviation, $provider_name,
                    $ea_number, $quantity, $received, $residue, $value, $total, $observation);
            };
            $rows[] = $f();
        }


        $this->makeExcel($filename, $rows, $column_names);
    }

    public function addFunctionality($col, $row) {
        // Inmoviliza la primera fila
        $this->ObjPHPExcel->getActiveSheet()->freezePane('A2');

        // Autofilter
        $this->ObjPHPExcel->getActiveSheet()->setAutoFilter('A1:' . PHPExcel_Cell::stringFromColumnIndex($col) . $row);
    }

}
