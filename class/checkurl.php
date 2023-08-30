<?php

/**
 * Esta obra está licenciada bajo la Licencia Creative 
 * Commons Atribucó-CompartirIgual 4.0 Internacional. 
 * @license    http://creativecommons.org/licenses/by-sa/4.0/deed.es_CL
 * @author     Richard Collao Olivares <http://www.richardcollao.cl>
 */
abstract class CheckUrl {

    private static $_args = array();

    /**
     * Devuelve una cadena con la direccion correcta formada por los parametros recibidos anteriormente.
     */
    private static function getCurrentUrl() {
        return 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    }

    /**
     * Devuelve una cadena con la direccion correcta formada por los parametros recibidos anteriormente.
     */
    private static function getCorrectUrl() {
        // La url se comienza formando por el dominio/.
        $correct_url = constant('FW_URL_DOMAIN');
        // Array que contiene todos los segmentos de la Url.
        $parts = DecomposeUrl::getAllRelative();
        // Quitar los segmentos index.
        $parts = arrayPurge('index', $parts);
        // Une las partes reservadas y relativas.
        $correct_url.= implode('/', $parts);
        if (!is_empty($parts)) {
            $correct_url.= '/';
        }
        // El controlador solo se muestra sino es index
        if (DecomposeUrl::getController() != 'index') {
            $correct_url.= DecomposeUrl::getController();
            // Si no existen argumentos se agrega el slash 
            if (!is_empty(self::$_args)) {
                $correct_url.= '/';
            }
        }

        // Une los argumentos.
        if (!is_empty(self::$_args)) {
            $correct_url.= implode('/', self::$_args);
        }

        return $correct_url;
    }

    /**
     * Compara la url actual con la url correcta segun los parametros recibidos.
     * recibe 0 a mas argumetos segun la url formada.
     */
    public static function comprobate() {
        // Si existen argumentos se capturan para generar la url correcta.
        self::$_args = (array) array_filter(func_get_args());

        // Compara la url actual con la correcta sino coinciden redirecciona a la correcta.
        if (self::getCorrectUrl() != self::getCurrentUrl()) {
            /*
              echo 'actual = ' . self::getCurrentUrl() . '<br />';
              echo 'correcta = ' . self::getCorrectUrl() . '<br />';
              echo '<a href="' . self::getCorrectUrl() . '">' . self::getCorrectUrl() .'</a>';
              exit();
             */
            if (constant('URL_AUTO_CORRECT') === TRUE) {
                redirect(self::getCorrectUrl());
            }
        }
    }

}
