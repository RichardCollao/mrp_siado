<?php

final class SessionController {

    private $_http_user_agent;
    private $_time_life_connect;

    public function __construct() {
        // Carga el modelo correspondiente
        require_once (path::appModels('login/session.php'));
        $this->_Model = new SessionModel();

        // Constante encargada de determinar el tiempo de vida de una conexion
        $this->_time_life_connect = 60 * 15; // Valor expresado en segundos
        // User agent  filtrada para evitar inyeccion SQL.
        $http_user_agent = filter_input(INPUT_SERVER, 'HTTP_USER_AGENT', FILTER_SANITIZE_ENCODED, FILTER_FLAG_STRIP_LOW);

        // Establece el largo maximo del string a 256  caracteres.
        $this->_http_user_agent = substr($http_user_agent, 0, 255);
    }

    // Actualiza los datos de la sessions
    public function createSessions(array $user_auth) {
        $values = array(
            'id_user' => $user_auth['id_user'],
            'session_id' => md5(uniqid(rand(), TRUE)),
            'user_agent' => $this->_http_user_agent,
            'ip_current' => constant('FW_IP_CURRENT'),
            'date_current' => constant('FW_DATETIME_CURRENT'),
            'connection_status' => TRUE
        );

        // Se crea la sesion login que contiene el id del usuario y un codigo para comprobar con la base de datos.
        $_SESSION['session_id'] = $values['session_id'];

        // Actualiza los datos dentro de la tabla sesions.
        return $this->_Model->updateSessions($values);
    }

    /**
     * Este metodo se encarga de cargar los datos de session.
     * Luego llama al metodo loadUserAuth y se definen las constantes:
     */
    final public function recoverSession() {
        if (!is_empty($_SESSION['session_id'])) {
            if (!preg_match('/^[[:xdigit:]]+$/', $_SESSION['session_id'])) {
                throw new exception('Se ha encontrado un problema grabe de seguridad.');
                exit();
            }

            // Obtiene una nueva fecha menos el intervalo de tiempo que dura la session;
            $margin_life = addInterval(constant('FW_DATETIME_CURRENT'), $this->_time_life_connect . ' seconds');

            // Busca el registro dentro de la base de datos si la session es valida devuelve el fk_id_user.
            $session_db = $this->_Model->loadSessions($_SESSION['session_id'], $this->_http_user_agent, constant('FW_IP_CURRENT'), $margin_life);

            // Validar la session
            if (!is_empty($session_db)) {
                // Actualiza la tabla session para registrar la ultima acividad
                $this->_Model->setLastActivity(constant('FW_DATETIME_CURRENT'), $session_db['fk_id_user']);

                // Carga los parametros del usuario authenticado.
                $user = $this->_Model->loadUserAuth($session_db['fk_id_user']);

                // Define las constantes AUTH_ para el usuario autenticado.
                define('AUTHENTICATED', TRUE);
                define('AUTH_ID_USER', $user['id_user']);
                define('AUTH_NAME', $user['name']);
                define('AUTH_MAIL', $user['mail']);
                define('AUTH_PHONE', $user['phone']);
                define('AUTH_STATE_ACOUNT', $user['state_acount']);
                define('AUTH_TYPE_USER', $user['type_user']);
                define('AUTH_DATE_REG', $user['date_reg']);
                define('AUTH_LAST_LOGON', $user['last_logon']);
                define('AUTH_ESTABLISHMENT', $user['fk_id_establishment']);
                define('AUTH_NAME_ESTABLISHMENT', $user['name_establishment']);
                define('AUTH_ADDRESS_ESTABLISHMENT', $user['address_establishment']);
                return TRUE;
            }
        }
        define('AUTHENTICATED', FALSE);
        return FALSE;
    }

}
