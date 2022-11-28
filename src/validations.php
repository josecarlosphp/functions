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
 * @desc        Common use functions - validations.
 */

/**
 * @return bool
 * @param $var string
 * @param $allowblank bool
 * @desc Validate an email. Returns true if the validation was successful, false otherwise
 */
function validateEmail($var, $allowblank=false)
{
	return \josecarlosphp\utils\Validations::validateEnail($var, $allowblank);
}
/**
 * @return bool
 * @param $var string
 * @desc Validate an url. Returns true if the validation was successful, false otherwise
 */
function validateUrl($var, $allowblank=false)
{
	return \josecarlosphp\utils\Validations::validateUrl($var, $allowblank);
}
/**
 * Valida un número de teléfono
 *
 * @param string $telf
 * @param bool $allowblank
 * @param string $extraallowedchars
 * @param mixed $inis
 * @return bool
 */
function validatePhone($telf, $allowblank=false, $extraallowedchars="", $inis=null)
{
	return \josecarlosphp\utils\Validations::validatePhone($telf, $allowblank, $extraallowedchars, $inis);
}
/**
 * Valida un número de móvil
 *
 * @param string $telf
 * @param bool $allowblank
 * @param string $extraallowedchars
 * @return bool
 */
function validateMobile($telf, $allowblank=false, $extraallowedchars="")
{
	return \josecarlosphp\utils\Validations::validateMobile($telf, $allowblank, $extraallowedchars);
}
/**
 * Valida un NIF o tarjeta de residencia
 *
 * @param string $dni
 * @param bool $allowblank
 * @return bool
 */
function validateNIFNIE($dni, $allowblank=false)
{
    return \josecarlosphp\utils\Validations::validateNIFNIE($dni, $allowblank);
}
/**
 * Valida un NIF o tarjeta de residencia
 *
 * @param string $dni
 * @param bool $allowblank
 * @return bool
 */
function validateNIF_NIE($dni, $allowblank=false)
{
	return \josecarlosphp\utils\Validations::validateNIF_NIE($dni, $allowblank);
}
/**
 * Valida un NIF
 *
 * @param string $dni
 * @param bool $allowblank
 * @return bool
 */
function validateNIF($dni, $allowblank=false)
{
    return \josecarlosphp\utils\Validations::validateNIF($dni, $allowblank);
}
/**
 * Valida un NIE
 *
 * @param string $dni
 * @param bool $allowblank
 * @return bool
 */
function validateNIE($dni, $allowblank=false)
{
    return \josecarlosphp\utils\Validations::validateNIE($dni, $allowblank);
}
/**
 * Valida un CIF
 *
 * @param string $cif
 * @param bool $allowblank
 * @return bool
 */
function validateCIF($cif, $allowblank=false)
{
	return \josecarlosphp\utils\Validations::validateCIF($cif, $allowblank);
}
/**
 * Valida un CIF, NIF o NIE
 *
 * @param string $doc
 * @param bool $allowblank
 * @return bool
 */
function validateCIFNIFNIE($doc, $allowblank=false)
{
	return \josecarlosphp\utils\Validations::validateCIFNIFNIE($doc, $allowblank);
}
/**
 * @return bool
 * @param string $str
 */
function validateStringAsNickOrPass($str)
{
	return \josecarlosphp\utils\Validations::validateStringAsNickOrPass($str);
}
/**
 * Valida más o menos un código postal
 *
 * @param string $cp
 * @param bool $allowblank
 * @return bool
 */
function validateCodigoPostal($cp, $allowblank=false)
{
	return \josecarlosphp\utils\Validations::validateCodigoPostal($cp, $allowblank);
}
/**
 * Valida una cadena según una longitud máxima y mínima y un juego de caracteres válido
 *
 * @param string $str
 * @param int $minlen
 * @param int $maxlen
 * @param string $validchars
 * @return bool
 */
function validateString($str, $minlen=9, $maxlen=9, $validchars='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789')
{
	return \josecarlosphp\utils\Validations::validateString($str, $minlen, $maxlen, $validchars);
}
/**
 * Valida un código de cuenta corriente
 *
 * @param string $str
 * @param bool $allowblank
 * @return bool
 */
function validateCCC($str, $allowblank=false)
{
	return \josecarlosphp\utils\Validations::validateCCC($str, $allowblank);
}
/**
 * Valida un código de cuenta IBAN
 *
 * @param string $str
 * @param bool $allowblank
 * @return bool
 */
function validateIBAN($str, $allowblank=false)
{
    return \josecarlosphp\utils\Validations::validateIBAN($str, $allowblank);
}
/**
 * Valida una fecha
 *
 * @param int $ano
 * @param int $mes
 * @param int $dia
 * @param mixed $min_ano
 * @param mixed $max_ano
 * @return bool
 */
function validateDatetime($ano, $mes, $dia, $hora=0, $minuto=0, $segundo=0, $min_ano=null, $max_ano=null)
{
    return \josecarlosphp\utils\Validations::validateDatetime($ano, $mes, $dia, $hora, $minuto, $segundo, $min_ano, $max_ano);
}
/**
 * Valida una fecha
 *
 * @param int $ano
 * @param int $mes
 * @param int $dia
 * @param mixed $min_ano
 * @param mixed $max_ano
 * @return bool
 */
function validateDate($ano, $mes, $dia, $min_ano=null, $max_ano=null)
{
    return \josecarlosphp\utils\Validations::validateDate($ano, $mes, $dia, $min_ano, $max_ano);
}
/**
 * Valida una fecha pasada como cadena (por defecto formato yyyy-mm-dd)
 *
 * @param str $date
 * @param mixed $min_ano
 * @param mixed $max_ano
 * @param str $formato
 * @return bool
 */
function validateDateStr($date, $min_ano=null, $max_ano=null, $formato='dd/mm/yyyy')
{
    return \josecarlosphp\utils\Validations::validateDateStr($date, $min_ano, $max_ano, $formato);
}
/**
 * Valida un código de cuenta de cotización (Seguridad Social)
 *
 * @param string $str
 * @param bool $allowblank
 * @return bool
 */
function validateCCCot($str, $allowblank=false)
{
	return \josecarlosphp\utils\Validations::validateCCCot($str, $allowblank);
}
