<?php
/**
 * This file is part of josecarlosphp/functions - Common use functions.
 *
 * josecarlosphp/functions is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 *
 * @see         https://github.com/josecarlosphp/functions
 * @copyright   2008-2019 José Carlos Cruz Parra
 * @license     https://www.gnu.org/licenses/gpl.txt GPL version 3
 * @desc        Common use functions - internet.
 */

/**
 * Genera una contraseña aleatoria
 *
 * @param int $minlen
 * @param int $maxlen
 * @param string $validchars
 * @return string
 */
function GenerateRandomPass($minlen=7, $maxlen=12, $validchars='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789')
{
	return \josecarlosphp\utils\Internet::generateRandomPass($minlen, $maxlen, $validchars);
}
/**
 * Genera una clave aleatoria.
 * El parámetro $formato es opcional, si se indica se ignoran los demás y se creará una clave siguiendo el formato.
 * El formato es una cadena formada sólo por caracteres A, a, 1
 * A = Una letra mayúscula
 * a = Una letra minúscula
 * 1 = Un dígito
 * [otro] = Un carácter aleatorio (letra mayúscula o minúscula, o dígito)
 * \ = Carácter de escape, hace que el siguiente carácter sea interpretado como constante
 *
 * EJEMPLOS DE FORMATO - RESULTADO:
 * AAA111	-	VUS293
 * AAA-111	-	VUSc293
 * AAA\-111	-	VUS-293
 * AAA\\111	-	VUS\293
 * Aaa1		-	Vus2
 *
 * @param int $longitud
 * @param bool $conletrasmin
 * @param bool $conletrasmay
 * @param bool $connumeros
 * @param string $formato
 * @return string
 */
function GenerateRandomKey($longitud=0, $conletrasmin=true, $conletrasmay=true, $connumeros=true, $formato='')
{
	return \josecarlosphp\utils\Internet::generateRandomKey($longitud, $conletrasmin, $conletrasmay, $connumeros, $formato);
}
/**
 * @return string
 * @desc Gets the client IP address
 */
function GetClientIP()
{
	return \josecarlosphp\utils\Internet::getClientIp();
}
/**
 * @desc Verify if an url is valid (is online)
 * @param string $url
 * @return bool
 */
function VerifyUrl($url)
{
	return \josecarlosphp\utils\Internet::verifyUrl($url);
}
/**
 * @desc Lo mismo que el modificador url_format creado para Smarty, pero con la opción de aplicar o no htmlentities
 */
function UrlFormat($url, $shorturl=false, $htmlentities=true, $flags=ENT_COMPAT, $encoding='UTF-8')
{
	return \josecarlosphp\utils\Internet::urlFormat($url, $shorturl, $htmlentities, $flags, $encoding);
}
/**
 * @param string $name
 * @param string $content
 */
function DownloadVirtualFile($name, $content)
{
	return \josecarlosphp\utils\Internet::downloadVirtualFile($name, $content);
}
/**
 * @return bool
 * @desc Comprueba si el visitante es un cliente navegador de internet (no un bot)
 */
function UserAgentIsAnExplorer($useragent=null)
{
	return \josecarlosphp\utils\Internet::userAgentIsAnExplorer($useragent);
}

function UserAgentIsBot($useragent=null, $customBots='', $defaultBots='Teoma,alexa,froogle,Gigabot,inktomi,looksmart,URL_Spider_SQL,Firefly,NationalDirectory,AskJeeves,TECNOSEEK,InfoSeek,WebFindBot,girafabot,crawler,www.galaxy.com,Googlebot,Scooter,TechnoratiSnoop,Rankivabot,Mediapartners-Google,Sogouwebspider,WebAltaCrawler,TweetmemeBot,Butterfly,Twitturls,Me.dium,Twiceler')
{
    return \josecarlosphp\utils\Internet::userAgentIsBot($useragent, $customBots, $defaultBots);
}
/**
 * Filtra metacaracteres convirtiéndolos a entidades html o eliminando las etiquetas.
 * Si magic_quotes no está activado y $addslashes es true, además añade barras de escape
 *
 * @param mixed $data
 * @param mixed $key
 * @param boolean $striptags
 */
function FiltrarMetacaracteres(&$data, $key=null, $striptags=false, $addslashes=true)
{
	return \josecarlosphp\utils\Internet::filterMetachars($data, $key, $striptags, $addslashes);
}
/**
 * Limpia datos frente a inyección sql y acceso a archivos,
 * no usar para información que permita incluir caracteres como ; , . \ /
 * Puede recibir un array como parámetro, limpiará sus elementos recursivamente
 *
 * @param mixed $data
 * @param array $charsToClean
 * @return mixed
 */
function LimpiarData($data, $charsToClean=array(';', ',', '.', '\\', '/'))
{
	return \josecarlosphp\utils\Internet::cleanData($data, $charsToClean);
}

function reemplazarCaracteresRaros($str, $ponerEnMinusculas=false)
{
	return \josecarlosphp\utils\Internet::reemplazarCaracteresRaros($str, $ponerEnMinusculas);
}
/**
 * Prepara una cadena para que forme parte de una url amigable
 *
 * @param string $str
 * @return string
 */
function string2friendly($str)
{
	return \josecarlosphp\utils\Internet::string2friendly($str);
}
/**
 * Obtiene información sobre la localización de una IP concreta, la actual del visitante o la del servidor
 * mediante los datos obtenidos desde geoiptool.com
 *
 * @param string $ip
 * @param string $que
 * @param string $defaultip
 * @return mixed
 */
function GetGeoInfo($ip='', $que='', $defaultip='clientip')
{
	return \josecarlosphp\utils\Internet::getGeoInfo($ip, $que, $defaultip);
}
/**
 * Como file_get_contents aplicado a una URL
 *
 * @param string $url
 * @param string $useragent
 * @param array $extraOpt
 * @param bool $devolverElError
 * @return string
 */
function GetURLContents($url, $useragent='', $extraOpt=null, $devolverElError=true)
{
	return \josecarlosphp\utils\Internet::getUrlContents($url, $useragent, $extraOpt, $devolverElError);
}
/**
 * Transforma una cadena en meta keywords
 *
 * @param string $str
 * @param bool $html_entity_decode
 * @param int $maxwords
 * @param int $minlength
 * @param mixed $flags
 * @param string $encoding
 * @return string
 */
function string2keywords($str, $html_entity_decode=false, $maxwords=15, $minlength=3, $flags=ENT_COMPAT, $encoding='UTF-8')
{
	return \josecarlosphp\utils\Internet::string2keywords($str, $html_entity_decode, $maxwords, $minlength, $flags, $encoding);
}
/**
 * Quita la '/' final de una cadena (si la tiene)
 *
 * @param string $str
 * @return string
 */
function quitarBarra($str)
{
	return \josecarlosphp\utils\Internet::quitarBarra($str);
}
/**
 * Quita la '/' inicial de una cadena (si la tiene)
 *
 * @param string $str
 * @return string
 */
function quitarBarraIni($str)
{
	return \josecarlosphp\utils\Internet::quitarBarraIni($str);
}
/**
 * Pone la '/' final de una cadena (si no la tiene)
 *
 * @param string $str
 * @return string
 */
function ponerBarra($str)
{
	return \josecarlosphp\utils\Internet::ponerBarra($str);
}
/**
 * Pone la '/' al inicio de una cadena (si no la tiene)
 *
 * @param string $str
 * @return string
 */
function anteponerBarra($str)
{
	return \josecarlosphp\utils\Internet::anteponerBarra($str);
}
/**
 * Obtiene la ruta dentro del dominio según una url
 *
 * @param string $url
 * @return string
 */
function url2path($url)
{
	return \josecarlosphp\utils\Internet::url2path($url);
}
/**
 * Transforma una cadena en meta description
 *
 * @param string $str
 * @param bool $html_entity_decode
 * @param int $maxlen
 * @param int $desviacion
 * @param array $palabritas
 * @param mixed $flags
 * @param string $encoding
 * @param bool $htmlentities
 * @return string
 */
function string2description($str, $html_entity_decode=false, $maxlen=180, $desviacion=20, $palabritas=array('a', 'de', 'por', 'para', 'y', 'sin', 'desde', 'con', 'e', 'o', 'ó', 'sus'), $flags=ENT_COMPAT, $encoding='UTF-8', $htmlentities=true)
{
    return \josecarlosphp\utils\Internet::string2description($str, $html_entity_decode, $maxlen, $desviacion, $palabritas, $flags, $encoding, $htmlentities);
}

function utf8_encode_once($str)
{
    return \josecarlosphp\utils\Internet::utf8_encode_once($str);
}

function utf8_decode_once($str)
{
    return \josecarlosphp\utils\Internet::utf8_decode_once($str);
}

function is_utf8($str)
{
    return \josecarlosphp\utils\Internet::is_utf8($str);
}

function utf8_encode_file($origen, $destino, $length=null)
{
	return \josecarlosphp\utils\Internet::utf8_encode_file($origen, $destino, $length);
}

function pingDomain($domain, &$errno=null, &$errstr=null, $timeout=10)
{
    return \josecarlosphp\utils\Internet::pingDomain($domain, $errno, $errstr, $timeout);
}
