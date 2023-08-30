<?php

abstract class Captcha {

    public static function create() {
        // Obtiene el juego de caracteres que forman el captcha.
        $text = self::_generateText(4);
        // Guarda el texto en la sesion correspondiente.
        $_SESSION['captcha'] = strtolower($text);
        // Obtiene un objeto de tipo imagen.
        $captcha = self::_generateCaptcha($text);
        // Envia la imagen al navegador
        header('Content-type: image/png');
        header('Content-Disposition:inline; filename=captcha.png');
        imagegif($captcha);
        imagedestroy($captcha);
    }

    public static function getText() {
        return $_SESSION['captcha'];
    }

    private static function _generateText($length) {
        $text = '';
        $font = '123456789ABCDEFGHIJKLMNPQRSTUVWXYZ';
        for ($i = 0; $i < $length; $i += 1) {
            $rand = mt_rand(0, strlen($font) - 1);
            $text.= $font[$rand];
        }
        return $text;
    }

    private function _generateCaptcha($text) {
        // Tamaño de la imagen, ancho y alto 
        $captcha = imagecreatefrompng('captcha_texture.png');
        # $captcha = imagecreate(100,30);
        // Color de fondo
        $colfondo = imagecolorallocate($captcha, 255, 255, 255);
        // Color de la letra
        $colText = imagecolorallocate($captcha, 0, 128, 192);
        // Debe ser una ruta absoluta.
        $font = dirname(__file__) . '/wallh.ttf';
        for ($i = 0; $i < strlen($text); $i+=1) {
            // Objeto, tamaño fuente , rotacion, pocicionX, pocicionY, color, fuente, caracter
            imagettftext($captcha, 16, rand(-20, 20), ($i * 18) + 10, 20, $colText, $font, $text[$i]);
        }
        return $captcha;
    }

}