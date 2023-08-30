<?php

/**
 * Esta obra esta licenciada bajo la Licencia Creative
 * Commons Atribucó-CompartirIgual 4.0 Internacional.
 * @license     http://creativecommons.org/licenses/by-sa/4.0/deed.es_CL
 * @author      Richard Collao Olivares <http://www.richardcollao.cl>
 */
abstract class DecomposeUrl {

    // Directorio de los controladores.
    private static $_ROOT_CONTROLLERS;
    // Contiene los segmentos de la URL otorgados por la clase SegementUrl::getAllSegments
    private static $_segments;
    // Contendra la ruta relativa hasta el controlador.
    private static $_relative;
    // Controlador.
    private static $_controller;
    // Argumentos.
    private static $_arguments;

    public static function initialize($ROOT_CONTROLLERS, $segments) {
        self::$_ROOT_CONTROLLERS = $ROOT_CONTROLLERS;
        self::$_segments = $segments;
        self::$_relative = array();
        self::$_controller = null;
        self::$_arguments = array();

        // Define los segmentos en: ruta relativa, controlador y argumentos.
        self::_defineSegments();

        // Test
        #printArray(get_class_vars('DecomposeUrl'));
    }

    /**
     * Define los segmentos en: ruta relativa, controlador y argumentos.
     */
    private static function _defineSegments() {
        $clon = self::$_segments;

        // Busca a traves de los segmentos el controlador
        while (is_empty(self::$_controller)) {
            self::_findController(self::$_segments[0]);
        }

        // Define los argumentos.
        self::$_arguments = self::$_segments;
        self::$_segments = $clon;
    }

    /**
     * Busca a traves de los segmentos el controlador
     * 1 busca un archivo con el nombre del segmento
     * 2 busca una carpeta con el nombre del segmento
     * 3 busca si existe una carpeta index
     */
    private static function _findController($segment = 'index') {
        $path = self::$_ROOT_CONTROLLERS . self::implodeRelative('/');

        # printFormat(get_defined_vars(true));
        if (!is_empty($segment)) {
            if (file_exists($path . $segment . '.php')) {
                #echo "F<br />";
                // El segmento corresponde a un archivo.
                self::$_controller = $segment;
                array_shift(self::$_segments);
            } elseif (is_dir($path . $segment)) {
                #echo "D<br />";
                // El segmento corresponde a un directorio.
                self::$_relative[] = $segment;
                array_shift(self::$_segments);
            } elseif (file_exists($path . 'index.php')) {
                #echo "I<br />";
                // El segmento no corresponde a un directorio o archivo, pero existe un index
                // generalmente cuando la url contiene argumentos como page, etc.
                self::$_controller = 'index';
            }
        } elseif (file_exists($path . 'index.php')) {
            // No hay segmento pero existe un index
            self::$_controller = 'index';
        }
    }

    /**
     * Devuelve el valor del indice solicitado.
     */
    public static function getRelative($key) {
        return self::$_relative[$key];
    }

    /**
     * Devuelve un array con todos los segmentos de la ruta relativa.
     */
    public static function getAllRelative() {
        return self::$_relative;
    }

    /**
     * Retorna el controlador
     */
    public static function getController() {
        return self::$_controller;
    }

    /**
     * Devuelve el valor del indice solicitado.
     */
    public static function getArgument($key) {
        return self::$_arguments[$key];
    }

    /**
     * 
     * @param type $key
     * @return type
     * @deprecated since version 2.0
     */
    public static function getArgumentKeyValue($key) {
        $p = explode('=', self::$_arguments[$key]);
        return array($p[0] => $p[1]);
    }

    /**
     * Devuelve un array con todos los argumentos.
     */
    public static function getAllArguments() {
        return self::$_arguments;
    }

    /**
     * Devuelve una cadena con la ruta relativa, recibe como parametro el caracter a usar como separador.
     */
    public static function implodeRelative($separator = '/') {
        if (!is_empty(self::$_relative)) {
            return implode($separator, self::$_relative) . $separator;
        } else {
            return '';
        }
    }

}
