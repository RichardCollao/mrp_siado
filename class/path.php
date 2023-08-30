<?php

abstract class Path {

    private static $_relative;
    private static $_base;

    public static function initialize() {
        self::$_relative = DecomposeUrl::getAllRelative();
        self::$_base = array();
    }

    public static function setLevelbase($level) {
        // Extrae una parte del array comienza desde cero hasta el nivel requerido. 
        self::$_base = array_slice(self::$_relative, 0, $level);
    }

    // Retorna la parte relativa de la ruta
    public static function make($path = '') {
        /**
         * Sino se define una base las rutas pasadas sin símbolo se establecen en el
         * mismo nivel del controlador principal.
         */
        if (!is_empty(self::$_base)) {
            $relative = self::$_base;
        } else {
            $relative = self::$_relative;
        }

        /**
         * símbolo que establece la ruta en el nivel de raíz.
         */
        if (substr($path, 0, 1) == '/') {
            $relative = array();
            $path = substr($path, 1);
        }
        /**
         * símbolo extraordinario que establece la ruta relativa al mismo nivel del controlador
         * del cual se hace la llamada a este método.
         */ elseif (substr($path, 0, 2) == '~/') {
            $backtrace = debug_backtrace();
            $pathinfo = pathinfo($backtrace[1]['file']);
            $relative = explode('/', substr($pathinfo['dirname'], strlen(FW_DIR_APP_CONTROLLERS)));
            $path = substr($path, 2);
        }
        /**
         * símbolo que establece la ruta al mismo nivel que el controlador principal.
         */ elseif (substr($path, 0, 2) == './') {
            $relative = self::$_relative;
            $path = substr($path, 2);
        }
        /**
         * símbolo que desciende un nivel en el árbol de directorios.
         */
        while (substr($path, 0, 3) == '../') {
            array_pop($relative);
            $path = substr($path, 3);
        }

        $result = implodeWithSufix('/', $relative);

        return $result . $path;
    }

    public static function relative($path = '') {
        return self::make($path);
    }

    /**
     * Los siguientes métodos son opcionales y son
     * utilizados para generar las rutas mas usadas dentro del framework
     */
    public static function appClass($path = '') {
        return FW_DIR_APP_CLASS . self::make($path);
    }

    public static function appConfigs($path = '') {
        return FW_DIR_APP_CONFIGS . self::make($path);
    }

    public static function appControllers($path = '') {
        return FW_DIR_APP_CONTROLLERS . self::make($path);
    }

    public static function appModels($path = '') {
        return FW_DIR_APP_MODELS . self::make($path);
    }

    public static function appResources($path = '') {
        return FW_DIR_APP_RESOURCES . self::make($path);
    }

    public static function appViews($path = '') {
        return FW_DIR_APP_VIEWS . self::make($path);
    }
    
    public static function dirPublicLibraries($path = '') {
        return FW_DIR_PUBLIC_LIBRARIES . self::make($path);
    }

    public static function dirPublicModules($path = '') {
        return FW_DIR_PUBLIC_MODULES . self::make($path);
    }

    public static function dirPublicResources($path = '') {
        return FW_DIR_PUBLIC_RESOURCES . self::make($path);
    }

    public static function urlDomain($path = '') {
        return FW_URL_DOMAIN . self::make($path);
    }

    public static function urlCss($path = '') {
        return FW_URL_DOMAIN_CSS . self::make($path);
    }

    public static function urlImages($path = '') {
        return FW_URL_DOMAIN_IMAGES . self::make($path);
    }

    public static function urlJs($path = '') {
        return FW_URL_DOMAIN_JS . self::make($path);
    }

    public static function urlLibraries($path = '') {
        return FW_URL_DOMAIN_LIBRARIES . self::make($path);
    }

    public static function urlModules($path = '') {
        return FW_URL_DOMAIN_MODULES . self::make($path);
    }

    public static function urlResources($path = '') {
        return FW_URL_DOMAIN_RESOURCES . self::make($path);
    }

}
