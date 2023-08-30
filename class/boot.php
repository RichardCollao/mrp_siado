<?php

/**
 * Esta obra esta licenciada bajo la Licencia Creative 
 * Commons Atribución-CompartirIgual 4.0 Internacional. 
 * @license     http://creativecommons.org/licenses/by-sa/4.0/deed.es_CL
 * @author      Richard Collao Olivares <http://www.richardcollao.cl>
 */
class Boot {

    public function __construct() {
        //  Inicializa la clase que define cada segmento de la URL.
        DecomposeUrl::initialize(constant('FW_DIR_APP_CONTROLLERS'), $this->getUri());
        Path::initialize();
    }

    public function index() {
        // Incluye clase necesarias para el controlador.
        $this->_autoIncludeControllers();

        // Llama al controlador
        $this->_callStack();
    }

    /**
     * Recorre desde la raíz del directorio aplications hasta el nivel del directorio
     * donde se encontró el controlador incluyendo automáticamente todos los archivos
     * que contengan el sufijo pasado como argumento.
     */
    private function _autoIncludeControllers() {
        $path = '';

        // Carga archivos que tengan el mismo nombre de la carpeta raiz
        if (is_readable(constant('FW_DIR_APP_CONTROLLERS') . 'app.php')) {
            require_once (constant('FW_DIR_APP_CONTROLLERS') . 'app.php');
            require_once (constant('FW_DIR_APP_MODELS') . 'app.php');
        }
        // ---
        // Recorre los segmentos
        foreach (DecomposeUrl::getAllRelative() as $segment) {
            $path .= $segment . '/';
            $controller = constant('FW_DIR_APP_CONTROLLERS') . $path . $segment . '.php';
            $model = constant('FW_DIR_APP_MODELS') . $path . $segment . '.php';

            if (is_readable($controller)) {
//              echo "require($controller)<br />";
                require_once ($controller);
//                echo "require($model)<br />";
                require_once ($model);
            }
        }
    }

    /**
     * Carga el controlador.
     */
    private function _callStack() {
        $controller = constant('FW_DIR_APP_CONTROLLERS') . DecomposeUrl::implodeRelative('/') . DecomposeUrl::getController() . '.php';
        $model = constant('FW_DIR_APP_MODELS') . DecomposeUrl::implodeRelative('/') . DecomposeUrl::getController() . '.php';

        if (is_readable($controller)) {
            require_once ($controller);
        }

        if (is_readable($model)) {
            #echo "model__ $model<br />";
            require_once ($model);
        }

        //  Quita los guiones bajos y formatea la cadena a la notacion UpperCamelCase. Ejemplo: mi_class to MiClass
        $ClassController = DecomposeUrl::getController() . 'Controller';
        // Pensando si es posible inyectarlo $ClassModel = DecomposeUrl::getController() . 'Model';
        $Obj = new $ClassController();
        //  Pasa el flujo al index del controlador.

        $Obj->index();

        // 

        $Obj->showPage();

        //  Finaliza la pagina.
        die();
    }

    public function getUri($uri = '') {
        $uri = strtolower(trim($uri));
        $_segments = array();

        if (is_empty($uri)) {
            $uri = strtolower(trim($_SERVER['REQUEST_URI']));
        }

        if (!is_empty($uri)) {
            // Reemplaza todos los caracteres que no sean:
            $uri = preg_replace('#[^_a-z0-9\/\.\-\=]#', '', $uri);

            // No permite los sig. caracteres dobles.
            $uri = preg_replace('#//+#', '/', $uri);
            $uri = preg_replace('#--+#', '-', $uri);
            $uri = preg_replace('#__+#', '_', $uri);

            // No puede terminar en / - _
            $uri = preg_replace('#(/|-|_)$#', '', $uri);

            // Segmenta la uri pero aun asi es posible que queden segmentos vacios.
            $segments = explode('/', $uri);

            // Ignora los elementos vacios y omite las posibles cadenas index.
            foreach ($segments as $segment) {
                if ($segment != 'index' && !is_empty($segment)) {
                    $_segments[] = $segment;
                }
            }
        }

        return $_segments;
    }

}
