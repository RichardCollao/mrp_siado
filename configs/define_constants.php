<?php

if (!defined('SECURE_ACCESS')) {
    die('Sorry, direct access is not allowed!');
}

// Ip actual filtrada.
define('FW_IP_CURRENT', filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_VALIDATE_IP));

// Format 2012-12-21 compatible con MySQL.
define('FW_DATE_CURRENT', date('Y-m-d'));

// Format 2012-12-21 00:00:00 compatible con MySQL.
define('FW_DATETIME_CURRENT', date('Y-m-d H:i:s'));

// Constante que si es definida establecera la ruta donde se guardaran las sesiones.
define('FW_SESSION_SAVE_PATH', FW_DIR_SESSIONS);

#define('FW_ENVIRONMENT', 'production');
define('FW_ENVIRONMENT', 'development');