<?php

class ReportsController extends MembersController {

    protected $ObjPHPExcel;

    public function __construct() {
        parent::__construct();

        $this->_createObjPHPExcel();
    }

    protected function _createObjPHPExcel() {
        require_once (path::appClass('phpexcel/Classes/PHPExcel.php'));

        // Se crea el objeto PHPExcel
        $this->ObjPHPExcel = new PHPExcel();

        // Se asignan las propiedades del libro
        $this->ObjPHPExcel->getProperties()
                ->setCreator("www.siado.cl")
                ->setTitle("Reporte Excel con PHP y MySQL")
                ->setSubject("Office 2007 XLSX Test Document")
                ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                ->setKeywords("office 2007 openxml php")
                ->setCategory("Test result file");

        $this->ObjPHPExcel->setActiveSheetIndex(0);
        // Se asigna el nombre a la hoja
        $this->ObjPHPExcel->getActiveSheet()->setTitle('Reporte');
    }

    protected function _headerXLS($filename) {
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
        header('Cache-Control: max-age=0');

        $ObjWriter = PHPExcel_IOFactory::createWriter($this->ObjPHPExcel, 'Excel5');
        $ObjWriter->setPreCalculateFormulas(true); // calcula las formulas
        /* Limpiamos el búfer */
        ob_end_clean();
        $ObjWriter->save('php://output');
        exit();
    }

    protected function _headerXLSX($filename) {
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $ObjWriter = PHPExcel_IOFactory::createWriter($this->ObjPHPExcel, 'Excel2007');
        $ObjWriter->setPreCalculateFormulas(true); // calcula las formulas
        /* Limpiamos el búfer */
        ob_end_clean();
        $ObjWriter->save('php://output');
        exit();
    }

    // Este es un metodo generico vale para la mayoria de los reportes 
    protected function makeExcel($filename, $rows, $columns_names) {
        $filename = str_replace(" ", "_", $filename);

        $col = 0;
        $row = 1;
        foreach ($columns_names as $value) {
            $this->ObjPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
            // Ajusta la anchura de las columnas de acuerdo a su contenido
//            $this->ObjPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(TRUE);
            $this->ObjPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setWidth(15);
            $col++;
        }

        // Agregar los datos
        $row = 1;
        foreach ($rows as $arr) {
            $col = 0;
            $row++;
            foreach ($arr as $value) {
                $this->ObjPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
                $col++;
            }
        }


        $this->addFunctionality($col - 1, $row + 1);

        $this->_headerXLSX($filename);
    }

    public function addFunctionality($col, $row) {
        return;
    }

}

// Nota: para referirse a las celdas de una hoja, 
// las columnas inician en 0, y las filas en 1


/**
  before instantiating your PHPExcel object .
  PHPExcel_Cell::setValueBinder(new PHPExcel_Cell_AdvancedValueBinder());
  Permite usar->setCellValueExplicit('A!', "12,234); en vez de setCellValue

$str_col = PHPExcel_Cell::stringFromColumnIndex($col);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'Valor 1')

header('Content-Type: application/vnd.ms-excel;');
header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($this->ObjPHPExcel, 'Excel5');
$objWriter->save('php://output');

Combinar celdas A1 hasta D1
$this->ObjPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:D1');


Formatear celdas o columnas
$this->ObjPHPExcel->setActiveSheetIndex(0)->getStyle('G2:G' . $i)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);



Inmovilizar paneles
$this->ObjPHPExcel->getActiveSheet(0)->freezePane('A4');// or $this->ObjPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0, 1);


Freeze first line:
$objPHPExcel->getActiveSheet()->freezePane('A2');

Freeze second line:
$objPHPExcel->getActiveSheet()->freezePane('A3');
Freezing Columns

Freeze first column:
$objPHPExcel->getActiveSheet()->freezePane('B1');

Freeze second column:
$objPHPExcel->getActiveSheet()->freezePane('C1');
Freezing Columns and Lines

Freeze first column and first line:
$objPHPExcel->getActiveSheet()->freezePane('B2');

Freeze fourth column and first line:
$objPHPExcel->getActiveSheet()->freezePane('D2');



 *  */