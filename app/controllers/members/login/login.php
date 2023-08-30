<?php

class LoginController extends MembersController {

    private $_lock_timeout = '2 minutes';
    private $_attempts_allowed = 3;

    public function __construct() {
        parent::__construct();

        require_once (path::appModels('./login.php'));
        $this->_Model = new LoginModel();
        
        view::setLayout(path::appViews('./default.layout.php'));

        // Comprueba que existan las variables de sesion para evitar errores.
        if (is_empty($_SESSION['login']['block_date'])) {
            $_SESSION['login']['block_date'] = '';
        }
        if (is_empty($_SESSION['login']['attempts_date'])) {
            $_SESSION['login']['attempts_date'] = array();
        }
    }

    // Agrega un registro con la fecha del intento fallido.
    protected function _addLoginFailedDate() {
        // Agrega la fecha actual al final del array
        array_push($_SESSION['login']['attempts_date'], constant('FW_DATETIME_CURRENT'));
        // Mantiene la cantidad de elementos del arreglo.
        if (count($_SESSION['login']['attempts_date']) > $this->_attempts_allowed) {
            $_SESSION['login']['attempts_date'] = array_slice($_SESSION['login']['attempts_date'], -$this->_attempts_allowed);
        }

        // Comprueba si la cantidad de intentos fallidos supera el limite permitido.
        if ($this->_countAttemptsFailed() >= $this->_attempts_allowed) {
            // Establece como el bloqueo de acuerdo la hora actual.
            $_SESSION['login']['block_date'] = constant('FW_DATETIME_CURRENT');
            // Resetea el número de intentos.
            $_SESSION['login']['attempts_date'] = array();
        }
    }

    // Cuenta la cantidad de intentos fallidos dentro del limite de tiempo permitido.
    private function _countAttemptsFailed() {
        $attempts_failed = 0;
        foreach ($_SESSION['login']['attempts_date'] as $date) {
            if ($date > subInterval(constant('FW_DATETIME_CURRENT'), $this->_lock_timeout)) {
                $attempts_failed += 1;
            }
        }
        return $attempts_failed;
    }

    // Devuelve TRUE en caso que el intento de login este bloqueado.
    protected function _isBlockLogin() {
        if (!is_empty($_SESSION['login']['block_date'])) {
            // Comprueba que la hora actual supere la hora de bloque mas la penalizacion.
            if (constant('FW_DATETIME_CURRENT') > addInterval($_SESSION['login']['block_date'], $this->_lock_timeout)) {
                $_SESSION['login']['block_date'] = '';
            } else {
                return TRUE;
            }
        }
        return FALSE;
    }

    // Devuelve un mensaje descriptivo correspondiente al estado de la seguridad de bloqueo.
    protected function _lockStatusMessage() {
        if ($this->_isBlockLogin() === TRUE) {
            $lapsed = lapseTimeNice(constant('FW_DATETIME_CURRENT'), addInterval($_SESSION['login']['block_date'], $this->_lock_timeout));
            return 'Se ha superado la cantidad de intentos, debe esperar <b>' . $lapsed . '</b> para volver a intentarlo.';
        } else {
            $attempts_remaining = $this->_attempts_allowed - $this->_countAttemptsFailed();
            return 'Intentos restantes ' . $attempts_remaining;
        }
    }

}
