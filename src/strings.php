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
	return \josecarlosphp\utils\Strings::truncate($str, $len, $ext, $html, $descartarEspacios, $flags, $encoding);
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
	return \josecarlosphp\utils\Strings::quitarTildes($str, $modoMayusculas);
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
	return \josecarlosphp\utils\Strings::partirCadena($str, $tramos, $separador);
}

function formatoCuentaBancaria($str, $separador="-")
{
	return \josecarlosphp\utils\Strings::formatoCuentaBancaria($str, $separador);
}

function stripChars($str, $chars, $modoQuitar=false)
{
	return \josecarlosphp\utils\Strings::stripChars($str, $chars, $modoQuitar);
}
/**
 * Prepara un número de teléfono con un formato estándar
 *
 * @param string $str
 */
function formatoTelefono($str)
{
	return \josecarlosphp\utils\Strings::formatoTelefono($str);
}

function cogerTrozo($str, $pre, $sig)
{
	return \josecarlosphp\utils\Strings::cogerTrozo($str, $pre, $sig);
}

function quitarTrozo($str, $pre, $sig, $multi=true)
{
    return \josecarlosphp\utils\Strings::quitarTrozo($str, $pre, $sig, $multi);
}

function stripstr($str, $ini, $fin)
{
    return \josecarlosphp\utils\Strings::stripStr($str, $ini, $fin);
}

function stripistr($str, $ini, $fin)
{
    return \josecarlosphp\utils\Strings::stripiStr($str, $ini, $fin);
}

function isHash($str, $algo=null)
{
	return \josecarlosphp\utils\Strings::isHash($str, $algo);
}

function str_array2keys($str)
{
	return \josecarlosphp\utils\Strings::str_array2keys($str);
}
