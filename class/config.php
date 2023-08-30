<?php
abstract class SPDO
{

    public static function get($name, $esc = FALSE)
    {
        return $_GET[$name];
    }

    public static function post($name, $esc = FALSE)
    {
        return $_POST[$name];
    }
}

?>