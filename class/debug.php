<?php

abstract class Debug {

    /**
     * Muestra un print_r formateado
     */
    public static function printRF($arr) {
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }

    public static function info() {
        // Devuelve un array asociativo con los nombres de todas las constantes y sus valores
        echo 'get_defined_constants()';
        Debug::printRF(get_defined_constants(true)['user']);
        // Devuelve un array que se compone de una lista de argumentos de función
        echo 'func_get_args()';
        Debug::printRF(func_get_args());
        // Devuelve una matriz con todas las variables definidas 
        echo 'get_defined_vars';
        Debug::printRF(get_defined_vars(true)); // Debe incluirse dentro de la funcion
        // Devuelve una matriz de todas las funciones definidas
        echo 'get_defined_functions()';
        Debug::printRF(get_defined_functions()['user']);
    }

    public static function backtrace() {
        self::printRF(debug_backtrace());
    }

    public static function log($line) {
        $fp = fopen(FW_DIR_ROOT . "/log.txt", "a+");
        $put = date('H:i:s') . " - " . $line;
        echo $line;
        fputs($fp, $put);
        fclose($fp);
    }
}
