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
 * @desc        Common use functions - arrays.
 */

/**
 * @return array
 * @param $array array
 * @desc Delete from an array those elements that don't have assigned a value.
 */
function array_Defrag($array)
{
    return \josecarlosphp\utils\Arrays::defrag($array);
}
/**
 * @return string
 * @param $array array
 * @param $separator string
 * @param $recursive bool
 * @desc Gets a string representation of an array elements.
 */
function array_ToString($array, $separator=',', $recursive=false)
{
	return \josecarlosphp\utils\Arrays::toString($array, $separator, $recursive);
}
/**
 * @return string
 * @param $array array
 * @param $numCols int
 * @param $tableFormat string
 * @param $rowFormat string
 * @param $cellFormat string
 * @param $header string
 * @desc Gets a HTML code string representing the given array level 0 as a table
 */
function array_ToHTMLTableSimple($array, $numCols=0, $tableFormat='', $rowFormat='', $cellFormat='', $header='')
{
	return \josecarlosphp\utils\Arrays::toHtmlTableSimple($array, $numCols, $tableFormat, $rowFormat, $cellFormat, $header);
}

function array_ToHTMLTable2xN($array, $tableFormat='', $rowFormat='', $cellFormat='', $header='')
{
	return \josecarlosphp\utils\Arrays::toHtmlTable2xN($array, $tableFormat, $rowFormat, $cellFormat, $header);
}
/**
 * @return string
 * @param $array array
 * @param $hasHeader bool
 * @param $tableFormat string
 * @param $rowFormat string
 * @param $cellFormat string
 * @param $distributeColumnsUniformly bool
 * @desc Gets a HTML code string representing the given array as a table.
 */
function array_ToHTMLTable($array, $hasHeader=false, $tableFormat='', $rowFormat='', $cellFormat='', $distributeColumnsUniformly=false)
{
	return \josecarlosphp\utils\Arrays::toHtmlTable($array, $hasHeader, $tableFormat, $rowFormat, $cellFormat, $distributeColumnsUniformly);
}
/**
 * @return string
 * @param $array array
 * @param $isHeader bool
 * @param $rowFormat string
 * @param $cellFormat string
 * @param $distributeColumnsUniformly bool
 * @desc Gets a HTML code string representing the given array as a table row.
 */
function array_ToHTMLRow($array, $isHeader=false, $rowFormat='', $cellFormat='', $distributeColumnsUniformly=false)
{
	return \josecarlosphp\utils\Arrays::toHtmlRow($array, $isHeader, $rowFormat, $cellFormat, $distributeColumnsUniformly);
}
/**
 * @return int
 * @param $array array
 * @desc Gets maximum sizeof value from an array and sub arrays
 */
function array_getMaxSizeof($array)
{
	return \josecarlosphp\utils\Arrays::getMaxSizeof($array);
}
/**
 * @return int
 * @param $array array
 * @desc Gets maximum number of levels from an array
 */
function array_getMaxLevels($array)
{
	return \josecarlosphp\utils\Arrays::getMaxLevels($array);
}
/**
 * @return int
 * @param $array array
 * @param $recursive bool
 * @param $includeArrays bool
 * @desc Counts elements from an array. If $recursive, counts elements from sub arrays too. If $includeArrays is false, it doesn't count sub arrays as elements.
 */
function array_count($array, $recursive=false, $includeArrays=true)
{
	return \josecarlosphp\utils\Arrays::count($array, $recursive, $includeArrays);
}
/**
 * @return array
 * @param $string string
 * @param $separator string
 * @param $allowduplicates
 * @desc Gets an array from a string.
 */
function array_stringToArray($string, $separator=';',$allowduplicates=false)
{
	return \josecarlosphp\utils\Arrays::stringToArray($string, $separator, $allowduplicates);
}
/**
 * @return string
 * @param $array array
 */
function array_export($array, $striptags=false, $pre=false)
{
	return \josecarlosphp\utils\Arrays::export($array, $striptags, $pre);
}
/**
 * Aplica una función (de usuario o propia de php) sobre todos los elementos de un array
 * OJO por ahora devuelve siempre true, no utilizar este valor de retorno
 *
 * @param array $array
 * @param string $funcname
 * @return bool
 */
function array_walk2(&$array, $funcname)
{
	return \josecarlosphp\utils\Arrays::walk($array, $funcname);
}
/**
 * Clona un array
 *
 * @param array $array
 * @return array
 */
function array_clone($array)
{
	return \josecarlosphp\utils\Arrays::clon($array);
}
/**
 * Ordena aleatoriamente los elementos de un array asociativo
 *
 * @param array $array
 * @return array
 */
function array_shuffle_assoc($array)
{
	return \josecarlosphp\utils\Arrays::shuffle_assoc($array);
}
/**
 * Indica si un array es numérico o no
 *
 * @param array $arr
 * @return bool
 */
function array_is_num($arr)
{
	return \josecarlosphp\utils\Arrays::is_num($arr);
}
/**
 * Comprueba si dos arrays son iguales (índices y elementos)
 *
 * @param array $arr1
 * @param array $arr2
 * @param bool $trim
 * @return bool
 */
function array_compare($arr1, $arr2, $trim=false, &$i=null)
{
	return \josecarlosphp\utils\Arrays::compare($arr1, $arr2, $trim, $i);
}
/**
 * Comprueba si el array 1 cumple la definición de tipos de variable del array 2
 *
 * @param array $arr1
 * @param array $arr2
 * @return bool
 */
function array_compare_type($arr1, $arr2)
{
	return \josecarlosphp\utils\Arrays::compare_type($arr1, $arr2);
}
/**
 * Obtiene una cadena a partir de un array asociativo,
 * puede ser: js, json, csv, xml, serialize
 *
 * @param array $rows
 * @param string $format
 * @return string
 */
function array_print_rows($rows, $format=null)
{
	return \josecarlosphp\utils\Arrays::print_rows($rows, $format);
}
/**
 * Convierte un array en una cadena query string
 *
 * @param array $arr
 * @param bool $urlencode
 * @return string
 */
function array_ToQueryString($arr, $urlencode=true)
{
	return \josecarlosphp\utils\Arrays::toQueryString($arr, $urlencode);
}
/**
 * Genera XML a partir de una variable
 *
 * @param mixed $var
 * @param string $nombreItem
 * @param string $nombreConjunto
 * @param string $nombreItemGeneral
 * @param string $nombreConjuntoGeneral
 * @param string $encoding
 * @param int $nivel
 * @return string
 */
function var_ToXML($var, $nombreItem='item', $nombreConjunto='array', $nombreItemGeneral='item', $nombreConjuntoGeneral='array', $encoding='UTF-8', $nivel=0)
{
	return \josecarlosphp\utils\Arrays::toXml($var, $nombreItem, $nombreConjunto, $nombreItemGeneral, $nombreConjuntoGeneral, $encoding, $nivel);
}

function array_key_exists_recursive($key, $array, &$element='', &$path=array())
{
	return \josecarlosphp\utils\Arrays::key_exists_recursive($key, $array, $element, $path);
}

function array_reverse_special($arr, $indices=null)
{
	return \josecarlosphp\utils\Arrays::reverse_special($arr, $indices);
}

/**
 * do the same than parse_str without max_input_vars limitation:
 * Parses $string as if it were the query string passed via a URL and sets variables in the current scope.
 * @param $string array string to parse (not altered like in the original parse_str(), use the second parameter!)
 * @param $result array  If the second parameter is present, variables are stored in this variable as array elements
 * @return bool true or false if $string is an empty string
 *
 * @author rubo77 at https://gist.github.com/rubo77/6821632
 **/
function my_parse_str($string, &$result)
{
	return \josecarlosphp\utils\Arrays::parse_str($string, $result);
}

/**
 * Better recursive array merge function listed on the array_merge_recursive PHP page in the comments.
 *
 * @param $array1 array
 * @param $array2 array
 */
function array_merge_recursive_distinct(array &$array1, array &$array2)
{
	return \josecarlosphp\utils\Arrays::merge_recursive_distinct($array1, $array2);
}