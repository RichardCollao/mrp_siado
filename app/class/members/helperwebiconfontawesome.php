<?php

abstract class HelperWebIconFontAwesome {

    private static $icons = array(
        'home' => 'fas fa-home',
        'user' => 'fas fa-user',
        'menu' => 'fas fa-bars',
        'signout' => 'fas fa-sign-out-alt',
        'calendar' => 'fas fa-calendar-alt',
        'search' => 'fas fa-search',
        'file' => 'fas fa-file',
        'send' => 'fas fa-paper-plane',
        'edit' => 'fas fa-pen',
        'detail' => 'fas fa-pen-square',
        'list' => 'fas fa-list',
        'delete' => 'fas fa-trash-alt',
        'lock' => 'fas fa-lock-open',
        'unlock' => 'fas fa-lock',
        'eye' => 'fas fa-eye',
        'userconfig' => 'fas fa-user-cog',
        'config' => 'fas fa-cog',
        'associate' => 'fas fa-link',
        'disassociate' => 'fas fa-unlink',
        'fileexcel' => 'fas fa-file-excel',
        'filepdf' => 'fas fa-file-pdf',
        'search' => 'fas fa-search',
        'download' => 'fas fa-download',
        'go' => 'fas fa-external-link-square-alt',
        'tool' => 'fas fa-tools'
    );

    /**  Desde PHP 5.3.0  */
    public static function __callStatic($name, $arguments) {
        if (strtolower(substr($name, 0, 4)) == 'icon') {
            $class = strtolower(substr($name, 4));
            return self::getIcon($class);
        }
        // retorna un string con el icono envuelto en un boton
        if (strtolower(substr($name, 0, 3)) == 'btn') {
            $class = strtolower(substr($name, 3));
            return self::wrapperBtn(self::getIcon($class), $arguments[0]);
        }
    }

    private static function getIcon($class) {
        if (array_key_exists($class, self::$icons)) {
            return '<i class="' . self::$icons[$class] . '"></i>';
        } else {
            throw new Exception("Error: 400 " . $class);
        }
    }

    private static function wrapperBtn($obj, $link = '#', $title = '') {
        return '
        <a href="' . $link . '" data-toggle="tooltip" title="' . $title . '">
            <button type="button" class="btn btn-primary btn-xs">' . $obj . '</button>
        </a>' . PHP_EOL;
    }

    public static function btnEdit($link) {
        return self::wrapperBtn(self::getIcon('edit'), $link, 'Editar');
    }

    public static function btnDetail($link) {
        return self::wrapperBtn(self::getIcon('detail'), $link, 'Editar items');
    }

    public static function btnDelete($link) {
        return '
        <a href="' . $link . '" class="link-delete" data-toggle="tooltip" title="Borrar">
            <button type="button" class="btn btn-danger btn-xs">
                <i class="fas fa-trash-alt"></i>
            </button>
        </a>' . PHP_EOL;
    }

    public static function btnLock($link, $txt = '') {
        return '
        <a href="' . $link . '" data-toggle="tooltip" title="Bloquear">
            <button type="button" class="btn btn-default btn-xs">
                <i class="fas fa-lock-open"></i>' . $txt . '
            </button>
        </a>' . PHP_EOL;
    }

    public static function btnUnlock($link, $txt = '') {
        return '
        <a href="' . $link . '" data-toggle="tooltip" title="Desbloquear">
            <button type="button" class="btn btn-default btn-xs">
                <i class="fas fa-lock"></i>' . $txt . '
            </button>
        </a>' . PHP_EOL;
    }

    public static function btnView($link, $txt = '') {
        return '
        <a href="' . $link . '" data-toggle="tooltip" title="Ver">
            <button type="button" class="btn btn-default btn-xs">
                <i class="fas fa-eye"></i>' . $txt . '
            </button>
        </a>' . PHP_EOL;
    }

    public static function btnUserConfig($link, $txt = '') {
        return '
        <a href="' . $link . '" data-toggle="tooltip" title="Configuraciones de usuario">
            <button type="button" class="btn btn-default btn-xs">
                <i class="fas fa-user-cog"></i>' . $txt . '
            </button>
        </a>' . PHP_EOL;
    }

    public static function btnConfig($link, $txt = '') {
        return '
        <a href="' . $link . '" data-toggle="tooltip" title="Configurar">
            <button type="button" class="btn btn-default btn-xs">
                <i class="fas fa-cog"></i>' . $txt . '
            </button>
        </a>' . PHP_EOL;
    }

    public static function btnAssociate($link, $txt = '') {
        return '
        <a href="' . $link . '" data-toggle="tooltip" title="Asociar">
            <button type="button" class="btn btn-default btn-xs">
                <i class="fas fa-link"></i>' . $txt . '
            </button>
        </a>' . PHP_EOL;
    }

    public static function btnDisassociate($link, $txt = '') {
        return '
        <a href="' . $link . '" data-toggle="tooltip" title="Desasociar">
            <button type="button" class="btn btn-default btn-xs">
                <i class="fas fa-unlink"></i>' . $txt . '
            </button>
        </a>' . PHP_EOL;
    }

    public static function btnFileExcel($link, $txt = '') {
        return '
        <a href="' . $link . '" data-toggle="tooltip" title="Exportar a un archivo Excel">
            <button type="button" class="btn btn-default btn-xs" style="background-color: #66bb6a;">
                <i class="fas fa-file-excel" style="color: white"></i>' . $txt . '
            </button>
        </a>' . PHP_EOL;
    }

    public static function btnFilePdf($link, $txt = '') {
        return '
        <a href="' . $link . '" data-toggle="tooltip" title="Exportar a un archivo PDF">
            <button type="button" class="btn btn-default btn-xs" style="background-color: #ef5350;">
                <i class="fas fa-file-pdf" style="color: white"></i>' . $txt . '

            </button>
        </a>' . PHP_EOL;
    }

    public static function btnSearch($link, $txt = '') {
        return '
        <a href="' . $link . '" data-toggle="tooltip" title="Buscar">
            <button type="button" class="btn btn-default btn-xs">
                <i class="fas fa-search"></i>' . $txt . '
            </button>
        </a>' . PHP_EOL;
    }

    public static function btnDownload($link, $txt = '') {
        return '
        <a href="' . $link . '" data-toggle="tooltip" title="Descargar">
            <button type="button" class="btn btn-default btn-xs">
                <i class="fas fa-download"></i>' . $txt . '
            </button>
        </a>' . PHP_EOL;
    }

    public static function btnGo($link, $txt = '') {
        return '
        <a href="' . $link . '" data-toggle="tooltip" title="Ir">
            <button type="button" class="btn btn-default btn-xs">
                <i class="fas fa-external-link-square-alt"></i>' . $txt . '
            </button>
        </a>' . PHP_EOL;
    }

    public static function btnMenu($link, $txt = '') {
        return '
        <a href="' . $link . '" data-toggle="tooltip" title="Menú">
            <button type="button" class="btn btn-default btn-xs">
                <i class="fas fa-bars"></i>' . $txt . '
            </button>
        </a>' . PHP_EOL;
    }

    public static function btnTool($link, $txt = '') {
        return '
        <a href="' . $link . '" data-toggle="tooltip" title="Herramientas">
            <button type="button" class="btn btn-default btn-xs">
                <i class="fas fa-tools"></i>' . $txt . '
            </button>
        </a>' . PHP_EOL;
    }

    // btn Custom
    public static function btnAddressBook($link, $txt = '') {
        return '
        <a href="' . $link . '" data-toggle="tooltip" title="Contactos" class="btn btn-default btn-xs">
            <i class="fas fa-id-card"></i>
                <!-- Badge -->
                <span class="badge">
                    &nbsp;' . $txt . '&nbsp;
                </span>
        </a>' . PHP_EOL;
    }

    public static function btnAttach($link, $txt) {
        return '
        <a href="' . $link . '" data-toggle="tooltip" title="Adjuntos" class="btn btn-default btn-xs">
            <i class="fas fa-paperclip"></i>
                <!-- Badge -->
                <span class="badge">
                    &nbsp;' . $txt . '&nbsp;
                </span>
         </a>' . PHP_EOL;
    }

    public static function btnCountBills($link, $txt) {
        return '
        <a href="' . $link . '" data-toggle="tooltip" title="Facturas asociadas" class="btn btn-default btn-xs">
            <i class="fas fa-file-invoice"></i>
                <!-- Badge -->
                <span class="badge">
                    &nbsp;' . $txt . '&nbsp;
                </span>
        </a>' . PHP_EOL;
    }

    public static function btnCountGuides($link, $txt) {
        return '
        <a href="' . $link . '" data-toggle="tooltip" title="Guias asociadas" class="btn btn-default btn-xs">
            <i class="fas fa-file-alt"></i>
                <!-- Badge -->
                <span class="badge">
                    &nbsp;' . $txt . '&nbsp;
                </span>
        </a>' . PHP_EOL;
    }

    public static function btnSearchBar() {
        return '
        <div style="float: left;margin-left:15px">
            <button class="btn btn-default" type="button" data-toggle="collapse" 
                    data-target="#filter-collapse" aria-expanded="true" aria-controls="collapseExample">
                <i class="fas fa-search"></i>&nbsp;Buscar
            </button>
        </div>' . PHP_EOL;
    }

    // Sin iconos
    public static function btnTerminate($link) {
        return '
        <a href="' . $link . '" data-toggle="tooltip" title="alt + t">
            <button type="button" class="btn btn-default" accesskey="t">
                Terminar
            </button>
        </a>' . PHP_EOL;
    }

    public static function btnCreate($link) {
        return '
        <a href="' . $link . '" data-toggle="tooltip" title="alt + c">
            <button type="button" class="btn btn-primary" accesskey="c">Crear</button>
        </a>' . PHP_EOL;
    }

    public static function btnBack($link) {
        return '
        <div style="margin-bottom: 15px;">
            <a href="' . $link . '"><button type="button" class="btn btn-default">Volver</button></a>
        </div>' . PHP_EOL;
    }

    public static function showAllIcons() {
         foreach (self::$icons as $key => $value) {
            echo self::wrapperBtn(self::getIcon($key)) . ' -> ' . $key . ', ';
        }
    }

}
