<?php

class MoldingsController extends ReportsController {

    protected $ObjPHPExcel;

    public function __construct() {
        parent::__construct();

        $this->_id_molding = (int) DecomposeUrl::getArgument(0);

        $this->_Model = new MoldingsModel();

        $this->_pieces = $this->_Model->pieces(array(
            'fk_id_molding' => $this->_id_molding)
        );

        $this->_list_reception = $this->_Model->listReception(array(
            'fk_id_molding' => $this->_id_molding)
        );

        $this->_reception = $this->_Model->reception(array(
            'fk_id_molding' => $this->_id_molding)
        );

        $this->_list_returned = $this->_Model->listReturned(array(
            'fk_id_molding' => $this->_id_molding)
        );

        $this->_returned = $this->_Model->returned(array(
            'fk_id_molding' => $this->_id_molding)
        );

        //$this->test();
    }

    public function index() {
        $filename = "reporte moldaje";

        $this->_makeNameColumns();
        $this->_makePieces(0, 2);
        $this->_makeGuides($this->_list_reception, $this->_reception, 7, 1);
        $this->_makeGuides($this->_list_returned, $this->_returned, 8 + count($this->_list_reception), 1);
        $this->_makeFormula();
        $this->_drawBorder();
        $this->_headerXLSX($filename);
    }

    private function _makeNameColumns() {
        // Crea las cabeceras de las columnas
        $this->ObjPHPExcel->getActiveSheet()->setCellValue('A2', 'CODIGO');
        $this->ObjPHPExcel->getActiveSheet()->setCellValue('B2', 'NOMBRE');
        $this->ObjPHPExcel->getActiveSheet()->setCellValue('D2', 'RECIBIDO');
        $this->ObjPHPExcel->getActiveSheet()->setCellValue('E2', 'DEVUELTO');
        $this->ObjPHPExcel->getActiveSheet()->setCellValue('F2', 'SALDO EN OBRA');

        // Ajusta la anchura de las columnas de acuerdo a su contenido
        $this->ObjPHPExcel->getActiveSheet()->getColumnDimensionByColumn(3)->setAutoSize(TRUE);
        $this->ObjPHPExcel->getActiveSheet()->getColumnDimensionByColumn(4)->setAutoSize(TRUE);
        $this->ObjPHPExcel->getActiveSheet()->getColumnDimensionByColumn(5)->setAutoSize(TRUE);

    }

    private function _makePieces($left, $top) {
        // Crea todas las filas existentes de acuerdo a la cantidad de piezas. 
        $y = 1;
        foreach ($this->_pieces as $arr) {
            $this->ObjPHPExcel->getActiveSheet()
                    ->setCellValueByColumnAndRow($left, $top + $y, $arr['code']);
            $this->ObjPHPExcel->getActiveSheet()
                    ->setCellValueByColumnAndRow($left + 1, $top + $y, $arr['name']);
            $y++;
        }
        // Ajusta la anchura de las columnas de acuerdo a su contenido
        $this->ObjPHPExcel->getActiveSheet()
                ->getColumnDimensionByColumn($left)
                ->setAutoSize(TRUE);
        $this->ObjPHPExcel->getActiveSheet()
                ->getColumnDimensionByColumn($left + 1)
                ->setAutoSize(TRUE);
    }

    private function _generateCoordinates($list_guides) {
        $this->CoordinatesRow = array();
        $this->CoordinatesCol = array();
        // Genera un indice de filas de acuerdo al id de la pieza
        foreach ($this->_pieces as $arr) {
            $this->CoordinatesRow[] = $arr['id_molding_piece'];
        }
        // Genera un indice de columnas de acuerdo al id de la guía
        foreach ($list_guides as $arr) {
            $this->CoordinatesCol[] = $arr['id_molding_guide'];
        }
    }

    private function _makeGuides($list_guides, $guides, $left, $top) {
        // Genera las cordenadas para relacionar items de guías y piezas en la hoja
        $this->_generateCoordinates($list_guides);
        // Crea todas las columnas de acuedo a las guías existentes filtras como retornadas
        $x = 0;
        foreach ($list_guides as $arr) {
            $this->ObjPHPExcel->getActiveSheet()
                    ->setCellValueByColumnAndRow($left + $x, $top, $arr['number']);
            $this->ObjPHPExcel->getActiveSheet()
                    ->setCellValueByColumnAndRow($left + $x, $top + 1, $arr['issue_date']);
            // ajusta el tamaño de las columnas
            $this->ObjPHPExcel->getActiveSheet()
                    ->getColumnDimensionByColumn($left + $x)->setAutoSize(TRUE);
            $x++;
        }

        // Inserta las cantidades en las celdas correspondientes
        foreach ($guides as $arr) {
            $col = array_search($arr['id_molding_guide'], $this->CoordinatesCol);
            $row = array_search($arr['id_molding_piece'], $this->CoordinatesRow) + 2;
            // Primero obtiene el valor de la celda, para sumarlo con el nuevo valor
            // Esta es una consideracion necesaria porque una guía puede tener 
            // varias items que hacen referencia a una misma pieza
            $value = $this->ObjPHPExcel->getActiveSheet()
                            ->getCellByColumnAndRow($left + $col, $top + $row)->getValue();

            $this->ObjPHPExcel->getActiveSheet()
                    ->setCellValueByColumnAndRow($left + $col, $top + $row, $value + $arr['quantity']);
        }
    }

    private function _makeFormula() {
        $x = 7;
        $start_range_reception = $x;
        $end_range_reception = $x + count($this->_list_reception) - 1;

        $start_range_returned = $end_range_reception + 2;
        $end_range_returned = $start_range_returned + count($this->_list_returned) - 1;

        for ($i = 0; $i < count($this->_pieces); $i++) {
            $y = $i + 3;
            $str_range_reception = PHPExcel_Cell::stringFromColumnIndex($start_range_reception) . "$y:";
            $str_range_reception .= PHPExcel_Cell::stringFromColumnIndex($end_range_reception) . $y;
            $str_range_returned = PHPExcel_Cell::stringFromColumnIndex($start_range_returned) . "$y:";
            $str_range_returned .= PHPExcel_Cell::stringFromColumnIndex($end_range_returned) . $y;

            $this->ObjPHPExcel->getActiveSheet()
                    ->setCellValue("D$y", "=SUM($str_range_reception)");
            $this->ObjPHPExcel->getActiveSheet()
                    ->setCellValue("E$y", "=SUM($str_range_returned)");
            $this->ObjPHPExcel->getActiveSheet()
                    ->setCellValue("F$y", "=D$y-E$y");
        }
    }

    private function _drawBorder() {
        $total_columns = count($this->_list_reception) + count($this->_list_returned) + 7;
        $total_rows = count($this->_pieces) + 2;
        $range_end = PHPExcel_Cell::stringFromColumnIndex($total_columns) . $total_rows;

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $this->ObjPHPExcel->getActiveSheet()->getStyle('A1:' . $range_end)
                ->applyFromArray($styleArray);
        unset($styleArray);
    }

}
