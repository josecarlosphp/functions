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
 * @desc        Common use functions - strings.
 */

/**
 * Trunca una cadena
 *
 * @param string $str
 * @param int $len
 * @param string $ext
 * @param bool $html
 * @param bool $descartarEspacios
 * @return string
 */
function truncar($str, $len, $ext="...", $html=true, $descartarEspacios=false, $flags=ENT_COMPAT, $encoding='UTF-8')
{
	if($html)
	{
		return htmlentities(truncar(html_entity_decode($str), $len, $ext, false, $descartarEspacios), $flags, $encoding);
	}

	return mb_strlen($descartarEspacios ? str_replace(' ', '', $str) : $str) > $len ? trim(mb_substr($str, 0, $len-mb_strlen($ext))).$ext : $str;
}
/**
 * Quita las tildes y símbolos similares de una cadena.
 * Si $modoMayusculas es menor que cero, pasa la cadena a minúsculas,
 * si es mayor que cero la pasa a mayúsculas,
 * y si es cero (por defecto) no hace nada en este sentido.
 *
 * @param string $str
 * @param int $modoMayusculas
 * @return string
 */
function quitarTildes($str, $modoMayusculas=0)
{
	$patrones = array();

	if($modoMayusculas <= 0)
	{
		if($modoMayusculas < 0)
		{
			$str = mb_strtolower($str);
		}
		$patrones[] = array(array("á","à","ä","â"), "a");
		$patrones[] = array(array("é","è","ë","ê"), "e");
		$patrones[] = array(array("í","ì","ï","î"), "i");
		$patrones[] = array(array("ó","ò","ö","ô"), "o");
		$patrones[] = array(array("ú","ù","ü","û"), "u");
	}

	if($modoMayusculas >= 0)
	{
		if($modoMayusculas > 0)
		{
			$str = mb_strtoupper($str);
		}
		$patrones[] = array(array("Á","À","Ä","Â"), "A");
		$patrones[] = array(array("É","È","Ë","Ê"), "E");
		$patrones[] = array(array("Í","Ì","Ï","Î"), "I");
		$patrones[] = array(array("Ó","Ò","Ö","Ô"), "O");
		$patrones[] = array(array("Ú","Ù","Ü","Û"), "U");
	}

	foreach($patrones as $patron)
	{
		$str = str_replace($patron[0], $patron[1], $str);
	}

	return $str;
}
/**
 * "Parte" una cadena en trozos separándolos con $separador siguiendo los $tramos
 *
 * @param string $str
 * @param array $tramos
 * @param string $separador
 * @return string
 */
function partirCadena($str, $tramos, $separador="-")
{
	$resultado = '';
	$i = 0;
	for($c=0,$size=sizeof($tramos); $c<$size; $c++)
	{
		$tramo = (int)$tramos[$c];
		if($c > 0)
		{
			$resultado .= $separador;
		}
		$resultado .= mb_substr($str, $i, $tramo);
		$i += $tramo;
	}
	return $resultado;
}

function formatoCuentaBancaria($str, $separador="-")
{
	return $str ? partirCadena($str, array(4,4,2,10), $separador) : '';
}

function stripChars($str, $chars, $modoQuitar=false)
{
	$aux = '';
	$len = mb_strlen($str);
	for($c=0; $c<$len; $c++)
	{
		$char = mb_substr($str, $c, 1);
		if((!$modoQuitar && mb_strpos($chars, $char) !== false) || ($modoQuitar && mb_strpos($chars, $char) === false))
		{
			$aux .= $char;
		}
	}

	return $aux;
}
/**
 * Prepara un número de teléfono con un formato estándar
 *
 * @param string $str
 */
function formatoTelefono($str)
{
	$str = str_replace(array('+','-',' ','/'), '', $str);
	if(mb_strlen($str) == 11 && mb_substr($str,0,2) == "34")
	{
		$str = mb_substr($str, 2);
	}

	$aux = "";
	for($c=0,$size=mb_strlen($str); $c<$size; $c++)
	{
		if($c > 0 && $c%3 == 0 && $c < $size-1)
		{
			$aux .= " ";
		}

		$aux .= mb_substr($str, $c, 1);
	}

	return $aux;
}

function cogerTrozo($str, $pre, $sig)
{
	/*
	$str = substr($str, strpos($str, $pre) + strlen($pre));
    $str = substr($str, 0, strpos($str, $sig));
    */
	$str = mb_substr($str, mb_strpos($str, $pre) + mb_strlen($pre));
    $str = mb_substr($str, 0, mb_strpos($str, $sig));

    return $str;
}

function quitarTrozo($str, $pre, $sig, $multi=true)
{
    while(($posA = mb_strpos($str, $pre)) !== false)
    {
        $aux = mb_substr($str, 0, $posA);
        $str = mb_substr($str, $posA + mb_strlen($pre));

        $posB = mb_strpos($str, $sig);
        if($posB === false)
        {
			$str = $aux;
            break;
        }

        $str = $aux . mb_substr($str, $posB + mb_strlen($sig));

        if(!$multi)
        {
            break;
        }
    }

    return $str;
}

function stripstr($str, $ini, $fin)
{
    while (($pos = mb_strpos($str, $ini)) !== false) {
        $aux = mb_substr($str, $pos + mb_strlen($ini));
        $str = mb_substr($str, 0, $pos);

        if (($pos2 = mb_strpos($aux, $fin)) !== false) {
            $str .= mb_substr($aux, $pos2 + mb_strlen($fin));
        }
    }

    return $str;
}

function stripistr($str, $ini, $fin)
{
    while (($pos = mb_stripos($str, $ini)) !== false) {
        $aux = mb_substr($str, $pos + mb_strlen($ini));
        $str = mb_substr($str, 0, $pos);

        if (($pos2 = mb_stripos($aux, $fin)) !== false) {
            $str .= mb_substr($aux, $pos2 + mb_strlen($fin));
        }
    }

    return $str;
}

function isHash($str, $algo=null)
{
	$lengths = array(8, 32, 40, 48, 56, 64, 80, 96, 128);

	switch($algo)
	{
		case 'adler32':
		case 'crc32':
		case 'crc32b':
			$length = 8;
			break;
		case 'md2':
		case 'md4':
		case 'md5':
		case 'ripemd128':
		case 'tiger128,3':
		case 'tiger128,4':
		case 'haval128,3':
		case 'haval128,4':
		case 'haval128,5':
			$length = 32;
			break;
		case 'sha1':
		case 'ripemd160':
		case 'tiger160,3':
		case 'tiger160,4':
		case 'haval160,3':
		case 'haval160,4':
		case 'haval160,5':
			$length = 40;
			break;
		case 'tiger192,3':
		case 'tiger192,4':
		case 'haval192,3':
		case 'haval192,4':
		case 'haval192,5':
			$length = 48;
			break;
		case 'haval224,3':
		case 'haval224,4':
		case 'haval224,5':
			$length = 56;
			break;
		case 'sha256':
		case 'ripemd256':
		case 'snefru':
		case 'gost':
		case 'haval256,3':
		case 'haval256,4':
		case 'haval256,5':
			$length = 64;
			break;
		case 'ripemd320':
			$length = 80;
			break;
		case 'sha384':
			$length = 96;
			break;
		case 'sha512':
		case 'whirlpool':
			$length = 128;
			break;
		default:
			$length = null;
	}

	$len = mb_strlen($str);
	if($len == $length || (is_null($length) && in_array($len, $lengths)))
	{
		for($c=0; $c<$len; $c++)
		{
			if(mb_strpos('0123456789abcdef', mb_substr($str, $c, 1)) === false)
			{
				return false;
			}
		}

		return true;
	}

	return false;
}

function str_array2keys($str)
{
	$str = trim($str);
	$trozos = array();
	$pos = mb_strrpos($str, '=>');
	while($pos !== false)
	{
		$str = mb_substr($str, 0, $pos);
		$pos = mb_strrpos($str, ',');
		if($pos !== false)
		{
			$trozos[] = mb_substr($str, $pos + 1);
			$str = mb_substr($str, 0, $pos);
		}
		else
		{
			$trozos[] = $str;
			break;
		}

		$pos = mb_strrpos($str, '=>');
	}

	return implode("=>'', ", array_reverse($trozos))."=>'')";
}
