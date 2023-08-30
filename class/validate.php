<?php

/**
 * Esta obra está licenciada bajo la Licencia Creative 
 * Commons Atribución-CompartirIgual 4.0 Internacional. 
 * @license    http://creativecommons.org/licenses/by-sa/4.0/deed.es_CL
 * @author     Richard Collao Olivares <http://www.richardcollao.cl>
 */
abstract class Validate {

    /**
     * Verifica la cadena mail, devuelve FALSE en caso de encontrar errores.
     */
    public static function mail($mail) {
        if (!preg_match('/^[^0-9][a-zA-Z0-9_-ñ]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+[.]([a-zA-Z0-9_]){2,4}$/', $mail)) {
            return 'La direccion de correo no es valida.';
        }
        return TRUE;
    }

    /**
     * Verifica la cadena ip, devuelve FALSE en caso de encontrar errores.
     */
    public static function ip($ip) {
        if (preg_match('/^[0-9]{1,4}\.[0-9]{1,4}\.[0-9]{1,4}\.[0-9]{1,4}$/', $ip)) {
            return TRUE;
        }
        return 'La direccion IP no es valida.';
    }

    /**
     * Verifica que el parametro recibido corresponda a una cadena hexadecimal.
     */
    public static function hexadecimal($hex) {
        if (preg_match('/^[[:xdigit:]]+$/', $hex)) {
            return TRUE;
        }
        return 'Codigo hexadecimal invalido.';
    }

}
