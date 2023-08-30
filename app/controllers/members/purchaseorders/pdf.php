<?php

class PdfController extends PurchaseOrdersController {

    public function __construct() {
        parent::__construct();
        
        require_once (path::appClass('dompdf/dompdf_config.inc.php'));

        $this->_Model = new PdfModel();

        $this->_id_purchase_order = (int) DecomposeUrl::getArgument(0);

        $this->_purchase_order = $this->_Model->loadPurchaseOrder(array(
            'id_purchase_order' => $this->_id_purchase_order)
        );
        $this->_purchase_order_details = $this->_Model->loadPurchaseOrderDetails(array(
            'id_purchase_order' => $this->_id_purchase_order)
        );
        $this->_establishment = $this->_Model->loadEstablishment(array(
            'id_establishment' => constant('AUTH_ESTABLISHMENT'))
        );
        $this->_provider = $this->_Model->loadProvider(array(
            'id_provider' => $this->_purchase_order['fk_id_provider'])
        );
    }

    public function index() {
        $data['establishment'] = $this->_establishment;
        $data['purchase_order'] = $this->_purchase_order;

        $data['provider'] = $this->_provider;
        $data['rows'] = $this->_purchase_order_details;

        $data['purchase_order']['iva'] = calculateIVA($data['purchase_order']['total']);
        $data['purchase_order']['total_with_iva'] = $data['purchase_order']['total'] + $data['purchase_order']['iva'];

        $this->_view($data);
    }

    private function _view($data) {
        $data['purchase_order']['issue_date'] = dateFormatFromString($data['purchase_order']['issue_date'], 'd-m-Y');
        $data['src_logo'] = path::dirPublicResources($this->relative_path_logos . 'logo.png');

        $html = View::extract(path::appViews('./pdf.php'), $data, 'content');
        #echo $html;
        $this->_generatePdf($html);
        exit();
    }

    private function _generatePdf($html) {
        $filename = 'OC ' . $this->_purchase_order['number'] . '.pdf';

        // Instanciamos un objeto de la clase DOMPDF.
        $pdf = new DOMPDF();
        // Define el tamaño y orientación del papel, por defecto cogerá el que está en el fichero de configuración.
        $pdf->set_paper("A4", "portrait");

        // 150 ppp (baja calidad): 1240x1754
        // 300 ppp (calidad normal): 2480x3508
        // 600 ppp (alta calidad): 4971x7016 
        $paper_size = array(0, 0, 1240, 1754);

        $pdf->set_paper($paper_size);

        // Cargamos el contenido HTML.
        $pdf->load_html($html);
        #$pdf->load_html(utf8_decode($html));
        // Renderizamos el documento PDF.
        $pdf->render();
        // Enviamos elfichero PDF al navegador.
        $pdf->stream($filename);
    }

}
