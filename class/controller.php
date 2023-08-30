<?php

abstract class Controller {

    public function __construct() {
        $this->_loadModules();
    }

    /**
     * Carga los módulos del directorio modules, necesita un archivo index en la raíz de cada modulo.
     */
    private function _loadModules() {
        $modules = getDirectories(constant('FW_DIR_PUBLIC_MODULES'));
        foreach ($modules as $module) {
            $file = constant('FW_DIR_PUBLIC_MODULES') . $module . '/index.php';
            if(file_exists($file)) {
                require_once ($file);
            }
        }
    }

    /**
     * Una vez que se ha cargado el controlador y este devuelve la linea de flujo, solo queda llamar este método
     * que volcara todas las vistas de la pagina final en pantalla.
     */
    public abstract function showPage();
}
