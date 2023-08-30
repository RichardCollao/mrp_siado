<?php

/**
 * Si la constante FW_SESSION_SAVE_PATH esta definida, establecera la ruta donde 
 * se guardaran las sesiones
 * Importante! esta variable tambien afecta al archivo que genera los captcha
 */
if (!defined('FW_SESSION_SAVE_PATH')) {
    // CONFIGURACION POR DEFECTO.
    session_start();
} else {
    // CONFIGURACION PERSONALIZADA.
    /**
     * Especifica el número de segundos transcurridos después de que la información sea vista 
     * como 'basura' y potencialmente limpiada
     */
    ini_set('session.gc_maxlifetime', 900);

    /**
     * Se usa junto con session.gc_divisor para manejar la probabilidad de que la rutina 
     * de gc (garbage collection, recolección de basura) está iniciada.Por defecto es 1
     */
    ini_set('session.gc_probability', 1);

    /**
     * session.gc_divisor junto con session.gc_probability define la probabilidad de que el proceso
     * de gc (garbage collection, recolección de basura) está iniciado en cada inicialización de sesión.
     * La probabilidad se calcula usando gc_probability/gc_divisor, p.ej. 1/100 significa que hay un 1% de 
     * probabilidad de que el proceso de GC se inicie en cada petición. session.gc_divisor por defecto es 100
     */
    ini_set('session.gc_divisor', 100);

    /**
     * session.name specifica el nombre de la sesión que se usa como nombre de cookie.
     * Sólo debería contener caracteres alfanumúricos. Por defecto es PHPSESSID.
     */
    session_name('PHPSESSID');

    /**
     * session.save_path define el argumento que es pasado al gestor de almacenamiento.
     * Si se elige el gestor de archivos por defecto, éste es la ruta donde los archivos son 
     * creados. Véase también FW_SESSION_SAVE_PATH().
     */
    session_save_path(constant('FW_SESSION_SAVE_PATH'));

    /**
     * Lee y/o cambia el session id actual
     * define('SESSION_ID', session_id());
     * session.cache_limiter especifica el método de control de caché usado por páginas de sesión.
     * Puede ser uno de los siguientes valores: nocache, private, private_no_expire, o public. Por defecto es nocache.
     * Vea también la documentación de session_cache_limiter() para informarse sobre lo que significan estos valores.
     * session_cache_limiter('private');
     * session.entropy_file da una ruta a un recurso externo (archivo) que será usado como una fuente de entropía adicional
     * en el proceso de creación del id de sesión. Ejemplos: /dev/random o /dev/urandom que están disponibles en la mayoría de sistemas Unix.
     * Esta función está disponible en Windows desde PHP 5.3.3.
     * Si se establece session.entropy_length a un valor que no sea cero har� que PHP use la Windows Random API como fuente entrópica.
     * ini_set("session.entropy_file", "/dev/urandom");
     * session.entropy_length especifica el n�mero de bytes que serán leídos desde el archivo especificado arriba. Por defecto es 0 (deshabilitado).
     * ini_set("session.entropy_length", "512");
     * session.cache_expire especifica el tiempo de vida en minutos para las páginas de sesi�n examinadas, esto no tiene efecto para el limitador nocache.
     * Por defecto es 180. Véase también session_cache_expire().
     * session_cache_expire(600);
     * session_start() crea una sesión (o la contin�a basandose en el session id pasado por GET o mediante una cookie).
     */
    session_start();

    // reemplazará la id de sesión actual con una nueva, y conservará la información de sesión actual.
    # session_regenerate_id();
    # session_regenerate_id(TRUE);
}