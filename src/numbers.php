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
 * @desc        Common use functions - numbers.
 */

function medidaStr2Num($str, $unidad=1)
{
	return \josecarlosphp\utils\Numbers::medidaStr2Num($str, $unidad);
}
/**
 * Formats a number as currency
 *
 * @param double $amount
 * @param bool $showcurrsymbol
 * @param bool $uselocalcurrencysymbol
 * @return string
 */
function currency($amount, $showcurrsymbol=true, $uselocalcurrencysymbol=true)
{
    return \josecarlosphp\utils\Numbers::currency($amount, $showcurrsymbol, $uselocalcurrencysymbol);
}
/**
 * Aplica un porcentaje a una cantidad dada
 *
 * @param double $importe
 * @param float $porcentaje
 * @param int $base
 * @return double
 */
function aplicarPorcentaje($cantidad, $porcentaje, $base=100)
{
	return \josecarlosphp\utils\Numbers::aplicarPorcentaje($cantidad, $porcentaje, $base);
}
/**
 * Prepara un número para guardarlo en la base de datos.
 * No valida el número ni comprueba si es válido.
 *
 * @param mixed $n
 * @return mixed
 */
function prepararNumero($n)
{
	return \josecarlosphp\utils\Numbers::prepararNumero($n);
}
