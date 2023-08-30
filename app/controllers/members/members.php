<?php

class MembersController extends Controller {

    protected $PermissionsHandler;
    protected $Session;
    protected $relative_path_logos;

    public function __construct() {
        parent::__construct();

        /**
         * El método setLevelbase define la base de acuerdo al nivel pasado como parámetro.
         * Esta acción afectara a todas la rutas generadas con la clase path
         * desde ahora los link relativos serán construidos desde esta base
         * amenos que se usen los operadores "/", "./" o "~" los cuales ignoran la base
         */
        path::setLevelbase(1); // Alta prioridad
        // Se incluyen las constantes utilizadas por la aplicacion
        require_once (path::appConfigs('/members/constants.php'));
        $this->PermissionsHandler = new PermissionsHandler();

        // Incluye la lista de estados de los usuarios
        $users_options = require_once (path::appConfigs('users_options.php'));
        $this->list_state_acounts = $users_options['state_acounts'];
        $this->list_type_users = $users_options['type_users'];

        // Recupera la sesion para el usuario autenticado.
        require_once (path::appControllers('/members/login/session.controller.php'));
        $this->Session = new SessionController();
        $this->Session->recoverSession();

        // Comprueba si el usuario esta autenticado.
        $this->_checkAuthenticated();
        // Comprueba que el usuario tenga permisos de administracion
        $this->_redirectAdminToCorrespondingLevel();
        if (constant('AUTHENTICATED') === true) {
            // Establece rutas importantes y relativas a cada obra 
            $this->relative_path_attachments_files = '/members/establishment_' . constant('AUTH_ESTABLISHMENT') . '/files/';
            $this->relative_path_logos = '/members/establishment_' . constant('AUTH_ESTABLISHMENT') . '/logos/';
            $this->relative_path_attachments_documents = '/members/establishment_' . constant('AUTH_ESTABLISHMENT') . '/documents/';
        }
    }

    /**
     * Comprueba si el usuario este autenticado.
     * Sino escapa el flujo del script y llama a la vista con el correspondiente mensaje de aviso.
     */
    protected function _checkAuthenticated() {
        // Evita la redireccion infinita.
        if (constant('AUTHENTICATED') !== TRUE) {
            $exeptions = array('login', 'recover', 'register');
            if (!in_array(DecomposeUrl::getRelative(1), $exeptions)) {
                redirect(Path::urlDomain('/members/login/'));
            }
        }
    }

    // Redirecciona al usuario de tipo superadmin a su nivel correspondiente
    private function _redirectAdminToCorrespondingLevel() {
        if (defined('AUTH_TYPE_USER') && constant('AUTH_TYPE_USER') == 'super_admin') {
            // Verifica que la clase no sea descendiente de AdminController y LoginController
            if (!is_a($this, 'AdmincpController') && !is_a($this, 'LoginController')) {
                redirect('/members/admincp/');
            }
        }
    }

    /**
     * Comprueba si el recurso pertenece al mismo dominio que el usuario que lo ha solicitado. 
     * Sino escapa el flujo del script y llama a la vista con el correspondiente mensaje de aviso.
     */
    protected function _checkEstablishment($id_establishment) {
        // Si no recibe un identificador $id_establishment se debe descender un nivel, hasta llegar a un nivel seguro.
        if (empty($id_establishment)) {
            redirect(path::urlDomain('./../'));
        }

        // Si el identificador recibido no concuerda con el valor nativo del usuario, se lanza una alerta
        if ($id_establishment != constant('AUTH_ESTABLISHMENT')) {
            $MsgBox = new MsgBox();
            $MsgBox->setEvent('danger');
            $MsgBox->setMessage('La accion solicitada incumple las directivas de seguridad.');
            $MsgBox->setItems(array());
            $MsgBox->saveInSession();
            unset($MsgBox);

            redirect(path::urlDomain('./'));
        }
    }

    /**
     * Comprueba si el usuario cuenta con los permisos requeridos para acceder al recurso solicitado.
     * Sino escapa el flujo del script y llama a la vista con el correspondiente mensaje de aviso.
     */
    protected function _checkPermissions() {
        $errors = array();

        $user_permissions = $this->_Model->getPermissions(array(
            'fk_id_user' => constant('AUTH_ID_USER')
        ));
        $user_rules_array = explode(';', $user_permissions['permissions']);

        $controller = DecomposeUrl::getController();

        // Reconstruye la ruta para compararla con la lista de permisos
        $current_controller = implode('/', DecomposeUrl::getAllRelative()) . '/' . DecomposeUrl::getController();

        // Si el usuario tiene definido el comodin "*" tendra permisos sobre todos 
        // los controladores que se encuentren en el mismo nivel o modulo 
        $joker = implode('/', DecomposeUrl::getAllRelative()) . '/*';

        // Primero comprueba los permisos de tipo "members/vouchers/attachments/*"
        if (!$this->PermissionsHandler->isControllerMemberOfRulesArray($joker, $user_rules_array)) {
            // Ahora se comparan los permisos especificos de tipo "members/vouchers/delete"
            if (!$this->PermissionsHandler->isControllerMemberOfRulesArray($current_controller, $user_rules_array)) {
                $errors[] = 'No tiene los permisos necesarios para acceder a esta seccion.';
            }
        }

        if (!is_empty($errors)) {
            $MsgBox = new MsgBox();
            $MsgBox->setEvent('danger');
            $MsgBox->setMessage('Antes de continuar primero debe corregir los siguientes errores.');
            $MsgBox->setItems($errors);
            $MsgBox->saveInSession();
            unset($MsgBox);

            // Si el controlador es un index y no se tienen permisos se debe bajar un nivel
            // para evitar el redireccionamiento infinito
            if ($controller == 'index' || $controller == 'lock' || $controller == 'unlock') {
                redirect(path::urlDomain('./../'));
            } else {
                // Redirecciona desde cualquier controlador al nivel actual o index oculto
                redirect(path::urlDomain('./'));
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
        Header::setCache(true);
        // Incluir Librerias
        Header::addJavascript(path::urlLibraries('/jquery-3.1.0/jquery.js'), true);
        Header::addJavascript(path::urlLibraries('/bootstrap-3.2.0/js/bootstrap.min.js'));
        Header::addSheetsCSS(path::urlLibraries('/bootstrap-3.2.0/css/bootstrap.min.css'));
        header::addJavascript(path::urlModules('/SelectMultiColumns/SelectMultiColumn.js'));
//        Header::addSheetsCSS(path::urlLibraries('/jquery-resizable-columns-gh-pages/dist/jquery.resizableColumns.css'));
//        Header::addJavascript(path::urlLibraries('/jquery-resizable-columns-gh-pages/dist/jquery.resizableColumns.js'));
        // Fontawesome
        header::addSheetsCSS(path::urlLibraries('/fontawesome-free-5.6.3-web/css/solid.min.css'));
//        header::addSheetsCSS(path::urlLibraries('/fontawesome-free-5.6.3-web/css/brands.min.css'));
//        header::addSheetsCSS(path::urlLibraries('/fontawesome-free-5.6.3-web/css/regular.min.css'));
        header::addSheetsCSS(path::urlLibraries('/fontawesome-free-5.6.3-web/css/fontawesome.min.css'));
        header::addSheetsCSS(path::urlModules('/SelectMultiColumns/SelectMultiColumn.css'));

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
