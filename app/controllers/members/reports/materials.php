<?php

class MaterialsController extends ReportsController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new MaterialsModel();
        $this->_materials = $this->_Model->reports(array(
            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'))
        );
    }

    public function index() {
        $filename = "reporte materiales";

        $column_names = array('Material', 'Unidad', 'Medida', 'Número CC', 'Nombre CC', 'Stock critico', 'Recepcionado', 'Rebajado', 'Stock actual');

        foreach ($this->_materials as $row) {
            $f = function() use ($row) {
                extract($row);
                return array($name, $abbreviation, $terminology, $ea_number, $ea_name, $critical_stock, $total_in_guides, $total_in_vouchers, $total_in_guides - $total_in_vouchers);
            };
            $rows[] = $f();
        }

        $this->makeExcel($filename, $rows, $column_names);
    }

    public function addFunctionality($col, $row) {
        // Agrega un formato condicional que destaca en rojo si la celda tiene un valor
        // menor que el de la celda a la cual hace referencia la formula
        for ($i = 2; $i < $row; $i++) {
            $objConditional = new PHPExcel_Style_Conditional();
            $objConditional->setConditionType(PHPExcel_Style_Conditional::CONDITION_CELLIS)
                    ->setOperatorType(PHPExcel_Style_Conditional::OPERATOR_LESSTHAN)
                    ->addCondition('=f' . $i);
            $objConditional->getStyle()->getFont()->getColor()->setRGB('FF0000');
            $this->ObjPHPExcel->getActiveSheet()->getStyle('i' . $i)->setConditionalStyles(array($objConditional));
        }
        
        // Inmoviliza la primera fila
        $this->ObjPHPExcel->getActiveSheet()->freezePane('A2');
        
        // Autofilter
        $this->ObjPHPExcel->getActiveSheet()->setAutoFilter('A1:'. PHPExcel_Cell::stringFromColumnIndex($col) . $row);
    }

}
