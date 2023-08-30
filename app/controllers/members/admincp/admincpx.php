<?php

class AdmincpController extends Controller {

    public function __construct() {
        parent::__construct();

        /**
         * El metodo setLevelbase define la base de acuerdo al nivel pasado como parametro.
         * Esta accion afectara a todas la rutas generadas con la clase path
         * desde ahora los link relativos seran construidos desde esta base
         * almenos que se usen los operadores "/", "./" o "~" los cuales ignoran la base
         */
        path::setLevelbase(1); // Alta prioridad 
        // Se incluyen las constantes utilizadas por la aplicacion
        require_once (path::appConfigs('/members/constants.php'));
        $this->PermissionsHandler = new PermissionsHandler();

        // Incluye la lista de estados de los usuarios
        $users_options = require_once (path::appConfigs('users_options.php'));
        $this->list_state_acounts = $users_options['state_acounts'];
        $this->list_type_users = $users_options['type_users'];

        // Comprueba si el usuario esta autenticado.
        require_once (path::appControllers('login/session.controller.php'));
        $this->Session = new SessionController();
        $this->Session->recoverSession();

        // Comprueba si el usuario esta autenticado.
        $this->_checkAuthenticated();
        // Comprueba que el usuario tenga permisos de administracion
        $this->_isAuthSuperAdmin();
    }

    private function _isAuthSuperAdmin() {
        if (defined('AUTH_TYPE_USER') && constant('AUTH_TYPE_USER') == 'super_admin') {
            // Verifica que la clase no sea descendiente de AdminController y LoginController
            if (!is_a($this, 'AdmincpController') && !is_a($this, 'LoginController')) {
                redirect('/members/admincp/');
            }
        }
    }

    /**
     * Comprueba que el usuario este autenticado sino escapa el flujo del escript y llama a la vista.
     * con el mensaje de aviso.
     */
    protected function _checkAuthenticated() {
        // Evita la redireccion infinita.
        if (constant('AUTHENTICATED') !== TRUE) {
            if (DecomposeUrl::getRelative(1) != 'login' && DecomposeUrl::getRelative(1) != 'recover') {
                redirect(Path::urlDomain('login/'));
            }
        }
    }

    /**
     * Una vez que se ha cargado el controlador y este devuelve la linea de flujo, solo queda llamar este metodo
     * que volcara todas las vistas de la pagina final en pantalla.
     */
    public function showPage() {
        // Inserta los mensajes en el contenedor de la clase View. No mover de aca.
        ViewMsgBox::initialize();
        // Definir titulo y favicon
        Header::setTitle('..:: SIADO ::..');
        Header::setFavicon(path::urlImages('/favicon.png'));
        // Incluir Librerias
        Header::addJavascript(path::urlJs('/functions.js'));
        Header::addJavascript(path::urlLibraries('/jquery-3.1.0/jquery.js'), true);
        Header::addJavascript(path::urlLibraries('/bootstrap-3.2.0/js/bootstrap.min.js'));
        Header::addSheetsCSS(path::urlLibraries('/bootstrap-3.2.0/css/bootstrap.min.css'), true);

        // Fontawesome
        header::addSheetsCSS(path::urlLibraries('/fontawesome-free-5.6.3-web/css/solid.min.css'));
//        header::addSheetsCSS(path::urlLibraries('/fontawesome-free-5.6.3-web/css/brands.min.css'));
//        header::addSheetsCSS(path::urlLibraries('/fontawesome-free-5.6.3-web/css/regular.min.css'));
        header::addSheetsCSS(path::urlLibraries('/fontawesome-free-5.6.3-web/css/fontawesome.css'));

        // Agrega el estilo definido el la clase statica helpers encargada de dibujar los botones 
        header::addEmbedStylesCSS(HelperWebIconFontAwesome::getStyle());

        if (AUTHENTICATED === TRUE) {
            $data = array(
                'auth_name' => constant('AUTH_NAME'),
                'name_establishment' => constant('AUTH_NAME_ESTABLISHMENT'),
                'link_out' => Path::urlDomain('login/out')
            );
            View::keep(path::appViews('navbar.php'), $data, 'navbar');
        }

        View::keep(path::appViews('footer.php'), array(), 'footer');
        View::show(View::getLayout(), array());
        die();
    }

}
