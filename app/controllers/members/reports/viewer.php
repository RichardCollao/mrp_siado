<?php


// Este controlador no esta terminado, obedece a la idea de embeber un visor de documento
// de googledocs en la pagina 
// http://meridadesignblog.com/visor-archivos-pagina-web-con-google-docs-viewer/

// Forma 1
//<a href="http://docs.google.com/viewer?url=http%3A%2F%2Fmeridadesign.com%2Fdemos%2Fquotes.pptx" 
//title="Quotes" target="_blank">http://meridadesign.com/demos/quotes.pptx</a>

// Forma 2
//<iframe src="http://docs.google.com/viewer?url=file.ext&embedded=true" 
//        width="600" height="300" style="border: none;"></iframe>

class ViewerController extends ReportsController {

    public function __construct() {
        parent::__construct();

        $this->_id_purchase_order = (int) DecomposeUrl::getArgument(0);
    }

    public function index() {
        $this->_view();
    }

    private function _view($data = array()) {
        $data['link_vouchers'] = path::urlDomain('./details/');

        View::keep(path::appViews('./viewer.php'), $data, 'content');
        //View::keep('templates/bar.php', $data, 'content');
    }

}
