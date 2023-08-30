<?php

class CheckEnvironmentalController extends InstallController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        // Comprueba que esten las condicones para correr el sistema.
        $data['conflicts'] = $this->checkEnvironmentalRequirements();
        $this->_send($data);
        $this->_view($data);
    }

    private function _send($data) {
        if (!is_empty($data['conflicts'])) {
            $MsgBox = new MsgBox();
            $MsgBox->setEvent('warning');
            $MsgBox->setMessage('Antes de continuar con la instalacion, se deben solucionar los siguientes conflictos.');
            $MsgBox->setItems($data['conflicts']);
            $MsgBox->saveInSession();
            unset($MsgBox);
        }
    }

    /**
     * Comprueba que esten las condiciones necesarias para correr el foro.
     * devuelve un array con todos los conflictos encontrados, sino devuelve un array vacio.
     */
    public function checkEnvironmentalRequirements() {
        $conflicts = array();
//        $loaded_extensions = get_loaded_extensions();
        // Verifica que la <VERSION PHP> sea la correcta.
        if (version_compare(PHP_VERSION, constant('FW_MINIMUM_REQUIRED_PHP_VERSION'), '<')) {
            $conflicts[] = 'La version de PHP debe ser igual o superior a ' . constant('FW_MINIMUM_REQUIRED_PHP_VERSION') . ', la version actual es:' . PHP_VERSION;
        }
        // Verifica que las <COMILLAS MAGICAS> esten desactivadas.
        if (get_magic_quotes_gpc() === TRUE) {
            $conflicts['magic_quotes'] = 'Las comillas magicas est�n habilitadas, configure magic_quotes_gpc';
        }
        // Verifica que la <LIBRERIA PDO> este cargada.
        if (!extension_loaded('PDO')) {
            $conflicts[] = 'Se necesita la libreria <b>PDO</b>.';
        }
        // Verifica que la <LIBRERIA JSON> este cargada.
        if (!extension_loaded('json')) {
            $conflicts[] = 'Se necesita la libreria <b>json</b>.';
        }
        // Verifica que la <LIBRERIA GD> este cargada.
        if (!extension_loaded('gd')) {
            $conflicts[] = 'Se necesita la libreria <b>GD</b>.';
        }
        $path = path::appConfigs('/');
        if (!(getFilePermissions($path) == 755 || getFilePermissions($path) == 777)) {
            $conflicts[] = 'El directorio de "configs/" no tiene permisos de escritura.';
        }

        return $conflicts;
    }

    private function _view($data) {
        $data['minimum_required_php_version'] = constant('FW_MINIMUM_REQUIRED_PHP_VERSION');


        $data['link_next'] = Path::urlDomain('./form');
        View::keep(path::appViews('./checkenvironmental.php'), $data, 'content');
    }

}
