<?php

class InstallController extends Controller {

    public function __construct() {
        // Funcion responsable de aumentar el tiempo al script para crear la base de datos
        #set_time_limit(300);
        parent::__construct();

        // La base se establece sobre el primer fragmento relativo.
        path::setLevelbase(1); # Alta prioridad 

        #$this->_verifyInstallRecord();
    }

    private function verifyInstallRecord() {
        if (file_exists(Path::appConfigs('installation_bodega_record.php'))) {
            if (DecomposeUrl::getController() != 'finished') {
                redirect(Path::appViews('./finished'));
            }
        } else {
            if (DecomposeUrl::getReserved(-1) != 'install') {
                redirect(Path::appViews('./finished'));
            }
        }
    }

    /**
     * Una vez que se ha cargado el controlador y este devuelve la linea de flujo, solo queda llamar este metodo
     * que volcara todas las vistas de la pagina final en pantalla.
     */
    public function showPage() {
        #View::insert('<h2></h2>', 'content', TRUE);

        Header::setTitle('..:: Framework ::..');
        Header::setFavicon(constant('FW_URL_DOMAIN') . 'images/favicon.ico');

        // Incluir Librerias
        Header::addJavascript(constant('FW_URL_DOMAIN_JS') . 'functions.js');

        Header::addSheetsCSS(constant('FW_URL_DOMAIN_LIBRARIES') . 'bootstrap-3.2.0/css/bootstrap.min.css', true);
        Header::addJavascript(constant('FW_URL_DOMAIN_LIBRARIES') . 'bootstrap-3.2.0/js/bootstrap.min.js', true);
        Header::addJavascript(constant('FW_URL_DOMAIN_LIBRARIES') . 'jquery-3.1.0/jquery.js', true);

        // Finalmente muestra la pagina y termina el script
        // Inserta los mensajes en el contenedor de la clase View. No mover de aca.
        ViewMsgBox::initialize();
        View::setlayout(path::appViews('./default.layout.php'));


        View::show(View::getLayout(), array());
        
        die();
    }

}
