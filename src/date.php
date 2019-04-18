<?php
/**
 * This file is part of josecarlosphp/functions - Common use functions.
 *
 * josecarlosphp/db is free software: you can redistribute it and/or modify
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
 * @desc        Common use functions - date.
 */

/**
 * Calcula la edad para una fecha dada
 *
 * @param int $dia
 * @param int $mes
 * @param int $ano
 * @return int
 */
function calcularEdad($dia, $mes ,$ano)
{
    $edad = date("Y") - $ano - 1; //-1 porque no sé si ha cumplido años ya este año
    if($edad >= 0)
    {
        $difMeses = date("n") - $mes;
        if($difMeses == 0)
        {
            return ((date("j") - $dia) < 0) ? $edad : $edad+1;
        }
        return ($difMeses < 0) ? $edad : $edad+1;
    }
    return false;
}
/**
 * Calcula la edad para una fecha dada
 *
 * @param string $fecha
 * @param string $formato
 * @return int
 */
function calcularEdadStr($fecha, $formato='Y-m-d')
{
	$arr = descomponerFecha($fecha, $formato);

	return calcularEdad($arr[2], $arr[1], $arr[0]);
}

function descomponerFecha($fecha, $formato='Y-m-d')
{
	switch(mb_strtolower($formato))
    {
    	case 'd-m-y':
    	case 'd/m/y':
    	case 'd-m-a':
    	case 'd/m/a':
    	case 'dd-mm-yyyy':
    	case 'dd/mm/yyyy':
    	case 'dd-mm-aaaa':
    	case 'dd/mm/aaaa':
    		$ano = intval(substr($fecha, 6, 4));
    		$mes = intval(substr($fecha, 3, 2));
    		$dia = intval(substr($fecha, 0, 2));
    		break;
		default:
    	case 'y-m-d':
    	case 'y/m/d':
    	case 'a-m-d':
    	case 'a/m/d':
    	case 'yyyy-mm-dd':
    	case 'yyyy/mm/dd':
    	case 'aaaa-mm-dd':
    	case 'aaaa/mm/dd':
    		$ano = intval(substr($fecha, 0, 4));
    		$mes = intval(substr($fecha, 5, 2));
    		$dia = intval(substr($fecha, 8, 2));
    		break;
    }

    if(strlen($fecha > 10))
    {
        $hora = intval(substr($fecha, 11, 2));
        $minuto = intval(substr($fecha, 14, 2));
        $segundo = intval(substr($fecha, 17, 2));
    }
    else
    {
        $hora = 0;
        $minuto = 0;
        $segundo = 0;
    }

    return array($ano, $mes, $dia, $hora, $minuto, $segundo);
}

//Porque se definió así y se usa aún en algún código
function fechayhora2time($fechayhora)
{
    return fecha2time($fechayhora);
}

function fecha2time($fecha, $formato='Y-m-d')
{
    $arr = descomponerFecha($fecha, $formato);

    return mktime($arr[3], $arr[4], $arr[5], $arr[1], $arr[2], $arr[0]);
}

function fechayhora2screen($fecha, $formato='Y-m-d')
{
    $arr = descomponerFecha($fecha, $formato);

    return sprintf('%04s-%02s-%02s <span class="mini">%02s:%02s</span>', $arr[0], $arr[1], $arr[2], $arr[3], $arr[4]);
}

function fechaYmd2dmY($fecha, $separador="-")
{
    $ano = substr($fecha, 0, 4);
    $mes = substr($fecha, 5, 2);
    $dia = substr($fecha, 8, 2);

    return "{$dia}{$separador}{$mes}{$separador}{$ano}";
}

function fechaYmd2dma($fecha, $separador="-")
{
    $ano = substr($fecha, 2, 2);
    $mes = substr($fecha, 5, 2);
    $dia = substr($fecha, 8, 2);

    return "{$dia}{$separador}{$mes}{$separador}{$ano}";
}

function fechadmY2Ymd($fecha, $separador="-")
{
    $ano = substr($fecha, 6, 4);
    $mes = substr($fecha, 3, 2);
    $dia = substr($fecha, 0, 2);

    return "{$ano}{$separador}{$mes}{$separador}{$dia}";
}

/**
 * Obtiene el número de días de un mes concreto de un año concreto.
 * Los meses son de 1 a 12 pero admite valores mayores o menores,
 * por ejemplo si ponemos mes 0 año 2010 devolverá los días del mes
 * 12 del año 2009
 *
 * @param mixed $mes
 * @param int $ano
 * @return int
 */
function getNumDaysOfMonth($mes, $ano)
{
    $dias = array(
        1=>31,
        2=>28,
        3=>31,
        4=>30,
        5=>31,
        6=>30,
        7=>31,
        8=>31,
        9=>30,
        10=>31,
        11=>30,
        12=>31,
        );

    $mes = intval($mes);

    while($mes < 1)
    {
        $mes += 12;
        $ano--;
    }

    while($mes > 12)
    {
        $mes -= 12;
        $ano++;
    }

    return ($mes == 2 && checkdate(2, 29, $ano)) ? $dias[$mes]+1 : $dias[$mes];
}

function getLastDayOfMonth($mes, $ano, $format="Y-m-d")
{
    return date($format, fecha2time(sprintf("%04s-%02s-%02s", $ano, $mes, getNumDaysOfMonth($mes, $ano))));
}
/**
 * Añade días a una fecha
 *
 * @param string $date Fecha en formato yyyy-mm-dd
 * @param int $days
 * @param bool $workonly
 * @return string Fecha en formato yyyy-mm-dd
 */
function AddDays($date, $days, $workonly=false)
{
    if($days < 0)
    {
        return SusDays($date, $days, $workonly);
    }

    $mes = substr($date,5,2);
    $dia = substr($date,8,2);
    $ano = substr($date,0,4);
    $time = mktime(0, 0, 0, $mes, $dia, $ano);
    while($days > 0)
    {
        $ok = true;
        if($workonly)
        {
            $day = date('w', $time);
            if($day < 1 || $day > 5)
            {
                $ok = false;
            }
        }
        if($ok)
        {
            $days--;
        }

        $dia++;
        $time = mktime(0, 0, 0, $mes, $dia, $ano);
    }

    return date('Y-m-d', $time);
}
/**
 * Resta días a una fecha
 *
 * @param string $date Fecha en formato yyyy-mm-dd
 * @param int $days
 * @param bool $workonly
 * @return string Fecha en formato yyyy-mm-dd
 */
function SusDays($date, $days, $workonly=false)
{
    $mes = substr($date,5,2);
    $dia = substr($date,8,2);
    $ano = substr($date,0,4);
    $time = mktime(0, 0, 0, $mes, $dia, $ano);
    while($days < 0)
    {
        $ok = true;
        if($workonly)
        {
            $day = date('w', $time);
            if($day < 1 || $day > 5)
            {
                $ok = false;
            }
        }
        if($ok)
        {
            $days++;
        }

        $dia--;
        $time = mktime(0, 0, 0, $mes, $dia, $ano);
    }

    return date('Y-m-d', $time);
}
/**
 * Añade meses a una fecha
 *
 * @param string $date Fecha en formato yyyy-mm-dd
 * @param int $meses
 * @return string Fecha en formato yyyy-mm-dd
 */
function AddMonths($date, $meses)
{
    $mes = substr($date,5,2);
    $dia = substr($date,8,2);
    $ano = substr($date,0,4);
    return date('Y-m-d', mktime(0, 0, 0, $mes+$meses, $dia, $ano));
}
/**
 * Diferencia en días entre dos fechas en formato dd/mm/yyyy
 * También admite fecha y hora en formato Y-m-d H:i:s en tal caso tiene en cuenta la hora
 *
 * @param string $desde
 * @param string $hasta
 * @param string $formato
 * @return int
 */
function DaysDifference($desde, $hasta, $formato='dd/mm/yyyy')
{
    return DaysDifferenceTime(fecha2time($desde, $formato), fecha2time($hasta, $formato));
}

function DaysDifferenceYmd($desde, $hasta)
{
    return DaysDifference($desde, $hasta, 'yyyy-mm-dd');
}

function DaysDifferencedmY($desde, $hasta)
{
    return DaysDifference($desde, $hasta, 'dd/mm/yyyy');
}

function DaysDifferenceTime($desde, $hasta)
{
	return floor(($hasta - $desde) / 86400);
}

function GetDiaSemana($dia, $mes, $ano)
{
    return date('w', mktime(0, 0, 0, $mes, $dia, $ano));
}
/**
 * Convierte una cadena de fecha en formato dd/mm/aaaa ó yyyy-mm-dd en un array(año, mes, día)
 *
 * @param string $date
 * @return array
 */
function datestr2datearr($date)
{
	return !is_numeric(substr($date, 2, 1)) && !is_numeric(substr($date, 5, 1)) ?
		array(substr($date, 6, 4), substr($date, 3, 2), substr($date, 0, 2))
		:
		array(substr($date, 0, 4), substr($date, 5, 2), substr($date, 8, 2));
}

function time2tiempo($time)
{
	$dias = floor($time / 86400);
	$time -= ($dias * 86400);

	$horas = floor($time / 3600);
	$time -= ($horas * 3600);

	$minutos = floor($time / 60);
	$time -= ($minutos * 60);

	return array('d'=>$dias, 'H'=>$horas, 'i'=>$minutos, 's'=>$time);
}
