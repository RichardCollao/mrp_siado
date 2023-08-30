<?php

/**
 * Esta obra está licenciada bajo la Licencia Creative 
 * Commons Atribución-CompartirIgual 4.0 Internacional. 
 * @license    http://creativecommons.org/licenses/by-sa/4.0/deed.es_CL
 * @author     Richard Collao Olivares <http://www.richardcollao.cl>
 */
abstract class View {

    // Arreglo que contiene las distintas vistas agrupadas segun la seccion que usan dentro del layout.
    private static $_container = array();
    // Nombre del layout, que por defecto es default
    private static $_layout = null;
    // Este array contiene los nombres de vistas opcionales es decir si no se encuentra la clase no lanzara un error.
    private static $_optional_views = array('notice', 'msgbox', 'content');

    /**
     * Captura las vistas, y las devuelve como un string.
     * $file contiene el nombre del archivo o vista y $data los parametros que se le pasan a la vista.
     */
    private static function _capture($file, $data) {
        ob_start();
        require_once($file);
        $view = ob_get_contents();
        ob_end_clean();
        return $view;
    }

    /**
     * Guarda la vista en un array contenerdor cuyo indice sera el nombre del archivo o $alias si es definido,
     * ejemplo View::keep('head_1.phtml', $data, $alias = 'head')
     */
    public static function keep($file, $data = array(), $alias) {
        // Captura la vista.
        $view = self::_capture($file, $data);
        // Si no hay un alias toma el nombre del archivo.
        is_empty($alias) ? $key = $file : $key = $alias;
        // Guarda la vista en el contenedor.
        self::$_container[$key][] = $view . PHP_EOL;
    }

    /**
     * Devuelve el contenido de la vista como una cadena.
     * ejemplo $footer = View::extract('footer.php', $data)
     */
    public static function extract($file, $data = array()) {
        $view = self::_capture($file, $data);
        return $view;
    }

    /**
     * Almacena una vista desde un string en un contenedor(el contenedor es compartido con el método keep)
     * también se puede guardar una vista obtenida por extract() por lo que es posible hacer cambios sobre la marcha.
     * ejemplo: View::insert(str_replace('&', '&amp;', $footer), $alias)
     */
    public static function insert($string, $alias, $important = false) {
        if (is_empty(self::$_container[$alias])) {
            self::$_container[$alias] = array();
        }
        if ($important === false) {
            self::$_container[$alias][] = $string;
        } else {
            array_unshift(self::$_container[$alias], $string);
        }
    }

    /**
     * Recupera el contenido de una vista que se ha almacenado previamente por los metodos keep o insert
     * Al igual que el método extract devuelve un string.
     * ejemplo echo View::section('head');
     */
    public static function section($view) {
        if (!key_exists($view, self::$_container)) {
            // Excepciones para las vistas opcionales que el layout intentara cargar por defecto.
            if (in_array($view, self::$_optional_views)) {
                return '';
            }
            // Si no se encuentra la vista solicitada devuelve un mensaje de error.
            # die("No se encontro la vista solicitada <b>$view</b>.");
        } else {
            return implode('', self::$_container[$view]);
        }
    }

    /**
     * Cambia el layout por defecto.
     */
    public static function setLayout($layout) {
        self::$_layout = $layout;
    }

    /**
     * Cambia el layout por defecto.
     */
    public static function getLayout() {
        if (empty(self::$_layout)) {
            self::$_layout = path::appViews('default.layout.php');
        }
        return self::$_layout;
    }

    /**
     * Imprime directamente la vista correspondiente al archivo recibido como primer argumento
     * $file contiene el nombre del archivo o vista y $data los parametros que se le pasan a la vista.
     */
    public static function show($file, $data) {
        require_once($file);
    }

}
