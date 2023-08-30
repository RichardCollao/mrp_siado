<?php

class GuidesController extends ReportsController {

    public function __construct() {
        parent::__construct();


        $this->_Model = new GuidesModel();
        $this->_guides = $this->_Model->reports(array(
            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'))
        );
    }

    public function index() {
        $filename = "reporte guías";

        $column_names = array('Número', 'Fecha', 'Orden de compra', 'Factura', 'Proveedor',
            'Cuenta de costo', 'Material', 'Medida', 'Cantidad', 'Valor en OC', 'Total en OC', 'Observación');

        foreach ($this->_guides as $row) {
            $f = function() use ($row) {
                extract($row);
                return array($number, $issue_date, $po_number, $bill_number, $provider_name,
                    $ea_number, $material, $abbreviation, $quantity, $po_value, $po_total, $observation);
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
