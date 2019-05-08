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
	$query = "INSERT INTO `".$table."`(";
	$keys = array_keys($data);
	for($c=0,$size=sizeof($data); $c<$size; $c++)
	{
        if(is_array($data[$keys[$c]]) || is_object($data[$keys[$c]]))
        {
            $data[$keys[$c]] = serialize($data[$keys[$c]]);
        }

		if($c > 0)
		{
			$query .= ', ';
		}
		$query .= "`".$keys[$c]."`";
	}
	$query .= ") VALUES(";
	for($c=0; $c<$size; $c++)
	{
		if($c > 0)
		{
			$query .= ', ';
		}
        $query .= sprintf("'%s'", addcslashes($data[$keys[$c]], "\\'"));
	}

	$query .= ")";

	if($onDuplicateKeyUpdate)
	{
		$query .= " ON DUPLICATE KEY UPDATE ";
		$keys = array_keys($data);
		for($c=0,$size; $c<$size; $c++)
		{
			if($c > 0)
			{
				$query .= ", ";
			}
            $query .= sprintf("`%s` = '%s'", $keys[$c], addcslashes($data[$keys[$c]], "\\'"));
		}
	}

	return $query.';';
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
    if(empty($data))
    {
        $data = is_array($ids) ? $ids : array('id'=>$ids);
    }

	$query = "UPDATE `".$table."` SET ";
	$keys = array_keys($data);
	for($c=0,$size=sizeof($data); $c<$size; $c++)
	{
        if(is_array($data[$keys[$c]]) || is_object($data[$keys[$c]]))
        {
            $data[$keys[$c]] = serialize($data[$keys[$c]]);
        }

		if($c > 0)
		{
			$query .= ', ';
		}
		$query .= sprintf("`%s` = '%s'", $keys[$c], addcslashes($data[$keys[$c]], "\\'"));
	}

	return $query.DbConnection::ids2where($ids, $devolverVacio).";";
}
/**
 * @return string
 * @param string $table
 * @param array $ids
 */
function buildQuery_Delete($table, $ids=null)
{
	return "DELETE FROM `".$table."`".DbConnection::ids2where($ids).";";
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
	$filtro = trim($filtro);
	if($filtro)
	{
		if($where)
		{
			if(strtoupper(substr($filtro, 0, 6)) == 'WHERE ')
			{
				$filtro = $where.' AND ('.substr($filtro, 6).')';
			}
			else
			{
				$filtro = $where.' '.$filtro;
			}
		}
	}
	else
	{
		$filtro = $where;
	}

	return $filtro;
}
