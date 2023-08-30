<?php

/**
 * Esta obra está licenciada bajo la Licencia Creative 
 * Commons Atribución-CompartirIgual 4.0 Internacional. 
 * @license    http://creativecommons.org/licenses/by-sa/4.0/deed.es_CL
 * @author     Richard Collao Olivares <http://www.richardcollao.cl>
 */
abstract class Validate {

    /**
     * Verifica la cadena name y devuelve FALSE en caso de encontrar errores.
     */
    public static function name($name, $min = 3, $max = 32) {
        if (strlen($name) < $min) {
            return "El campo nombre debe tener al menos $min caracteres.";
        }
        if (strlen($name) > $max) {
            return "El campo nombre no debe tener mas de $max caracteres.";
        }
        if (!preg_match('/^[^0-9][a-z0-9\-_\sñÑ]+$/i', $name)) {
            return "El nombre <b>$name</b> no es valido.";
        }
        return TRUE;
    }

    /**
     * Verifica que no sea igual a alguna palabra reservada, devuelve FALSE en caso de encontrar errores.
     */
    public static function reserverName($name) {
        // Array con palabras reservadas
        $col_reserved = array('admin', 'moderador');

        if (in_array($name, $col_reserved)) {
            return "La palabra <b>$name</b> no esta permitida.";
        }
        return TRUE;
    }

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
     * Verifica la cadena password, devuelve FALSE en caso de encontrar errores.
     */
    public static function password($password, $min = 6, $max = 20) {
        if (strlen($password) < $min) {
            return "El password debe tener al menos $min caracteres.";
        }
        if (strlen($password) > $max) {
            return "El password no debe tener mas de $max caracteres.";
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

    /**
     * 
     */
    public static function numberDecimal($number, $field = 'texto') {
        if (preg_match('/^[0-9]+(\.[0-9]+)?$/', $number)) {
            return TRUE;
        }
        return "El campo <b>$field</b> debe ser un numero entero o decimal";
    }

    //############################################################################################
    // ESTAS FUNCIONES NO SON FUNCIONES GENERICAS POR LO QUE DEBEN ESTAR EN EL CONTROLADOR RESPECTIVO 
    /**
     * Verifica la cadena text, devuelve FALSE en caso de encontrar errores.
     */


    /**
     * Verifica que la cadena contenga solo caracteres numericos, alfabeticos y espacios.
     */
    public static function observation($observation, $min = 0, $max = 512, $field = 'Observación') {
        if (strlen($observation) < $min) {
            return "El campo <b>$field</b> debe tener al menos $min caracteres.";
        }
        if (strlen($observation) > $max) {
            return "El campo <b>$field</b> no puede tener mas de $max caracteres.";
        }
        return TRUE;
    }

    public static function address($address, $min = 0, $max = 255, $field = 'direccion') {
        if (strlen($address) < $min) {
            return "El campo <b>$field</b> debe tener al menos $min caracteres.";
        }
        if (strlen($address) > $max) {
            return "El campo <b>$field</b> no puede tener mas de $max caracteres.";
        }
        if (!preg_match('/^[0-9a-záéíóúüñÁÉÍÓÚÜÑ\s,\/\.#\-_\°]+$/i', $address)) {
            return "El campo <b>$field</b> no es valido, caracteres pemitidos espacios, a-z0-9/.,#-_";
        }
        return TRUE;
    }

    public static function phone($phone, $min = 3, $max = 32, $field = 'telefono') {
        if (strlen($phone) < $min) {
            return "El campo <b>$field</b> debe tener al menos $min caracteres.";
        }
        if (strlen($phone) > $max) {
            return "El campo <b>$field</b> no puede tener mas de $max caracteres.";
        }
        if (!preg_match('/^[0-9\.\-\s\#\(\)]*$/', $phone)) {
            return "El campo <b>$field</b> no es valido, caracteres pemitidos espacios, 0-9.#-()";
        }
        return TRUE;
    }

    public static function contact($contact, $min = 3, $max = 256, $field = 'contacto') {
        if (strlen($contact) < $min) {
            return "El campo <b>$field</b> debe tener al menos $min caracteres.";
        }
        if (strlen($contact) > $max) {
            return "El campo <b>$field</b> no puede tener mas de $max caracteres.";
        }
        return TRUE;
    }

}
