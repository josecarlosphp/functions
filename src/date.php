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
    return \josecarlosphp\utils\Dates::calculateAge($dia, $mes, $ano);
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
	return \josecarlosphp\utils\Dates::calculateAgeStr($fecha, $formato);
}

function descomponerFecha($fecha, $formato='Y-m-d')
{
	return \josecarlosphp\utils\Dates::breakdownDate($fecha, $formato);
}

//Porque se definió así y se usa aún en algún código
function fechayhora2time($fechayhora)
{
    return \josecarlosphp\utils\Dates::datetime2time($fechayhora);
}

function fecha2time($fecha, $formato='Y-m-d')
{
    return \josecarlosphp\utils\Dates::date2time($fecha, $formato);
}

function fechayhora2screen($fecha, $formato='Y-m-d')
{
    return \josecarlosphp\utils\Dates::datetime2screen($fecha, $formato);
}

function fechaYmd2dmY($fecha, $separador='-')
{
    return \josecarlosphp\utils\Dates::Ymd2dmY($fecha, $separador);
}

function fechaYmd2dma($fecha, $separador='-')
{
    return \josecarlosphp\utils\Dates::Ymd2dma($fecha, $separador);
}

function fechadmY2Ymd($fecha, $separador='-')
{
    return \josecarlosphp\utils\Dates::dmY2Ymd($fecha, $separador);
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
    return \josecarlosphp\utils\Dates::getNumDaysOfMonth($mes, $ano);
}

function getLastDayOfMonth($mes, $ano, $format='Y-m-d')
{
    return \josecarlosphp\utils\Dates::getLastDayOfMonth($mes, $ano, $format);
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
    return \josecarlosphp\utils\Dates::addDays($date, $days, $workonly);
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
    return \josecarlosphp\utils\Dates::susDays($date, $days, $workonly);
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
    return \josecarlosphp\utils\Dates::addMonths($date, $meses);
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
    return \josecarlosphp\utils\Dates::daysDifference($desde, $hasta, $formato);
}

function DaysDifferenceYmd($desde, $hasta)
{
    return \josecarlosphp\utils\Dates::daysDifferenceYmd($desde, $hasta);
}

function DaysDifferencedmY($desde, $hasta)
{
    return \josecarlosphp\utils\Dates::daysDifferencedmY($desde, $hasta);
}

function DaysDifferenceTime($desde, $hasta)
{
	return \josecarlosphp\utils\Dates::daysDifferenceTime($desde, $hasta);
}

function GetDiaSemana($dia, $mes, $ano)
{
    return \josecarlosphp\utils\Dates::getWeekday($dia, $mes, $ano);
}
/**
 * Convierte una cadena de fecha en formato dd/mm/aaaa ó yyyy-mm-dd en un array(año, mes, día)
 *
 * @param string $date
 * @return array
 */
function datestr2datearr($date)
{
	return \josecarlosphp\utils\Dates::datestr2datearr($date);
}

function time2tiempo($time)
{
	return \josecarlosphp\utils\Dates::time2tiempo($time);
}

function tiempo2str($tiempo)
{
    return \josecarlosphp\utils\Dates::tiempo2str($tiempo);
}