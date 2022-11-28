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
 * @desc        Common use functions - sql.
 */

use josecarlosphp\db\DbConnection;

/**
 * @return string
 * @param array $data
 * @param string $table
 * @param bool $onDuplicateKeyUpdate
 */
function buildQuery_Insert($data, $table, $onDuplicateKeyUpdate=false)
{
	return \josecarlosphp\utils\Sql::buildQuery_Insert($data, $table, $onDuplicateKeyUpdate);
}
/**
 * @return string
 * @param array $data
 * @param string $table
 * @param ids array o $string
 * @param bool $devolverVacio
 */
function buildQuery_Update($data, $table, $ids=null, $devolverVacio=false)
{
    return \josecarlosphp\utils\Sql::buildQuery_Update($data, $table, $ids, $devolverVacio);
}
/**
 * @return string
 * @param string $table
 * @param array $ids
 */
function buildQuery_Delete($table, $ids=null)
{
	return \josecarlosphp\utils\Sql::buildQuery_Delete($table, $ids);
}
/**
 * Une una condición where y un filtro que puede contener where, order by,...
 *
 * @param string $where
 * @param string $filtro
 * @return string
 */
function mergeWhereFiltro($where='', $filtro='')
{
	return \josecarlosphp\utils\Sql::mergeWhereFilter($where, $filtro);
}
