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
	if (!isset($array) || sizeof($array) == 0) {
        return $array;
    }

    $arraydefrag = array();
    foreach ($array as $element) {
        if (isset($element)) {
            $arraydefrag[] = $element;
        }
    }

    return $arraydefrag;
}
/**
 * @return string
 * @param $array array
 * @param $separator string
 * @param $recursive bool
 * @desc Gets a string representation of an array elements.
 */
function array_ToString($array, $separator=",", $recursive=false)
{
	$string = '';
    foreach ($array as $item) {
        if ($recursive && is_array($item)) {
            $string .= array_ToString($item, $separator, true);
        } else {
            $string .= $item.$separator;
        }
    }

    return mb_substr($string, 0, mb_strlen($string) - mb_strlen($separator));
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
function array_ToHTMLTableSimple($array, $numCols=0, $tableFormat="", $rowFormat="", $cellFormat="", $header="")
{
	if ($numCols == 0) {
		$numCols = sizeof($array);
    }

	if ($header) {
		$header = "<th colspan=\"$numCols\">$header</th>";
    }

	$html = "<table $tableFormat>$header<tr $rowFormat>";
	$currentCol = 0;
	foreach ($array as $element)	{
		if (++$currentCol > $numCols) {
			$html .= "</td></tr><tr $rowFormat>";
			$currentCol = 1;
		}
		$html .= "<td $cellFormat>$element</td>";
	}
	$html .= "</tr></table>";

    return $html;
}

function array_ToHTMLTable2xN($array, $tableFormat="", $rowFormat="", $cellFormat="", $header="")
{
	$html = "<table {$tableFormat}>";
	if ($header) {
		$html .= "<th colspan=\"2\">{$header}</th>";
    }
	foreach ($array as $key=>$val) {
		$html .= "<tr {$rowFormat}><td {$cellFormat}>{$key}</td><td>".(is_array($val) ? array_ToHTMLTable2xN($val) : $val)."</td></tr>";
	}
	$html .= "</table>";

	return $html;
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
function array_ToHTMLTable($array, $hasHeader=false, $tableFormat="", $rowFormat="", $cellFormat="", $distributeColumnsUniformly=false)
{
	$html = "<table $tableFormat>";
	$isHeader = $hasHeader;
	if (is_array($array)) {
        foreach ($array as $subArray) {
			$html .= array_ToHTMLRow($subArray, $isHeader, $rowFormat, $cellFormat, $distributeColumnsUniformly);
			$isHeader = false;
		}
    } else {
		$html .= array_ToHTMLRow($array, $isHeader, $rowFormat, $cellFormat);
    }
	$html .= "</table>";

    return $html;
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
function array_ToHTMLRow($array, $isHeader=false, $rowFormat="", $cellFormat="", $distributeColumnsUniformly=false)
{
	$td_width = "";
	if ($distributeColumnsUniformly) {
		$td_width = (100 / sizeof($array[0]))."%' ";
    }
	$tag = "td";
	if ($isHeader) {
		$tag = "th";
    }
	$html = "<tr $rowFormat>";
	if (is_array($array)) {
		foreach ($array as $element) {
			$html .= "<$tag $cellFormat";
			if ($distributeColumnsUniformly && mb_strpos($cellFormat, "width") === false) {
                $html .= " width='".$td_width;
            }
			$html .= ">$element</td>";
		}
    } else {
		$html .= "<$tag $cellFormat>$array</td>";
    }
	$html .= "</tr>";

	return $html;
}
/**
 * @return int
 * @param $array array
 * @desc Gets maximum sizeof value from an array and sub arrays
 */
function array_getMaxSizeof($array)
{
	if(is_array($array))
	{
		$len = 0;
		$subLen = 0;
		$maxLen = 0;
		foreach($array as $element)
		{
			$len++;
			if(is_array($element))
				$subLen = array_getMaxSizeof($element);
			if($len > $maxLen)
				$maxLen = $len;
			if($subLen > $maxLen)
				$maxLen = $subLen;
		}
		return $maxLen;
	}
	else
		return 1;
}
/**
 * @return int
 * @param $array array
 * @desc Gets maximum number of levels from an array
 */
function array_getMaxLevels($array)
{
	$levels = 0;
	if(is_array($array))
	{
		$levels = 1;
		foreach($array as $element)
		{
			$levelsSub = 1;
			if(is_array($element))
				$levelsSub += array_getMaxLevels($element);
			if($levelsSub > $levels)
				$levels = $levelsSub;
		}
	}
	return $levels;
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
	$count = 0;
	foreach($array as $element)
		if(!is_array($element))
			$count++;
		else
		{
			if($recursive)
				$count += array_count($element,true,true);
			if($includeArrays)
				$count++;
		}
	return $count;
}
/**
 * @return array
 * @param $string string
 * @param $separator string
 * @param $allowduplicates
 * @desc Gets an array from a string.
 */
function array_stringToArray($string, $separator=";",$allowduplicates=false)
{
	$array = array();
	$tok = strtok($string,$separator);
	while($tok)
	{
		if($allowduplicates)
			$array[] = $tok;
		elseif(!in_array($tok,$array))
			$array[] = $tok;
		$tok = strtok($separator);
	}
	return $array;
}
/**
 * @return string
 * @param $array array
 */
function array_export($array, $striptags=false, $pre=false)
{
	$size = sizeof($array);
	if(!is_array($array) || $size == 0)
		return "";
	$keys = array_keys($array);
	$return = "<table>";
	for($c=0; $c<$size; $c++)
	{
		$key = $keys[$c];
		$value = $striptags ? strip_tags($array[$key]) : $array[$key];
		$value = $pre ? "<pre>".$value."</pre>" : $value;
		$return .= "<tr><td>".$key."</td><td>".$value."</td></tr>";
	}
	return $return .= "</table>";
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
	$keys = array_keys($array);
	foreach($keys as $key)
	{
		$str = "return $funcname(\$array[\$key]);";
		$array[$key] = eval($str);
	}
	return true;
}
/**
 * Clona un array
 *
 * @param array $array
 * @return array
 */
function array_clone($array)
{
	$clon = array();
	foreach($array as $key=>$value)
	{
		$clon[$key] = $value;
	}
	return $clon;
}
/**
 * Ordena aleatoriamente los elementos de un array asociativo
 *
 * @param array $array
 * @return array
 */
function array_shuffle_assoc($array)
{
	$keys = array_keys($array);
	shuffle($keys);
	$nuevo = array();
	foreach($keys as $key)
	{
		$nuevo[$key] = $array[$key];
	}

	return $nuevo;
}
/**
 * Indica si un array es numérico o no
 *
 * @param array $arr
 * @return bool
 */
function array_is_num($arr)
{
	if(is_array($arr))
	{
		foreach($arr as $k=>$v)
		{
			if(!is_int($k))
			{
				return false;
			}
		}

		return true;
	}

	return false;
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
	if(sizeof($arr1) == sizeof($arr2))
	{
		foreach($arr1 as $key=>$value)
		{
			if(!isset($arr2[$key]) || ($trim ? trim($arr2[$key]) != trim($value) : $arr2[$key] != $value))
			{
                $i = $key;

				return false;
			}
		}

		return true;
	}

	return false;
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
	if(sizeof($arr1) == sizeof($arr2))
	{
		foreach($arr1 as $key=>$value)
		{
			if(!isset($arr2[$key]))
			{
				return false;
			}

            switch($arr2[$key])
            {
                case 'int':
                    if(!is_int($value) && (!is_numeric($value) || (0+$value) != intval($value)))
                    {
                        return false;
                    }
                    break;
                case 'float':
                    if(!is_float($value) && (!is_numeric($value) || (0+$value) != floatval($value)))
                    {
                        return false;
                    }
                    break;
                case 'double':
                    if(!is_double($value) && (!is_numeric($value) || (0+$value) != doubleval($value)))
                    {
                        return false;
                    }
                    break;
                case 'bool':
                    if(!is_bool($value) && !in_array($value, array('1','0',1,0)) && !in_array(mb_strtolower($value), array('true','false')))
                    {
                        return false;
                    }
                    break;
                case 'string':
                    if(!is_string($value) && (''.$value) != strval($value))
                    {
                        return false;
                    }
                    break;
                default:
                    return false;
            }
		}

		return true;
	}

	return false;
}
/**
 * Obtiene una cadena a partir de un array asociativo,
 * puede ser: js, json, csv, xml, serialize
 *
 * @param array $rows
 * @param string $formato
 * @return string
 */
function array_print_rows($rows, $formato=null)
{
	switch($formato)
	{
		case 'js':
			$str = '[';
			$sep = '';
			foreach($rows as $row)
			{
				$str .= $sep.(is_array($row) ? array_print_rows($row, 'js') : sprintf("'%s'", addcslashes($row, "'")));
				$sep = ',';
			}
			$str .= ']';
			break;
		case 'json':
			//php4
			/*
			//hay que haber cargado la clase Services_JSON.class.php
			$json = new Services_JSON();
			$str = $json->encode($rows);
			*/

			//php5
			$str = json_encode($rows);
			break;
		case 'csv':
			$str = '';
			foreach($rows as $row)
			{
				$sep = '';
				foreach($row as $value)
				{
					$str .= sprintf('%s"%s"', $sep, $value);
					$sep = ';';
				}

				$str .= "\n";
			}
			break;
		case 'xml':
			$str = var_ToXML($rows, 'row', 'rows', 'row', 'rows');
			break;
		case 'serialize':
		default:
			$str = serialize($rows);
			break;
	}

	return $str;
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
	$str = '';
	$sep = '';
	foreach($arr as $key=>$value)
	{
		if(is_array($value))
		{
			foreach($value as $key2=>$value2)
			{
				if(is_array($value2))
				{
					foreach($value2 as $key3=>$value3)
					{
						if(is_array($value3))
						{
							foreach($value3 as $key4=>$value4)
							{
								$str .= $urlencode ? sprintf('%s%s[%s][%s][%s]=%s', $sep, urlencode($key), urlencode($key2), urlencode($key3), urlencode($key4), urlencode($value4)) : sprintf('%s%s[%s][%s][%s]=%s', $sep, $key, $key2, $key3, $key4, is_bool($value4) ? ($value4 ? '1' : '0') : $value4);
								$sep = '&';
							}
						}
						else
						{
							$str .= $urlencode ? sprintf('%s%s[%s][%s]=%s', $sep, urlencode($key), urlencode($key2), urlencode($key3), urlencode($value3)) : sprintf('%s%s[%s][%s]=%s', $sep, $key, $key2, $key3, is_bool($value3) ? ($value3 ? '1' : '0') : $value3);
							$sep = '&';
						}
					}
				}
				else
				{
					$str .= $urlencode ? sprintf('%s%s[%s]=%s', $sep, urlencode($key), urlencode($key2), urlencode($value2)) : sprintf('%s%s[%s]=%s', $sep, $key, $key2, is_bool($value2) ? ($value2 ? '1' : '0') : $value2);
					$sep = '&';
				}
			}
		}
		else
		{
			$str .= $urlencode ? sprintf('%s%s=%s', $sep, urlencode($key), urlencode($value)) : sprintf('%s%s=%s', $sep, $key, is_bool($value) ? ($value ? '1' : '0') : $value);
		}

		$sep = '&';
	}

	return $str;
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
	$str = $nivel == 0 ? "<?xml version=\"1.0\" encoding=\"{$encoding}\" ?>\n" : "";

	$tab = "";
	for($c=0; $c<$nivel; $c++)
	{
		$tab .= "\t";
	}

	if(is_array($var))
	{
		$esAsociativo = !array_is_num($var);

		$str .= sprintf("%s<%s>\n", $tab, $nombreConjunto);
		foreach($var as $key=>$value)
		{
			$str .= var_ToXML($value, $esAsociativo ? $key : $nombreItemGeneral, $esAsociativo ? $key : $nombreItemGeneral, $nombreItemGeneral, $nombreConjuntoGeneral, $encoding, $nivel+1);
		}
		$str .= sprintf("%s</%s>\n", $tab, $nombreConjunto);
	}
	else
	{
		$str .= sprintf("%s<%s>%s</%s>\n", $tab, $nombreItem, is_numeric($var) || empty($var) ? $var : "<![CDATA[{$var}]]>", $nombreItem);
	}

	return $str;
}

function array_key_exists_recursive($key, $array, &$element='', &$path=array())
{
	if(is_array($array))
	{
		if(array_key_exists($key, $array))
		{
			$element = $array[$key];

			return true;
		}

		foreach($array as $i=>$subarray)
		{
			if(array_key_exists_recursive($key, $subarray, $element, $path))
			{
				array_unshift($path, $i);

				return true;
			}
		}
	}

	return false;
}

function array_reverse_special($arr, $indices=null)
{
	if(is_null($indices))
	{
		$indices = array_keys($arr);
	}

	$rev = array_reverse($indices);
	$aux = array();
	$n = 0;
	foreach($rev as $i)
	{
		if($arr[$i])
		{
			$aux[] = $arr[$i];
		}
		else
		{
			$n++;
		}
	}

	while($n)
	{
		$aux[] = '';
		$n--;
	}

	foreach($indices as $key=>$i)
	{
		$arr[$i] = $aux[$key];
	}

	return $arr;
}
