<?php

class VouchersController extends ReportsController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new VouchersModel();
        $this->_vouchers = $this->_Model->reports(array(
            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'))
        );
    }

    public function index() {
        $filename = "reporte vales";

        $columns_names = array('Número', 'Fecha', 'Solicita', 'Autoriza', 'Digitador',
            'Material', 'Medida', 'Cantidad', 'Cuenta contable', 'Destino', 'Observación');
        
//        'FORMAT_DATE_DDMMYYYY'
        
        
        foreach ($this->_vouchers as $row) {
            $f = function() use ($row) {
                extract($row);
                return array($number, $issue_date, $user_name_requesting, $user_name_autorized, $user_name_typist,
                    $material, $abbreviation, $quantity, $ea_number, $destination, $observation);
            };
            $rows[] = $f();
        }

        $this->makeExcel($filename, $rows, $columns_names);
    }

    public function addFunctionality($col, $row) {
        // Inmoviliza la primera fila
        $this->ObjPHPExcel->getActiveSheet()->freezePane('A2');

        // Autofilter
        $this->ObjPHPExcel->getActiveSheet()->setAutoFilter('A1:' . PHPExcel_Cell::stringFromColumnIndex($col) . $row);
    }

}
