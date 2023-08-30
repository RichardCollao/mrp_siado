<?php

define('SECURE_ACCESS', FALSE);

// Obtiene la ruta real del directorios raiz.
$DOCUMENT_ROOT = substr($_SERVER['SCRIPT_FILENAME'], 0, 0 - strlen($_SERVER['PHP_SELF']));
$DOCUMENT_ROOT = str_replace('\\', '/', realpath($DOCUMENT_ROOT) ) . '/';


// Incluye los archivos necesarios para obtener la configuracion de las sesiones.
define('FW_DIR_ROOT', $DOCUMENT_ROOT) ;
require_once($DOCUMENT_ROOT . 'configs/define_paths.php');
require_once($DOCUMENT_ROOT . 'configs/define_constants.php');
require_once($DOCUMENT_ROOT . 'configs/session.php');

// Incluye la clase captcha y genera una imagen.
require_once('captcha.php');
Captcha::create();
die();