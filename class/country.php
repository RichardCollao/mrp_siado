<?php

/**
 * Esta obra está licenciada bajo la Licencia Creative 
 * Commons Atribución-CompartirIgual 4.0 Internacional. 
 * @license    http://creativecommons.org/licenses/by-sa/4.0/deed.es_CL
 * @author     Richard Collao Olivares <http://www.richardcollao.cl>
 */
 
/**
 * http:#es.wikipedia.org/wiki/ISO_3166-1
 * 
 * ISO 3166-1
 * Saltar a: navegación, búsqueda

 * ISO 3166-1 como parte del estándar ISO 3166 proporciona códigos para los nombres de países y otras 
 * dependencias administrativas. Fue publicado por primera vez en 1974 por la Organización Internacional 
 * para la Estandarización (ISO, de la raíz griega que significa igual) y define tres códigos diferentes para cada área:

 * Normalizaciones derivadas de este código son y serán:

 * ISO 3166-1 numérico, sistema de tres dígitos, idéntico al definido por la División Estadástica de las Naciones Unidas.
 * ISO 3166-1 alfa-3, sistema de códigos tres letras.
 * ISO 3166-1 alfa-2, sistema de códigos de dos letras. Tiene muchas aplicaciones, la más notoria en los dominios 
 * de nivel superior geográfico de Internet. Normalizaciones derivadas de este último código son:
 * ISO 3166-2, códigos referidos a subdivisiones tales como estados y provincias.
 * ISO 3166-3, sustitutos de los códigos del sistema alpha-2 que han quedado obsoletos.
 * ISO 4217, c�digos para unidades monetarias.

 * A un país o territorio generalmente se le asigna un nuevo código alfabético si su nombre cambia, mientras 
 * que se asocia un nuevo código numérico a un cambio de fronteras. Se reservan algunos códigos en cada área, 
 * por diversas razones.

 * También existe ISO por idiomas que es * ISO 639-2

 * ISO 3166-1 no es el único estándar para los Códigos de países.
 */
abstract class Country {

    private static $_alfa2 = array(
        'al' => 'Albania',
        'de' => 'Alemania',
        'as' => 'American Samoa',
        'ad' => 'Andorra',
        'ao' => 'Angola',
        'ai' => 'Anguilla',
        'aq' => 'Antarctica',
        'ag' => 'Antigua y Barbuda',
        'an' => 'Antillas Holandesas',
        'sa' => 'Arabia Saud�',
        'dz' => 'Argelia',
        'ar' => 'Argentina',
        'am' => 'Armenia',
        'aw' => 'Aruba',
        'au' => 'Australia',
        'at' => 'Austria',
        'az' => 'Azerbay�n',
        'bs' => 'Bahamas',
        'bh' => 'Bahrain',
        'bd' => 'Bangladesh',
        'bb' => 'Barbados',
        'by' => 'Belarus',
        'be' => 'B�lgica',
        'bz' => 'Belize',
        'bj' => 'Benin',
        'bm' => 'Bermuda',
        'bo' => 'Bolivia',
        'ba' => 'Bosnia-Herzegovina',
        'bw' => 'Botswana',
        'br' => 'Brasil',
        'bn' => 'Brunei Darussalam',
        'bg' => 'Bulgaria',
        'bf' => 'Burkina Faso',
        'bi' => 'Burundi',
        'bt' => 'But�n',
        'cv' => 'Cabo Verde',
        'kh' => 'Cambodia',
        'cm' => 'Camer�n',
        'ca' => 'Canada',
        'td' => 'Chad',
        'cl' => 'Chile',
        'cn' => 'China',
        'va' => 'Ciudad del Vaticano',
        'co' => 'Colombia',
        'km' => 'Comoros',
        'cr' => 'Costa Rica',
        'ci' => 'Cote d�Ivoire',
        'cu' => 'Cuba',
        'cy' => 'Cyprus',
        'dk' => 'Dinamarca',
        'dm' => 'Dominica',
        'ec' => 'Ecuador',
        'eg' => 'Egipto',
        'sv' => 'El Salvador',
        'ae' => 'Emiratos �rabes Unidos',
        'er' => 'Eritrea',
        'es' => 'Espa�a',
        'fm' => 'Estado Federal de Micronesia',
        'us' => 'Estados Unidos',
        'ee' => 'Estonia',
        'et' => 'Etiopia',
        'ru' => 'Federaci�n Rusa',
        'fj' => 'Fiji',
        'ph' => 'Filipinas',
        'fi' => 'Finlandia',
        'fr' => 'Francia',
        'ga' => 'Gab�n',
        'gm' => 'Gambia',
        'ge' => 'Georgia',
        'gs' => 'Georgia del Sur y las Islas Sur Sandwich',
        'gh' => 'Ghana',
        'gi' => 'Gibraltar',
        'gd' => 'Granada',
        'gr' => 'Grecia',
        'gl' => 'Greenland',
        'gp' => 'Guadalupe',
        'gu' => 'Guam',
        'gt' => 'Guatemala',
        'gn' => 'Guinea',
        'gw' => 'Guinea Bissau',
        'gy' => 'Guyana',
        'ht' => 'Haiti',
        'gi' => 'Holanda',
        'hn' => 'Honduras',
        'hk' => 'Hong Kong',
        'hr' => 'Hrvatska/Croacia',
        'hu' => 'Hungr�a',
        'is' => 'Iceland',
        'in' => 'India',
        'id' => 'Indonesia',
        'iq' => 'Iraq',
        'ie' => 'Irlanda',
        'bv' => 'Isla Bouvet',
        'im' => 'Isla de Man',
        'pn' => 'Isla Piticairn',
        're' => 'Isla Reuni�n',
        'ky' => 'Islas Caim�n',
        'cx' => 'Islas Christmas',
        'cc' => 'Islas Cocos',
        'cg' => 'Islas Cook',
        'fo' => 'Islas Feroes',
        'hm' => 'Islas Heard y McDonald',
        'fk' => 'Islas Malvinas',
        'mp' => 'Islas Mariana del Norte',
        'mh' => 'Islas Marshall',
        'nf' => 'Islas Norfolk',
        'sb' => 'Islas Salom�n',
        'tc' => 'Islas Turks y Caicos',
        'vg' => 'Islas Virgen',
        'vi' => 'Islas Virginia',
        'wf' => 'Islas Wallis y Futuna',
        'il' => 'Israel',
        'it' => 'Italia',
        'jm' => 'Jamaica',
        'jp' => 'Jap�n',
        'je' => 'Jersey',
        'jo' => 'Jord�n',
        'kz' => 'Kazakhstan',
        'ki' => 'Kiribati',
        'kw' => 'Kuwait',
        'kg' => 'Kyrgyzstan',
        'gl' => 'Latvia',
        'lb' => 'Lebanon',
        'ls' => 'Lesotho',
        'lr' => 'Liberia',
        'ly' => 'Libia',
        'li' => 'Liechtenstein',
        'lt' => 'Lithuania',
        'lu' => 'Luxemburgo',
        'mo' => 'Macau',
        'mk' => 'Macedonia',
        'mg' => 'Madagascar',
        'my' => 'Malasia',
        'mw' => 'Malawi',
        'mv' => 'Maldivas',
        'ml' => 'Mal�',
        'mt' => 'Malta',
        'ma' => 'Marruecos',
        'mq' => 'Martinique',
        'mr' => 'Mauritania',
        'mu' => 'Mauritania',
        'mx' => 'M�xico',
        'mc' => 'M�naco',
        'mn' => 'Mongolia',
        'ms' => 'Monserrat',
        'mz' => 'Mozambique',
        'mm' => 'Myanmar',
        'na' => 'Namibia',
        'nr' => 'Nauru',
        'np' => 'Nepal',
        'ni' => 'Nicaragua',
        'ng' => 'Nigeria',
        'nu' => 'Niue',
        'no' => 'Noruega',
        'nc' => 'Nueva Caledonia',
        'pg' => 'Nueva Guinea Pap�a',
        'nz' => 'Nueva Zelanda',
        'om' => 'Om�n',
        'pk' => 'Pakist�n',
        'pw' => 'Palau',
        'pa' => 'Panam�',
        'py' => 'Paraguay',
        'pe' => 'Per�',
        'pf' => 'Polinesia Francesa',
        'pl' => 'Polonia',
        'pt' => 'Portugal',
        'pr' => 'Puerto Rico',
        'qa' => 'Quatar',
        'uk' => 'Reino Unido',
        'cf' => 'Rep�blica Central Africana',
        'cz' => 'Rep�blica Checa',
        'cg' => 'Rep�blica de Congo',
        'kr' => 'Rep�blica de Corea',
        'md' => 'Rep�blica de Moldova',
        'cd' => 'Rep�blica Democr�tica de Congo',
        'kp' => 'Rep�blica Democr�tica de Corea',
        'la' => 'Rep�blica Democr�tica de Laos',
        'do' => 'Rep�blica Dominicana',
        'ir' => 'Rep�blica Isl�mica de Ir�n',
        'sk' => 'Rep�blica Slovaca',
        'rw' => 'Ruanda',
        'ro' => 'Rumania',
        'eh' => 'Sahara Occidental',
        'kn' => 'Saint Kitts and Nevis',
        'ws' => 'Samoa Occidental',
        'sm' => 'San Marino',
        'vc' => 'San Vicente y Las Grandinas',
        'sh' => 'Santa Elena',
        'lc' => 'Santa Lucia',
        'st' => 'Santo Tom�s y Principe',
        'sn' => 'Senegal',
        'sc' => 'Seychelles',
        'sl' => 'Sierra Leona',
        'sg' => 'Singapur',
        'sy' => 'Siria',
        'si' => 'Slovenia',
        'so' => 'Somalia',
        'lk' => 'Sri Lanka',
        'pm' => 'St.Pierre y Miquelon',
        'za' => 'Sud�frica',
        'sd' => 'Sud�n',
        'se' => 'Suecia',
        'ch' => 'Suiza',
        'sr' => 'Surinam',
        'sz' => 'Swazilandia',
        'tw' => 'Taiwan',
        'tj' => 'Tajikist�n',
        'tz' => 'Tanzania',
        'io' => 'Territorios Brit�icos del Oc�ano �ndico',
        'tf' => 'Territorios franceses meridionales',
        'ps' => 'Territorios Palestinos',
        'th' => 'Thailandia',
        'tp' => 'Timor Oriental',
        'tk' => 'Tokelau',
        'to' => 'Tonga',
        'tt' => 'Trinidad y Tobago',
        'tn' => 'T�nez',
        'tm' => 'Turkmenist�n',
        'tr' => 'Turqu�a',
        'tv' => 'Tuvalu',
        'ug' => 'Uganda',
        'ua' => 'Ukrania',
        'uy' => 'Uruguay',
        'uz' => 'Uzbekist�n',
        'vu' => 'Vanuatu',
        've' => 'Venezuela',
        'vn' => 'Vietnam',
        'ye' => 'Yemen',
        'yu' => 'Yugoslavia',
        'zm' => 'Zambia',
        'zw' => 'Zimbawe');

    /**
     * Devuelve un array con la lista de paises con su extencion(codificacion alfa-2)) como indice.
     */
    public static function getList() {
        return self::$_alfa2;
    }

    /**
     * Comprueba si extiste una extencion(codificacion alfa-2) relacionada con un pais. Ej: "cl" return TRUE
     */
    public static function existExt($ext) {
        if (array_key_exists($ext, self::$_alfa2)) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Devuelve el nombre del pais segun la extencion recibida.
     */
    public static function getName($ext) {
        if (array_key_exists($ext, self::$_alfa2))
            return self::$_alfa2[$ext];
        else {
            return FALSE;
        }
    }

}