<?php

/**
 * Clase se encarga de cargar los mensajes desde el array $_SESSION, luego evalua 
 * si el mensaje debe ser mostrado o destruido.
 * Inserta los mensajes activos en el contenedor de la clase Vista.
 */
abstract class ViewMsgBox {

    public static function initialize() {

        if (!isset($_SESSION['msgbox'])) {
            $_SESSION['msgbox'] = array();
        }

        if (!is_array($_SESSION['msgbox']) || is_empty($_SESSION['msgbox'])) {
            return;
        }

        foreach ($_SESSION['msgbox'] as $key => $data) {
            $_SESSION['msgbox'][$key]['hops'] -= 1;

            $view = self::_capture($data);

            View::insert($view, 'msgbox');
        }
        self::_evalue_life();
    }

    private static function _capture($data) {
        ob_start();
        require (MSGBOX_DIR . 'views' . DS . 'msgbox.php');
        $view = ob_get_contents();
        ob_end_clean();
        return $view;
    }

    private static function _evalue_life() {
        foreach ($_SESSION['msgbox'] as $key => $msgbox) {
            if ($msgbox['hops'] <= 0) {
                unset($_SESSION['msgbox'][$key]);
            }
        }
    }

}