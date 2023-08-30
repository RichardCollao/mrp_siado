<?php

class BillsController extends ReportsController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new BillsModel();
        $this->_bills = $this->_Model->reports(array(
            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'))
        );
    }

    public function index() {
        $filename = "reporte facturas";

        $column_names = array('Número', 'Fecha', 'Orden de compra', 'Guía', 'Proveedor',
            'Cuenta de costo', 'Material', 'Medida', 'Cantidad', 'Valor', 'total', 'Valor en OC', 'Total en OC', 'Observación');

        foreach ($this->_bills as $row) {
            $f = function() use ($row) {
                extract($row);
                return array($number, $issue_date, $po_number, $guide_number, $provider_name,
                    $ea_number, $material, $abbreviation, $quantity, $value, $total, $po_value, $po_total, $observation);
            };
            $rows[] = $f();
        }
        #printFormat($rows);
        #return;
        $this->makeExcel($filename, $rows, $column_names);
    }

    public function addFunctionality($col, $row) {
        // Inmoviliza la primera fila
        $this->ObjPHPExcel->getActiveSheet()->freezePane('A2');

        // Autofilter
        $this->ObjPHPExcel->getActiveSheet()->setAutoFilter('A1:' . PHPExcel_Cell::stringFromColumnIndex($col) . $row);
    }

}
