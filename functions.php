<?php

/**
 * Devuelve True en caso que la petición sea hecha con Ajax o false en el caso contrario.
 * Es necesario enviar la siguiente cabecera desde javascript: ajax.setRequestHeader("X-Requested-With", "XMLHttpRequest");
 */
function isAjax() {
    if (!is_empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        return true;
    } else {
        return false;
    }
}

/**
 * Agrega un lapso de tiempo a la fecha.
 * $datatime, fecha base sobre la que se agregara el intervalo. "2012-12-21 00:00:00"
 * $str_interval, cadena que contiene el intervalo de tiempo Ejemplo: "1 day + 12 hours"
 * years, months, weeks, day, hours, minutes, seconds
 */
function addInterval($datatime, $str_interval) {
    $date2 = new DateTime($datatime);
    # php 5.3 >
    # $date2->add(DateInterval::createFromDateString($str_interval));
    # php 5.2 (Medida momentanea para correr el foro en PHP 5.2)
    $date2->modify($str_interval);

    $new_date = $date2->format('Y-m-d H:i:s');
    return $new_date;
}

/**
 * Resta un lapso de tiempo a la fecha.
 * $datatime fecha base sobre la que se agregara el intervalo.
 * $str_interval cadena que contiene el intervalo de tiempo Ejemplo: 1 day + 12 hours
 * years, months, weeks, day, hours, minutes, seconds
 */
function subInterval($datatime, $str_interval) {
    $date2 = new DateTime($datatime);
    # php 5.3 >
    # $date2->sub(DateInterval::createFromDateString($str_interval));
    # php 5.2 (Medida momentanea para correr el foro en PHP 5.2)
    $date2->modify('-' . $str_interval);

    $new_date = $date2->format('Y-m-d H:i:s');
    return $new_date;
}

/**
 * Recibe dos fechas y devuelve el lapso entre ambas en formato timestamp.
 * %   Literal
 * Y 	Años, numérico, al menos 2 dígitos empezando con 0
 * y 	Años, numérico
 * M 	Meses, numérico, al menos 2 dígitos empezando con 0
 * m 	Meses, numérico
 * D 	Días, numérico, al menos 2 dígitos empezando con 0
 * d 	Días, numérico
 * a 	Número total de días como resultado de una operacó
 * H 	Horas, numérico, al menos 2 dígitos empezando con 0
 * h 	Horas, numérico
 * I 	Minutos, numérico, al menos 2 dígitos empezando con 0
 * i 	Minutos, numérico
 * S 	Segundos, numérico, al menos 2 dígitos empezando con 0
 * s 	Segundos, numérico
 * R 	Signo "-" cuando es negativo, "+" cuando es positivo
 * r 	Signo "-" cuando es negativo, vacío cuando es positivo
 */
function lapsedDataTime($date1, $date2, $format = '%a dias') {
    $date1 = new DateTime($date1);
    $date2 = new DateTime($date2);
    $lapse = $date1->diff($date2);
    $str = $lapse->format($format);
    return $str;
}

/**
 * 
 */
function lapseTimeNice($date1, $date2) {
    $str = lapsedDataTime($date1, $date2, $format = '%h:%i:%s');
    $arr = explode(':', $str);

    $out = '';
    if (!is_empty($arr[0])) {
        $out .= $arr[0] > 1 ? $arr[0] . ' horas ' : $arr[0] . ' hora ';
    }
    if (!is_empty($arr[1])) {
        $out .= $arr[1] > 1 ? $arr[1] . ' minutos ' : $arr[1] . ' minuto ';
    }
    if (!is_empty($arr[2])) {
        $out .= $arr[2] > 1 ? $arr[2] . ' segundos ' : $arr[2] . ' segundo ';
    }
    return $out;
}

/**
 *  Devuelve un arreglo con los nombres de los archivos existentes en el directorio definido por $dir
 *  recibe un segundo parámetro para filtrar los archivos según su extensión ejemplo: jpg, gif, exe, etc.
 */
function getFilesExtension($dir, $extensions_search = array()) {
    $files = array();

    if (is_dir($dir)) {
        $handle = opendir($dir);
        while ($file = readdir($handle)) {
            if ($file != "." && $file != "..") {
                // Compara la extencion
                $start = strrpos($file, ".") + 1;
                $ext = substr($file, $start);
                if (!is_empty($extensions_search)) {
                    if (in_array($ext, $extensions_search)) {
                        $files[] = $file;
                    }
                } else {
                    $files[] = $file;
                }
            }
        }
        closedir($handle);
    }
    return $files;
}

/**
 * 
 */
function getDirectories($dir) {
    $directories = array();
    if (is_dir($dir)) {
        $handle = opendir($dir);
        while ($file = readdir($handle)) {
            if ($file != "." && $file != "..") {
                if (is_dir($dir . $file)) {
                    $directories[] = $file;
                }
            }
        }
        closedir($handle);
    }
    return $directories;
}

/**
 *  Recibe un string con el nombre del enlace ya sea relativo o directo
 *  y redirecciona forzando el cierre del script.
 */
function redirect($url) {
    header('Location: ' . $url);
//    echo '<a href="' . $url . '">' . $url . '</a>';
    exit;
}

/**
 * Remueve todos los caracteres extraños. Además convierte los espacios en blanco en guiones bajos.
 */
function toSlug($title) {
    $title = trim($title);
    $title = preg_replace('#[^_a-zA-Z0-9 ]#', '', $title);
    $title = preg_replace('#[- ]+#', '_', $title);
    $title = preg_replace('#--+#', '-', $title);
    $title = preg_replace('#__+#', '_', $title);
    return strtolower($title);
}

/**
 * Remueve todos los caracteres que no son números o letras, y devuelve la cadena en minusculas.
 */
function strToAlfaNum($str) {
    return preg_replace('#[^a-z0-9]#', '', strtolower($str));
}

/**
 * Convierte los saltos de linea de texto plano a html.
 */
function nlToBr($str) {
    return str_replace(array(
        "\r\n",
        "\r",
        "\n"), '<br />', $str);
}

/**
 * Convierte los saltos de linea de html a texto plano.
 */
function brToNl($str) {
    return str_replace(array('<br />', '<br>'), "\n", $str);
}

/**
 * Funciones que entregan informacion sobre los modulos que estan cargados por apache.
 * Ej: existsModule('mod_rewrite') return TRUE o FALSE.
 */
function existsModule($module) {
    if (function_exists('apache_get_modules')) {
        $modules = apache_get_modules();
    } else {
        $modules = array();
    }

    if (in_array($module, $modules)) {
        return true;
    } else {
        return false;
    }
}

/**
 * http://php.net/manual/en/function.fileperms.php
 * Example #1 Display permissions as an octal value
 */
function getFilePermissions($file, $long = 4) {
    return substr(sprintf('%o', fileperms($file)), -$long);
//    return substr(decoct(fileperms($file)), - $long);
}

/**
 * http://php.net/manual/en/function.fileperms.php
 * Example #2 Display full permissions
 */
function getFullFilePermissions($file) {
    $perms = fileperms($file);

    if (($perms & 0xC000) == 0xC000) {
        // Socket
        $info = 's';
    } elseif (($perms & 0xA000) == 0xA000) {
        // Symbolic Link
        $info = 'l';
    } elseif (($perms & 0x8000) == 0x8000) {
        // Regular
        $info = '-';
    } elseif (($perms & 0x6000) == 0x6000) {
        // Block special
        $info = 'b';
    } elseif (($perms & 0x4000) == 0x4000) {
        // Directory
        $info = 'd';
    } elseif (($perms & 0x2000) == 0x2000) {
        // Character special
        $info = 'c';
    } elseif (($perms & 0x1000) == 0x1000) {
        // FIFO pipe
        $info = 'p';
    } else {
        // Unknown
        $info = 'u';
    }

    // Owner
    $info .= (($perms & 0x0100) ? 'r' : '-');
    $info .= (($perms & 0x0080) ? 'w' : '-');
    $info .= (($perms & 0x0040) ? (($perms & 0x0800) ? 's' : 'x') : (($perms & 0x0800) ? 'S' : '-'));

    // Group
    $info .= (($perms & 0x0020) ? 'r' : '-');
    $info .= (($perms & 0x0010) ? 'w' : '-');
    $info .= (($perms & 0x0008) ? (($perms & 0x0400) ? 's' : 'x') : (($perms & 0x0400) ? 'S' : '-'));

    // World
    $info .= (($perms & 0x0004) ? 'r' : '-');
    $info .= (($perms & 0x0002) ? 'w' : '-');
    $info .= (($perms & 0x0001) ? (($perms & 0x0200) ? 't' : 'x') : (($perms & 0x0200) ? 'T' : '-'));

    return $info;
}

/**
 * 
 */
function sendMail($to, $sender, $subject, $message) {
    $headers = '';
    $headers .= 'From: ' . ' <' . $sender . '>' . PHP_EOL;
    $headers .= 'Reply-To: ' . $sender . PHP_EOL;
    $headers .= 'X-Mailer: PHP/' . phpversion() . PHP_EOL;
    $headers .= 'Mime-Version: 1.0' . PHP_EOL;
    $headers .= 'Content-type: text/html; charset=UTF-8' . PHP_EOL;
    try {
        return mail($to, $subject, $message, $headers);
    } catch (Exception $ex) {
        return false;
    }
}

/**
 * 
 */
function &fixMagicQuotes($data) {
    if (get_magic_quotes_gpc() == 1) {
        if (is_array($data)) {
            return array_map('fixMagicQuotes', $data);
        } else {
            return stripslashes($data);
        }
    } else {
        return $data;
    }
}

/**
 * 
 */
function encryptPassword($pwd, $salt = null) {
    if (is_empty($salt)) {
        $salt = $pwd;
    }
    return crypt($pwd, md5($salt));
}

/**
 * Devuelve un array sin el valor que se quiere quitar. 
 */
function arrayPurge($remove, $array) {
    foreach ($array as $key => $value) {
        if ($value == $remove) {
            unset($array[$key]);
        }
    }
    return $array;
}

/**
 * Muestra la cadena y agrega un salto de linea.
 */
function echoNL($str) {
    echo $str . '<br />';
}

function implodeWithSufix($glue, $pieces) {
    if (!is_empty($pieces)) {
        return implode($glue, $pieces) . $glue;
    } else {
        return '';
    }
}

function extractSQL($filename) {
    // Declara la variable que guardara las consultas
    $querys = array();
    // Variable temporal, utilizada para almacenar consulta actual
    $templine = '';
    // Leer en el archivo completo
    $lines = file($filename);
    // Recorrer cada línea
    foreach ($lines as $line) {
        // Saltar, si se trata de un comentario
        if (substr($line, 0, 2) == '--' || $line == '') {
            continue;
        }
        // Añadir esta línea al segmento actual
        $templine .= $line;
        // Si tiene un punto y coma al final, es el final de la consulta
        if (substr(trim($line), -1, 1) == ';') {
            // Guardar consulta actual en un arreglo
            $querys[] = $templine;
            // Resetear la variable temporal.
            $templine = '';
        }
    }
    // Devuelve un arreglo con todas las consultas
    return $querys;
}

/*
  function autoLoad($class) {
  include FW_DIR_CLASS . strtolower($class) . '.php';
  }
 */

function getRandomAlfaNum($length) {
    $font = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $str = '';
    for ($i = 0; $i < $length; $i++) {
        $str .= $font[rand(0, strlen($font) - 1)];
    }
    return $str;
}

/**
 * Funcion in_array recursiva 
 * @param type $needle valor a buscar
 * @param type $haystack Arreglo
 * @param type $strict
 * @return boolean
 */
function inArrayRecursive($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && inArrayRecursive($needle, $item, $strict))) {
            return true;
        }
    }
    return false;
}

/**
 * Comprueba si la fecha es valida
 * @param type $date
 * @param type $format
 * @return boolean
 */
function checkRealDate($date, $format = 'yyyy-mm-dd') {
    $f = explode('-', $format);
    $parts = explode("-", trim($date));
    $day = $parts[array_search('dd', $f)];
    $month = $parts[array_search('mm', $f)];
    $year = $parts[array_search('yyyy', $f)];

    if (checkdate($month, $day, $year)) {
        return true;
    } else {
        return false;
    }
}

// Formatea una fecha desde una cadena
function dateFormatFromString($str_date, $format) {
    return date_format(date_create($str_date), $format);
}

/**
 * En alguna versiones de PHP como la 5.2 usar empty llamando directamente a un metodo produce un error
 * No seria posible hacer esto if(empty($obj->get())){...}
 */
function is_empty($var) {
    return empty($var);
}

// Borra un directorio y todo su contenido
function rmdirRecursive($folder) {
    foreach (glob($folder . "/*") as $folders) {
        if (is_dir($folders)) {
            rmdirRecursiveFolder($folders);
        } else {
            unlink($folders);
        }
    }
    rmdir($folder);
}

function calculateIVA($value, $iva = 19) {
    return round($value * ($iva / 100));
}

function numberFormat($number, $decimal = 2) {
    return number_format($number, $decimal, ',', '.');
}

function moneyFormat($number) {
    return '$ ' . numberFormat($number);
}

function rutFormat($rut) {
    $rutTmp = explode("-", $rut);
    return number_format($rutTmp[0], 0, "", ".") . '-' . $rutTmp[1];
}

/**
 *  I wrote a quick function that would convert the $_FILES array to the cleaner (IMHO) array.
 */
function reArrayFiles(&$file_post) {
    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);
    for ($i = 0; $i < $file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }
    return $file_ary;
}

function artAscii($str = "") {
    $bug = <<<EOD
            
 _._     _,-'""`-._
(,-.`._,'(       |\`-/|
    `-.-' \ )-`( , o o)
          `-    \`_`"'-
            
EOD;
    echo "<pre>$bug\n$str</pre>";
}

function message($type, $body, $items = array()) {
    $MsgBox = new MsgBox();
    $MsgBox->setEvent($type);
    $MsgBox->setMessage($body);
    $MsgBox->setItems($items);
    $MsgBox->saveInSession();
    unset($MsgBox);
}

function ForceObjToArray($obj){
    $arr = array();
    foreach($obj as $val ){
        array_push($arr, [$val['id'], $val['columns']]);
    }
    return json_encode($arr, JSON_UNESCAPED_UNICODE);
}

