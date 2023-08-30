<?php

/**
 * Clase responsable de construir la cabecera para la pagina html
 * Esta obra está licenciada bajo la Licencia Creative 
 * Commons Atribucó-CompartirIgual 4.0 Internacional. 
 * @license    http://creativecommons.org/licenses/by-sa/4.0/deed.es_CL
 * @author     Richard Collao Olivares <http://www.richardcollao.cl>
 */
class Header {

    private static $_url_base;
    // Usado para el meta expires por defecto FALSE obliga al servidor a servir una pagina no cacheada
    private static $_cache = false;
    // Por defecto no se comprime el codigo.
    private static $_compress_css = false;
    private static $_doctype;
    private static $_charset = 'UTF-8'; #ISO-8859-1';
    private static $_title = '..::Framework By Richard Collao::..';
    private static $_favicon = '';
    private static $_description;
    private static $_col_entrys = array();
    private static $_col_keywords = array('open source,framework');
    private static $_col_styles_css = array();
    private static $_col_embed_styles_css = array();
    private static $_col_sheets_css = array();
    private static $_col_javascripts = array();
    private static $_robots_index = false;

    /**
     * Metodo constructor
     * $base recibe la url que se usara para formar los enlaces relativos en la pagina HTML
     */
    public static function initialize() {
        self::$_URL_PUBLIC = constant('FW_URL_DOMAIN');
        self::$_BASE = constant('FW_URL_DOMAIN');

        self::$_URL_CSS = constant('FW_URL_DOMAIN_CSS');
        self::$_URL_JS = constant('FW_URL_DOMAIN_JS');
        self::$_URL_IMAGES = constant('FW_URL_DOMAIN_IMAGES');
        self::$_URL_MODULES = constant('FW_URL_DOMAIN_MODULES');
        self::$_url_base = constant('FW_URL_DOMAIN');
        self::$_charset = 'UTF-8'; #ISO-8859-1';
        self::$_favicon = 'images/favicon.ico';
        self::$_robots_index = false;

        self::$_col_keywords = array('open source,framework,foro,cms,webmaster');
    }

    static function setCache($_cache) {
        self::$_cache = $_cache;
    }

    // Cambiar el valor por defecto de Doctype
    public static function setDoctype($doctype) {
        self::$_doctype = $doctype;
    }

    // Cambiar el valor por defecto del <META> CHARSET
    public static function setCharset($charset) {
        self::$_charset = $charset;
    }

    // Extrae el DOCTYPE
    public static function getDocType() {
        return self::$_doctype;
    }

    public static function addEntry($str) {
        array_push(self::$_col_entrys, $str);
    }

    // Metodo que comprime los ficheros css
    private static function _compressCSS($source_code) {
        if (self::$_compress_css === true) {
            // Elimina los comentarios
            $source_code = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $source_code);
            // Elimina nuevas lineas, retornos de carro, tabulaciones y espacios en blanco
            $source_code = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '   ', '    '), '', $source_code);
        }
        return $source_code;
    }

    // Inicia el buffer de salida para la captura de codigo CSS.
    public static function styleCssStart() {
        ob_start();
    }

    // Cierra el buffer de salida y envia el codigo CSS capturado para embeberlo dentro del head de la pagina.
    public static function styleCssEnd() {
        $style = ob_get_contents();
        ob_end_clean();
        // Remueve tags apertura y cierre en caso de ser enviado por la nesecidad de ver el resaltado del codigo en el IDE
        $style = str_replace('<style type="text/css">', '', $style);
        $style = str_replace('</style>', '', $style);
        self::addEmbedStylesCss($style);
    }

    // Recibe una cadena con el parametro del tag base de html
    public static function setUrlBase($url_base) {
        self::$_url_base = $url_base;
    }

    // Recibe una cadena con el titulo que tendra la pagina
    public static function setTitle($title) {
        self::$_title = $title;
    }

    // Recibe una cadena con el titulo que tendra la pagina
    public static function setFavicon($favicon) {
        self::$_favicon = $favicon;
    }

    // Recibe una cadena con el estado de la url
    public static function setDescription($description) {
        self::$_description = $description;
    }

    // Recibe una cadena con la descripcion de la pagina
    public static function setRobotsIndex($bool) {
        self::$_robots_index = $bool;
    }

    // Recibe cadena con la palabra clave y la guarda en un arreglo
    public static function addKeyword($keyword) {
        if (!in_array($keyword, self::$_col_keywords)) {
            array_push(self::$_col_keywords, $keyword);
        }
    }

    // Recibe un array con la palabra clave y la guarda en un arreglo
    public static function addKeywords($keywords) {
        if (is_array($keywords)) {
            foreach ($keywords as $keyword) {
                if (!in_array($keyword, self::$_col_keywords)) {
                    array_push(self::$_col_keywords, $keyword);
                }
            }
        }
    }

    /**
     * Metodo encargado de agregar las hojas de estilos a la pagina, las hojas seran enlazadas
     * si se define $important a true la hoja se agrega al principio de la coleccion. 
     */
    public static function addSheetsCSS($sheet, $important = false) {
        if (!in_array($sheet, self::$_col_sheets_css)) {
            // Si $important = TRUE agrega la hoja al principio de la coleccion.
            if ($important === true) {
                array_unshift(self::$_col_sheets_css, $sheet);
            } else {
                array_push(self::$_col_sheets_css, $sheet);
            }
        }
    }

    // Metodo encargado de embeber y unificar en el head los fragmentos de estilos definidos en las vistas.
    public static function addEmbedStylesCSS($style) {
        // Remueve tags apertura y cierre en caso de ser enviado por la nesecidad de ver el resaltado del codigo en el IDE
        $style = str_replace('<style type="text/css">', '', $style);
        $style = str_replace('</style>', '', $style);
        array_push(self::$_col_embed_styles_css, $style);
    }

    public static function addJavascript($script, $important = false) {
        if (!in_array($script, self::$_col_javascripts)) {
            if ($important === false) {
                array_push(self::$_col_javascripts, $script);
            } else {
                array_unshift(self::$_col_javascripts, $script);
            }
        }
    }

    private static function _makeEntrys() {
        $entrys = PHP_EOL;
        foreach (self::$_col_entrys as $entry) {
            $entrys .= $entry . PHP_EOL;
        }
        return $entrys;
    }

    // Metodo encargado de CARGAR las hojas de estilos dentro del script css
    private static function _makeStylesCss() {
        if (!is_empty(self::$_col_styles_css)) {
            $styles_css = PHP_EOL;
            foreach (self::$_col_styles_css as $style) {
                // Extrae el contenido css de la hoja de estilo para embeberlo dentro del head
                $styles_css .= '/* << THIS SCRIPT, "' . strtoupper($style) . '" >> */' . PHP_EOL;
                $styles_css .= file_get_contents($style);
                $styles_css .= PHP_EOL;
            }

            $style = '<style type="text/css">' . PHP_EOL;
            $style .= '/* Estilos CSS Embebidos desde Hojas enlazadas.*/' . PHP_EOL;
            $style .= self::_compressCss($styles_css) . PHP_EOL;
            $style .= '</style>' . PHP_EOL;
            return $style;
        }
    }

    // Metodo encargado de ENLAZAR las hojas de estilos a las pagina
    private static function _makeSheetsCss() {
        if (!is_empty(self::$_col_sheets_css)) {
            $sheets_css = PHP_EOL;
            foreach (self::$_col_sheets_css as $sheet) {
                # Enlaza la hoja de estilo dentro del head
                $sheets_css .= '<link type="text/css" rel="stylesheet" href="' . $sheet .
                        '" media="screen" />' . PHP_EOL;
            }
            return $sheets_css;
        }
    }

    // Metodo encargado de CARGAR las hojas de estilos dentro del script css
    private static function _makeEmbedStylesCss() {
        if (!is_empty(self::$_col_embed_styles_css)) {
            $style = PHP_EOL;
            $style .= '<style type="text/css">' . PHP_EOL;
            $style .= '/* Estilos embebidos */' . PHP_EOL;
            $style .= implode(PHP_EOL, self::$_col_embed_styles_css) . PHP_EOL;
            $style .= '</style>' . PHP_EOL;
            return $style;
        }
    }

    // Metodo encargado de ENLAZAR los script a la pagina.
    private static function _makeJavascripts() {
        if (!is_empty(self::$_col_javascripts)) {
            $javascript = PHP_EOL;
            foreach (self::$_col_javascripts as $script) {
                $javascript .= '<script type="text/javascript" src="' . $script . '"></script>' . PHP_EOL;
            }
            return $javascript;
        }
    }

    /**
     * Devuelve un string en codigo html con la cabecera de la pagina.
     * Este metodo es llamado desde la clase vista MainView por lo tando se define como publico
     */
    public static function getHeader() {
        $header = PHP_EOL;
        $header .= '<title>' . self::$_title . '</title>' . PHP_EOL;
        $header .= '<base href="' . self::$_url_base . '" target="_top" />' . PHP_EOL;
        if (!is_empty(self::$_favicon)) {
            $header .= '<link rel="shortcut icon" href="' . self::$_favicon . '" />' . PHP_EOL;
        }

        // FALSE evita que se guarde el cache de la pagina
        if (self::$_cache === false) {
            $header .= '<meta http-equiv="Pragma" content="no-cache"/>' . PHP_EOL;
            $header .= '<meta http-equiv="Expires" content="-1"/>' . PHP_EOL;
            $header .= '<meta charset="' . self::$_charset . '" />' . PHP_EOL;
        }

        // Condicion para no indexar la pagina
        if (self::$_robots_index === false) {
            $header .= '<meta name="robots" content="noindex,nofollow" />' . PHP_EOL;
        } else {
            $header .= '<meta name="robots" content="index,follow" />' . PHP_EOL;
        }

        // Los "keywords" son palabras claves que describen el contenido de tu pagina web separados por una coma.
        if (!is_empty(self::$_col_keywords)) {
            $header .= '<meta name="keywords" content="' . implode(self::$_col_keywords, ', ') . '" />' . PHP_EOL;
        }

        // Nota:Los motores de busqueda solo toman los primeros 150 caracteres de la descripcion.
        $header .= '<meta name="description" content="' . substr(self::$_description, 0, 150) . '" />' . PHP_EOL;

        $header .= self::_makeEntrys();
        $header .= self::_makeSheetsCss();
        $header .= self::_makeStylesCss();
        $header .= self::_makeEmbedStylesCss();
        $header .= self::_makeJavascripts();
        return $header;
    }

}
