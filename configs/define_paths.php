<?php

define('FW_DIR_APP', FW_DIR_ROOT . 'app/'); # Important
define('FW_DIR_CLASS', FW_DIR_ROOT . 'class/');
define('FW_DIR_CONFIGS', FW_DIR_ROOT . 'configs/');
define('FW_DIR_PUBLIC', FW_DIR_ROOT . 'public/'); # Important
define('FW_DIR_SESSIONS', FW_DIR_ROOT . 'sessions/');

// Rutas dentro de la carpeta aplicacion correspondientes a MVC. 
define('FW_DIR_APP_CONTROLLERS', FW_DIR_APP . 'controllers/');
define('FW_DIR_APP_MODELS', FW_DIR_APP . 'models/');
define('FW_DIR_APP_RESOURCES', FW_DIR_APP . 'resources/');
define('FW_DIR_APP_VIEWS', FW_DIR_APP . 'views/');
define('FW_DIR_APP_CONFIGS', FW_DIR_APP . 'configs/');
define('FW_DIR_APP_CLASS', FW_DIR_APP . 'class/');

define('FW_DIR_PUBLIC_IMAGES', FW_DIR_PUBLIC . 'images/');
define('FW_DIR_PUBLIC_LIBRARIES', FW_DIR_PUBLIC . 'libraries/');
define('FW_DIR_PUBLIC_MODULES', FW_DIR_PUBLIC . 'modules/');
define('FW_DIR_PUBLIC_RESOURCES', FW_DIR_PUBLIC . 'resources/');

// Rutas en la carpeta publica.
define('FW_URL_DOMAIN', 'http://' . filter_input(INPUT_SERVER, 'SERVER_NAME') . '/');
define('FW_URL_PUBLIC', FW_URL_DOMAIN . 'public/');
define('FW_URL_DOMAIN_CSS', FW_URL_PUBLIC . 'css/');
define('FW_URL_DOMAIN_JS', FW_URL_PUBLIC . 'js/');
define('FW_URL_DOMAIN_IMAGES', FW_URL_PUBLIC . 'images/');
define('FW_URL_DOMAIN_LIBRARIES', FW_URL_PUBLIC . 'libraries/');
define('FW_URL_DOMAIN_MODULES', FW_URL_PUBLIC . 'modules/');
define('FW_URL_DOMAIN_RESOURCES', FW_URL_PUBLIC . 'resources/');

