<?php

 /**
  * Esta obra est� licenciada bajo la Licencia Creative 
  * Commons Atribuci�n-CompartirIgual 4.0 Internacional. 
  * @license    http://creativecommons.org/licenses/by-sa/4.0/deed.es_CL
  * @author     Richard Collao Olivares <http://www.richardcollao.cl>
  */

 abstract class Helper
 {
     public static function initialize($url)
     {
        // ...
     }
 
     /**
      * Este metodo prepara el tag URL como si se tratase de un helpers,
      * recibe 3 parametros los 2 primeros son obligatorios y el tercero es opcional.
      * El primer parametro corresponde a la URL puede ser absoluta o relativa (si es relativa es convertida a absoluta)
      * El segundo parametro corresponde al contenido que mostrara el tag URL (Puede ser un titulo, una imagen, etc.)
      * El tercer parametro debe ser un array y puede contener atributos para el tag html. (Ej: alt="asdf").
      */
     public static function tagA($url, $title = null, $parameters = array())
     {
         # Si no se ha definido ningun titulo se usara la url como titulo.
         if ($title == null) $title = $url;
         # Llama al metodo checkUrl($url), que retorna una url absoluta.
         $absolute_url = url::link($url);
         # Llama al metodo _slug(), que devuelve un string limpio de caracteres extranos.
         $clear_title = toSlug($title);
         # Une el array que recibe los parametros para el tag a
         $parameters = implode(' ', $parameters);
         # Prepara la url y devuelve el tag html correcpondiente
         return '<a href="' . $absolute_url . '" ' . $parameters . '>' . $title . '</a>';
     }
 }