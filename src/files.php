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
	return file_exists($file) ? include($file) : eval('return '.$evalonerror.';');
}
/**
 * @return mixed
 * @param $file string
 * @param $evalonerror string
 * @desc If given file exists, includes_once it, if not, evals given code string ("false" by default).
 */
function include_once_ifexists($file, $evalonerror='false;')
{
	return file_exists($file) ? include_once($file) : eval('return '.$evalonerror.';');
}
/**
 * @return mixed
 * @param $file string
 * @param $evalonerror string
 * @desc If given file exists, requires it, if not, evals given code string ("false" by default).
 */
function require_ifexists($file, $evalonerror='false;')
{
	return file_exists($file) ? require($file) : eval('return '.$evalonerror.';');
}
/**
 * @return mixed
 * @param $file string
 * @param $evalonerror string
 * @desc If given file exists, requires_once it, if not, evals given code string ("false" by default).
 */
function require_once_ifexists($file, $evalonerror='false;')
{
	return file_exists($file) ? require_once($file) : eval('return '.$evalonerror.';');
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
	$pos = strrpos($dir,'/');
	if($pos == (strlen($dir) - 1))
    {
		$dir = substr($dir, 0, $pos);
    }
	$dirs = array();
	$currentdir = getcwd();
	if(chdir($dir))
	{
		$handle = opendir('.');
        while(($file = readdir($handle)) !== false)
		{
			if(is_dir($file) && $file!='.' && $file!='..' && ($mascara == '' || mb_strpos($file, $mascara) !== false))
			{
				$dirs[] = $includepath ? $dir.'/'.$file : $file;

				if($recursive)
				{
					if($includepath)
					{
						chdir($currentdir);
						$dirs = array_merge($dirs, getDirs($dir.'/'.$file,true,true));
						chdir($dir);
					}
					else
					{
						$dirs = array_merge($dirs, getDirs($file,false,true));
					}
				}
			}
		}
		chdir($currentdir);
	}
	return $dirs;
}

function getSubDirs($dir)
{
	$len = mb_strlen($dir);
	$dirs = getDirs($dir, true, true);
	sort($dirs);
	for($c=0,$size=sizeof($dirs); $c<$size; $c++)
	{
		$dirs[$c] = mb_substr($dirs[$c], $len);
	}

	return $dirs;
}
/**
 * @return array
 * @param $dir string
 * @param $excludedextensions array
 * @param $includepath bool
 * @param $recursive bool
 * @desc Gets the names of the files existing in a given dir, with dir path if $includepath is true.
 */
function getFiles($dir,$excludedextensions=array(),$includepath=false,$recursive=false)
{
	$pos = strrpos($dir,'/');
	if($pos == (strlen($dir) - 1))
	{
		$dir = substr($dir, 0, $pos);
	}
	$files = array();
	$currentdir = getcwd();
	if(chdir($dir))
	{
		$handle = opendir('.');
		while(($file = readdir($handle)) !== false)
		{
			if(is_dir($file) && $file!='.' && $file!='..' && $recursive)
			{
				if($includepath)
				{
					chdir($currentdir);
					$files = array_merge($files, getFiles($dir.'/'.$file,$excludedextensions,true,true));
					chdir($dir);
				}
				else
					$files = array_merge($files, getFiles($file,$excludedextensions,false,true));
			}
			elseif(is_file($file) && !in_array(getExtension($file),$excludedextensions))
			{
				if($includepath)
					$files[] = $dir.'/'.$file;
				else
					$files[] = $file;
			}
		}
		chdir($currentdir);
	}
	return $files;
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
	$pos = strrpos($dir,'/');
	if($pos == (strlen($dir) - 1))
	{
		$dir = substr($dir, 0, $pos);
	}
	$files = array();
	$currentdir = getcwd();
	if(chdir($dir))
	{
		$handle = opendir('.');
		while(($file = readdir($handle)) !== false)
		{
			if(is_dir($file) && $file!='.' && $file!='..' && $recursive)
			{
				if($includepath)
				{
					chdir($currentdir);
					$files = array_merge($files, getFilesExt($dir.'/'.$file,$includedextensions,true,true));
					chdir($dir);
				}
				else
				{
					$files = array_merge($files, getFilesExt($file,$includedextensions,false,true));
				}
			}
			elseif(is_file($file) && in_array(getExtension($file),$includedextensions))
			{
				$files[] = $includepath ? $dir.'/'.$file : $file;
			}
		}
		chdir($currentdir);
	}

	return $files;
}

function getRandomFileExt($dir, $includedextensions, $includepath=false)
{
	$files = getFilesExt($dir, $includedextensions, $includepath, false);
	return $files[mt_rand(0, sizeof($files)-1)];
}
/**
 * Obtiene el árbol de carpetas y archivos de un directorio.
 *
 * @param string $dir
 * @return array
 */
function getTree($dir)
{
    $result = array();

    $aux = getDirs($dir);
    foreach($aux as $item)
    {
        $result[$item] = getTree(ponerBarra($dir).$item);
    }

    $aux = getFiles($dir);
    foreach($aux as $item)
    {
        $result[$item] = $item;
    }

    return $result;
}
/**
 * @return int
 * @param $dir string
 * @param $extensions array
 * @param $including bool
 * @desc Gets the number of dirs existing in a given dir, excluding (default) or including only the ones wich extension is in $extensions
 */
function countDirs($dir,$extensions=array(),$including=false)
{
	$currentdir = getcwd();
	chdir($dir);
	$handle = opendir('.');
	$count = 0;
	while(($file = readdir($handle)) !== false)
	{
		if($including)
		{
			if(is_dir($file) && $file!='.' && $file!='..' && in_array(getExtension($file),$extensions))
				$count++;
		}
		else
		{
			if(is_dir($file) && $file!='.' && $file!='..' && !in_array(getExtension($file),$extensions))
				$count++;
		}
	}
	chdir($currentdir);
	return $count;
}
/**
 * @return int
 * @param $dir string
 * @param $extensions array
 * @param $including bool
 * @desc Gets the number of files existing in a given dir, excluding (default) or including only the ones wich extension is in $extensions
 */
function countFiles($dir,$extensions=array(),$including=false)
{
	$currentdir = getcwd();
	chdir($dir);
	$handle = opendir('.');
	$count = 0;
	while(($file = readdir($handle)) !== false)
	{
		if($including)
		{
			if(is_file($file) && in_array(getExtension($file),$extensions))
				$count++;
		}
		else
		{
			if(is_file($file) && !in_array(getExtension($file),$extensions))
				$count++;
		}
	}
	chdir($currentdir);
	return $count;
}
/**
 * @return string
 * @param $file string
 * @param $tolower bool
 * @desc Gets the extension of a given file, in lowercase if $tolower
 */
function getExtension($file, $tolower=true)
{
	$file = basename($file);
	$pos = strrpos($file, '.');

	if($file == '' || $pos === false)
	{
		return '';
	}

	$extension = substr($file, $pos+1);
	if($tolower)
	{
		$extension = strtolower($extension);
	}

	return $extension;
}
/**
 * @return string
 * @param $file string
 * @desc Gets the name of a given file
 */
function getName($file, $tolower=false)
{
	$name = ($dotpos = strrpos($file, '.')) ? substr($file, 0, $dotpos) : $file;
	return $tolower ? mb_strtolower($name) : $name;
}
/**
 * @return bool
 * @param $file string
 * @desc Deletes a file.
 */
function deleteFile($file)
{
	if(is_file($file))
	{
		return unlink($file);
	}

	return true;
}
/**
 * @return bool
 * @param $dir string
 * @param $deleteevenifnotempty bool
 * @desc Deletes a dir.
 */
function deleteDir($dir, $deleteevenifnotempty=true)
{
	if(is_dir($dir))
	{
		if(is_emptyDir($dir))
		{
			return rmdir($dir);
		}
		
		return $deleteevenifnotempty ? drainDir($dir) && rmdir($dir) : false;
	}

	return true;
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
	if(is_dir($dir))
	{
		$currentdir = getcwd();
		chdir($dir);
		$handle = opendir('.');
        while(($file = readdir($handle)) !== false)
		{
			if(is_dir($file) && $file!='.' && $file!='..')
				deleteDir($file);
			elseif(is_file($file))
				unlink($file);
		}
		closedir($handle);
		chdir($currentdir);
	}
	elseif($createifnotexists)
	{
		mkdir($dir, $mode);
	}
	return is_emptyDir($dir);
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
	if(is_dir($dir))
	{
		if($drainifexists)
		{
			drainDir($dir);
		}
	}
	else
	{
		$padre = dirname($dir);
		if($padre && makeDir($padre))
		{
			mkdir($dir, $mode);
		}
	}

	return is_dir($dir);
}
/**
 * @return bool
 * @param string
 * @desc Checks if a given path is a dir and is empty.
 */
function is_emptyDir($dir)
{
	if(is_dir($dir))
	{
		$isempty = true;
		$currentdir = getcwd();
		chdir($dir);
		$handle = opendir('.');
		while(($file = readdir($handle)) !== false)
		{
			if((is_dir($file) && $file!='.' && $file!='..') || is_file($file))
			{
				$isempty = false;
				break;
			}
		}
		closedir($handle);
		chdir($currentdir);
		return $isempty;
	}
	return false;
}

function dirsize($dir)
{
	$size = 0;
	$pos = strrpos($dir,'/');
	if($pos == (strlen($dir) - 1))
	{
		$dir = substr($dir, 0, $pos);
	}
	$currentdir = getcwd();
	if(chdir($dir))
	{
		$handle = opendir('.');
		while(($file = readdir($handle)) !== false)
		{
			if(is_dir($file) && $file!='.' && $file!='..')
			{
				$size += dirsize($file);
			}
			elseif(is_file($file))
			{
				$size += filesize($file);
			}
		}
		chdir($currentdir);
	}
	return $size;
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
	$c = 0;
	$ok = true;
	if(is_dir($dir))
	{
		$currentdir = getcwd();
		chdir($dir);
		$handle = opendir('.');
		while(($file = readdir($handle)) !== false)
		{
			if(is_file($file))
			{
                if(($antiguedad == 0 || time() - filemtime($file) > $antiguedad) && !in_array($file, $excluidos))
                {
                    $extension = getExtension($file);
                    if((is_null($exts) || (is_array($exts) && in_array($extension, $exts)) || (is_string($exts) && $extension == $exts))
                        &&
                        ($mascara == '' || mb_strpos(getName($file), $mascara) !== false))
                    {
                        if(unlink($file))
                        {
                            $c++;
                        }
                        else
                        {
                            $ok = false;
                        }
                    }
                }
			}
			elseif($recursivo && is_dir($file) && $file != '.' && $file != '..')
			{
				$z = 0;
				$ok &= deleteFiles($dir, $z, $exts, $mascara, true);
				$c += $z;
			}
		}
		closedir($handle);
		chdir($currentdir);
	}
	
	return $ok;
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
	$ok = true;
	$dir = opendir($src);
	makeDir($dst, $moddir);
	while(($file = readdir($dir)) !== false)
	{
		if($file != '.' && $file != '..')
		{
			if(is_dir($src.'/'.$file))
			{
				$ok &= copyDir($src.'/'.$file, $dst.'/'.$file, $moddir);
			}
			else
			{
				$ok &= copy($src.'/'.$file, $dst.'/'.$file);
			}
		}
	}
	closedir($dir);

	return $ok;
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
