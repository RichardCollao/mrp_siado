<?php

class IndexController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['portada'] = path::urlImages('/portada.jpg');
        $data['thumbnail_01'] = path::urlImages('/thumbnail_01.jpg');
        View::keep(path::appViews('index.php'), $data, 'content');
    }

    public function showPage() {
        // Inserta los mensajes en el contenedor de la clase View. No mover de aca.
        ViewMsgBox::initialize();
        // Definir titulo y favicon
        Header::setTitle('..:: SIADO ::..');
        Header::setFavicon(path::urlImages('/favicon.png'));
        Header::setRobotsIndex(true);
        // Incluir Librerias
        Header::addJavascript(path::urlJs('/functions.js'));
        Header::addJavascript(path::urlLibraries('/jquery-3.1.0/jquery.js'), true);
        Header::addJavascript(path::urlLibraries('/bootstrap-3.2.0/js/bootstrap.min.js'));
        Header::addSheetsCSS(path::urlLibraries('/bootstrap-3.2.0/css/bootstrap.min.css'), true);
        // Bootstrap-social-buttons
        Header::addSheetsCSS(path::urlLibraries('/bootstrap-social/bootstrap-social.css'));
        Header::addSheetsCSS(path::urlLibraries('/font-awesome/css/font-awesome.min.css'));

        View::keep(path::appViews('footer.php'), array(), 'footer');

        #View::setlayout(path::appViews('default.layout.php'));
        View::show(View::getLayout(), array());
        die();
    }

}
