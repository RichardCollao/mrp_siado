<?php

#error_reporting(0);
error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors", true);

// Define zona horaria
date_default_timezone_set('Chile/Continental');

// Constante usada para prevenir que los scripts sean llamados desde fuera de la aplicacion.
define('SECURE_ACCESS', TRUE);

// La constante DS toma el valor del separador de directorios correspondiente al sistema operativo.
define('DS', constant('DIRECTORY_SEPARATOR'));

// Ruta donde se encuentra la raiz de la aplicacion.
define('FW_DIR_ROOT', str_replace('\\', '/', realpath(dirname(__FILE__)) . '/'));

/**
 *  Archivos necesarios para permitir el arranque inicial
 *  NOTA:Se debe respetar el orden establecido.
 */
require(FW_DIR_ROOT . 'configs/define_paths.php');
require(FW_DIR_ROOT . 'configs/define_constants.php');

require(FW_DIR_ROOT . 'functions.php');
require(FW_DIR_ROOT . 'helpers.php');

require(FW_DIR_CONFIGS . 'session.php');
require(FW_DIR_CONFIGS . 'requirements.php');

require_once (constant('FW_DIR_CLASS') . 'debug.php');
require_once (constant('FW_DIR_CLASS') . 'boot.php');
require_once (constant('FW_DIR_CLASS') . 'path.php');
require_once (constant('FW_DIR_CLASS') . 'decomposeurl.php');

/**
 * Manejador para la carga automática de clases
 */
spl_autoload_register(function( $class ) {
    $file = strtolower($class) . ".php";

    if (file_exists(path::appClass('./' . $file))) {
        require_once(path::appClass('./' . $file));
    } else if (file_exists(path::appClass($file))) {
        require_once(path::appClass($file));
    } else if (file_exists(path::appClass('/' . $file))) {
        require_once(path::appClass('/' . $file));
    } else if (file_exists(constant('FW_DIR_CLASS') . $file)) {
        require_once(constant('FW_DIR_CLASS') . $file);
    }
});

/**
 * Comprueba si la directiva magic_quotes esta activa para revertir sus cambios.
 * magic_quotes_gpc ha sido declarada OBSOLETA desde PHP 5.3.0 y ELIMINADA a partir de PHP 5.4.0.
 */
if (get_magic_quotes_gpc() == 1) {
    $_GET = &fixMagicQuotes($_GET);
    $_POST = &fixMagicQuotes($_POST);
    $_COOKIE = &fixMagicQuotes($_COOKIE);
}

// Incluye las librerias gestionadas mediante composer
# require FW_DIR_ROOT . 'vendor/autoload.php';

$Boot = new Boot();
$Boot->index();
