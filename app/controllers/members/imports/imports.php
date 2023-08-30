<?php

class ImportsController extends MembersController {

    public function __construct() {
        parent::__construct();
    }

    protected function _createObjPHPExcel() {

        $nombre_fichero = path::appResources('./reporte_vales.xlsx');
        artAscii();
        if (file_exists($nombre_fichero)) {
            echo "El fichero $nombre_fichero existe";
        } else {
            echo "El fichero $nombre_fichero no existe";
        }

        require_once (path::appClass('phpexcel/Classes/PHPExcel.php'));
        require_once(path::appClass('phpexcel/Classes/PHPExcel/Reader/Excel2007.php'));

        $objReader = new PHPExcel_Reader_Excel2007();
        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load($nombre_fichero);

        echo 'La celda A1 es: ' . $objPHPExcel->getActiveSheet()->getCell('A1')->getFormattedValue();
        echo '<br/>La celda B1 es: ' . $objPHPExcel->getActiveSheet()->getCell('B1')->getCalculatedValue();
        echo '<br/>La celda B1 es: ' . $objPHPExcel->getActiveSheet()->getCell('C1')->getCalculatedValue();
    }

}
