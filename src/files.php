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
 * @desc        Common use functions - files.
 */

/**
 * @return mixed
 * @param $file string
 * @param $evalonerror string
 * @desc If given file exists, includes it, if not, evals given code string ("false" by default).
 */
function include_ifexists($file, $evalonerror='false')
{
	return \josecarlosphp\utils\Files::include_ifExists($file, $evalonerror);
}
/**
 * @return mixed
 * @param $file string
 * @param $evalonerror string
 * @desc If given file exists, includes_once it, if not, evals given code string ("false" by default).
 */
function include_once_ifexists($file, $evalonerror='false;')
{
	return \josecarlosphp\utils\Files::include_once_ifExists($file, $evalonerror);
}
/**
 * @return mixed
 * @param $file string
 * @param $evalonerror string
 * @desc If given file exists, requires it, if not, evals given code string ("false" by default).
 */
function require_ifexists($file, $evalonerror='false;')
{
	return \josecarlosphp\utils\Files::require_ifExists($file, $evalonerror);
}
/**
 * @return mixed
 * @param $file string
 * @param $evalonerror string
 * @desc If given file exists, requires_once it, if not, evals given code string ("false" by default).
 */
function require_once_ifexists($file, $evalonerror='false;')
{
	return \josecarlosphp\utils\Files::require_once_ifExists($file, $evalonerror);
}
/**
 * @return array
 * @param $dir string
 * @param $includepath bool
 * @param $recursive bool
 * @param $mascara string
 * @desc Gets the names of the dirs existing in a given dir, with dir path if $includepath is true.
 */
function getDirs($dir, $includepath=false, $recursive=false, $mascara='')
{
	return \josecarlosphp\utils\Files::getDirs($dir, $includepath, $recursive, $mascara);
}

function getSubDirs($dir)
{
	return \josecarlosphp\utils\Files::getSubDirs($dir);
}
/**
 * @return array
 * @param $dir string
 * @param $excludedextensions array
 * @param $includepath bool
 * @param $recursive bool
 * @desc Gets the names of the files existing in a given dir, with dir path if $includepath is true.
 */
function getFiles($dir, $excludedextensions=array(), $includepath=false, $recursive=false)
{
	return \josecarlosphp\utils\Files::getFiles($dir, $excludedextensions, $includepath, $recursive);
}
/**
 * @return array
 * @param $dir string
 * @param $includedextensions array
 * @param $includepath bool
 * @param $recursive bool
 * @desc Gets the names of the files existing in a given dir wich extension is in $includedextensions array, with dir path if $includepath is true.
 */
function getFilesExt($dir, $includedextensions, $includepath=false, $recursive=false)
{
	return \josecarlosphp\utils\Files::getFilesExt($dir, $includedextensions, $includepath, $recursive);
}

function getRandomFileExt($dir, $includedextensions, $includepath=false)
{
	return \josecarlosphp\utils\Files::getRandomFileExt($dir, $includedextensions, $includepath);
}
/**
 * Obtiene el árbol de carpetas y archivos de un directorio.
 *
 * @param string $dir
 * @return array
 */
function getTree($dir)
{
    return \josecarlosphp\utils\Files::getTree($dir);
}
/**
 * @return int
 * @param $dir string
 * @param $extensions array
 * @param $including bool
 * @desc Gets the number of dirs existing in a given dir, excluding (default) or including only the ones wich extension is in $extensions
 */
function countDirs($dir, $extensions=array(), $including=false)
{
	return \josecarlosphp\utils\Files::countDirs($dir, $extensions, $including);
}
/**
 * @return int
 * @param $dir string
 * @param $extensions array
 * @param $including bool
 * @desc Gets the number of files existing in a given dir, excluding (default) or including only the ones wich extension is in $extensions
 */
function countFiles($dir, $extensions=array(), $including=false)
{
	return \josecarlosphp\utils\Files::countFiles($dir, $extensions, $including);
}
/**
 * @return string
 * @param $file string
 * @param $tolower bool
 * @desc Gets the extension of a given file, in lowercase if $tolower
 */
function getExtension($file, $tolower=true)
{
	return \josecarlosphp\utils\Files::getExtension($file, $tolower);
}
/**
 * @return string
 * @param $file string
 * @desc Gets the name of a given file
 */
function getName($file, $tolower=false)
{
	return \josecarlosphp\utils\Files::getName($file, $tolower);
}
/**
 * @return bool
 * @param $file string
 * @desc Deletes a file.
 */
function deleteFile($file)
{
	return \josecarlosphp\utils\Files::deleteFile($file);
}
/**
 * @return bool
 * @param $dir string
 * @param $deleteevenifnotempty bool
 * @desc Deletes a dir.
 */
function deleteDir($dir, $deleteevenifnotempty=true)
{
	return \josecarlosphp\utils\Files::deleteDir($dir, $deleteevenifnotempty);
}
/**
 * @return bool
 * @param $dir string
 * @param $createifnotexists bool
 * @param $mode int
 * @desc Drain a dir.
 */
function drainDir($dir, $createifnotexists=true, $mode=0755)
{
	return \josecarlosphp\utils\Files::drainDir($dir, $createifnotexists, $mode);
}
/**
 * @return bool
 * @param $dir string
 * @param $mode int
 * @param $drainifexists
 * @desc Makes a dir.
 */
function makeDir($dir, $mode=0755, $drainifexists=false)
{
	return \josecarlosphp\utils\Files::makeDir($dir, $mode, $drainifexists);
}
/**
 * @return bool
 * @param string
 * @desc Checks if a given path is a dir and is empty.
 */
function is_emptyDir($dir)
{
	return \josecarlosphp\utils\Files::is_emptyDir($dir);
}

function dirsize($dir)
{
	return \josecarlosphp\utils\Files::dirsize($dir);
}
/**
 * Elimina los archivos de un directorio.
 *
 * @param string $dir
 * @param int &$c
 * @param mixed $exts
 * @param string $mascara
 * @param bool $recursivo
 * @param int $antiguedad
 * @param array $excluidos
 * @return bool
 */
function deleteFiles($dir, &$c, $exts=null, $mascara='', $recursivo=false, $antiguedad=0, $excluidos=array())
{
	return \josecarlosphp\utils\Files::deleteFiles($dir, $c, $exts, $mascara, $recursivo, $antiguedad, $excluidos);
}
/**
 * Copia el contenido de un directorio a otro
 *
 * @param string $src
 * @param string $dst
 * @param octal $mod
 * @return bool
 */
function copyDir($src, $dst, $moddir=0755)
{
	return \josecarlosphp\utils\Files::copyDir($src, $dst, $moddir);
}
/**
 * @desc Comprime un archivo
 * @param string $nom_arxiu
 * @return string
 * PHP5
function comprimir($filename)
{
	try
	{
		$fptr = fopen($filename, 'rb');
		$dump = fread($fptr, filesize($filename));
		fclose($fptr);

		//Comprime al máximo nivel, 9
		$gzbackupData = gzencode($dump,9);

		$fptr = fopen($filename.'.gz', 'wb');
		fwrite($fptr, $gzbackupData);
		fclose($fptr);

		//Devuelve el nombre del archivo comprimido
		return $filename.'.gz';
	}
	catch(Exception $ex)
	{
		return false;
	}
}*/

function isParentDir($dir, $son)
{
    return \josecarlosphp\utils\Files::isParentDir($dir, $son);
}