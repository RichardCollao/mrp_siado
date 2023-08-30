<?php

class MaterialController extends ReportsController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new MaterialModel();
        $this->_id_material = (int) DecomposeUrl::getArgument(0);
        $this->_material = $this->_Model->loadMaterial(array(
            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'),
            'id_material' => $this->_id_material)
        );
        $this->_purchaseorders = $this->_Model->materialInPurchaseOrders(array(
            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'),
            'id_material' => $this->_id_material
                )
        );
        $this->_guides = $this->_Model->materialInGuides(array(
            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'),
            'id_material' => $this->_id_material
                )
        );
        $this->_vouchers = $this->_Model->materialInVouchers(array(
            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'),
            'id_material' => $this->_id_material
                )
        );
    }

    public function index() {
        $this->ObjPHPExcel->createSheet(1);
        $this->ObjPHPExcel->setActiveSheetIndex(1);
        $this->ObjPHPExcel->setActiveSheetIndex(1);
        $this->ObjPHPExcel->getActiveSheet()->setTitle('Ordenes de compra');
        $this->purchaseorderSheet();

        $this->ObjPHPExcel->createSheet(2);
        $this->ObjPHPExcel->setActiveSheetIndex(2);
        $this->ObjPHPExcel->getActiveSheet()->setTitle('Guías');
        $this->guideSheet();

        $this->ObjPHPExcel->createSheet(3);
        $this->ObjPHPExcel->setActiveSheetIndex(3);
        $this->ObjPHPExcel->getActiveSheet()->setTitle('Vales');
        $this->voucherSheet();

        $this->ObjPHPExcel->setActiveSheetIndex(0);
        $this->ObjPHPExcel->getActiveSheet()->setTitle('Resumen');
        $this->resumeSheet();

        // Deja la primera hoja seleccionada
        $this->ObjPHPExcel->setActiveSheetIndex(0);

        $filename = "reporte_material";
        $this->_headerXLSX($filename);
    }

    public function resumeSheet() {
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT
            )
        );

        $this->ObjPHPExcel->getActiveSheet()->getDefaultStyle()->applyFromArray($style);
        // $this->ObjPHPExcel->getActiveSheet()->getStyle("A1:B1")->applyFromArray($style);
        // $sheet->getActiveSheet()->getStyle('A1:B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->ObjPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, "Material");
        $this->ObjPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 2, "Medida");
        $this->ObjPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 3, "Codigo cuenta contable");
        $this->ObjPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 4, "Nombre cuenta contable");
        $this->ObjPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 5, "Definido en OC");
        $this->ObjPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 6, "Pendiente en OC");
        $this->ObjPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 7, "Recepcionado en guías");
        $this->ObjPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 8, "Rebajado en vales");
        $this->ObjPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 9, "Stock critico");
        $this->ObjPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 10, "Stock actual");
        $this->ObjPHPExcel->getActiveSheet()->getColumnDimensionByColumn(0)->setAutoSize(TRUE);

        $this->ObjPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 1, $this->_material['name']);
        $this->ObjPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 2, $this->_material['abbreviation']);
        $this->ObjPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 3, $this->_material['ea_number']);
        $this->ObjPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 4, $this->_material['ea_name']);
        $this->ObjPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 5, "=SUM('Ordenes de compra'!H2:H" . (int) (count($this->_purchaseorders) + 1) . ")");
        $this->ObjPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 6, "=SUM('Ordenes de compra'!J2:J" . (int) (count($this->_purchaseorders) + 1) . ")");
        $this->ObjPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 7, "=SUM('Guías'!I2:I" . (int) (count($this->_guides) + 1) . ")");
        $this->ObjPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 8, "=SUM('Vales'!H2:H" . (int) (count($this->_vouchers) + 1) . ")");
        $this->ObjPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 9, $this->_material['critical_stock']);
        $this->ObjPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 10, $this->_material['total_in_guides'] - $this->_material['total_in_vouchers']);
        $this->ObjPHPExcel->getActiveSheet()->getColumnDimensionByColumn(1)->setAutoSize(TRUE);
    }

    public function purchaseorderSheet() {
        $column_names = array('Número', 'Fecha', 'Codigo', 'Material', 'Medida', 'Proveedor',
            'Cuenta de costo', 'Cantidad', 'Recepcionado', 'Saldo en OC', 'Valor', 'Total', 'Observación');

        foreach ($this->_purchaseorders as $row) {
            $f = function() use ($row) {
                extract($row);
                $residue = $quantity - $received;

                return array($po_number, $issue_date, $code, $name, $abbreviation, $provider_name,
                    $ea_number, $quantity, $received, $residue, $value, $total, $observation);
            };
            $rows[] = $f();
        }

        $this->overwriteMakeExcel($rows, $column_names);
    }

    public function guideSheet() {
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

        $this->overwriteMakeExcel($rows, $column_names);
    }

    public function voucherSheet() {
        $column_names = array('Número', 'Fecha', 'Solicita', 'Autoriza', 'Digitador',
            'Material', 'Medida', 'Cantidad', 'Cuenta contable', 'Destino', 'Observación');

        foreach ($this->_vouchers as $row) {
            $f = function() use ($row) {
                extract($row);
                return array($number, $issue_date, $user_name_requesting, $user_name_autorized, $user_name_typist,
                    $material, $abbreviation, $quantity, $ea_number, $destination, $observation);
            };
            $rows[] = $f();
        }

        $this->overwriteMakeExcel($rows, $column_names);
    }

    protected function overwriteMakeExcel($rows, $column_names) {
        $col = 0;
        $row = 1;
        foreach ($column_names as $value) {
            $this->ObjPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
            // Ajusta la anchura de las columnas de acuerdo a su contenido
            $this->ObjPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(TRUE);
            $col++;
        }

        // Agregar los datos
        foreach ($rows as $arr) {
            $col = 0;
            $row++;
            foreach ($arr as $value) {
                $this->ObjPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
                $col++;
            }
        }

        // Inmoviliza la primera fila
        $this->ObjPHPExcel->getActiveSheet()->freezePane('A2');
        // Autofilter
        $this->ObjPHPExcel->getActiveSheet()->setAutoFilter('A1:' . PHPExcel_Cell::stringFromColumnIndex($col) . $row);
    }

}
