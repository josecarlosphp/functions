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
 * @desc        Common use functions - images.
 */

/**
 * @return bool
 * @param $imagefile string
 * @param $thumbwidth mixed
 * @param $destinydir string
 * @param $newname string
 * @desc Creates a thumbnail file from an image file. $thumbwidth can be an integer (pixels #) or a percentage as "75%" for example.
 */
function createThumbnail($imagefile, $thumbwidth, $destinydir, $newname=null)
{
	return \josecarlosphp\utils\Images::createThumbnail($imagefile, $thumbwidth, $destinydir, $newname);
}
/**
 * Redimensiona una imagen haciendo que su lado más largo mida $size.
 * Si $size es un array, el nuevo tamaño será $size[0] (ancho) x $size[1] (alto)
 * si ambos elementos tienen valor, si solo uno de ellos está definido, el otro
 * se ajustará proporcionalmente
 *
 * $sindistorsion
 * 0 = Sin ajuste (por defecto)
 * 1 = Ajuste para encajar dentro del nuevo tamaño sin perder imagen (pero pueden aparecer espacios vacíos, se rellenarán con el color de fondo)
 * 2 = Ajuste al alto (se puede perder imagen por los lados)
 * 3 = Ajuste al ancho (se puede perder imagen arriba y abajo)
 *
 * @param string $imagefile
 * @param mixed $size
 * @param string $destinydir
 * @param string $newname
 * @param int $skiptype 0 = no skip (resize always), 1 = resize only if get bigger, 2 = resize only if get smaller
 * @param int $sindistorsion
 * @param array $colordefondo
 * @param bool $extForzada
 * @return bool
 */
function resizeImage($imagefile, $size, $destinydir, $newname=null, $skiptype=0, $sindistorsion=0, $colordefondo=array(255,255,255), $extForzada=false)
{
	return \josecarlosphp\utils\Images::resizeImage($imagefile, $size, $destinydir, $newname, $skiptype, $sindistorsion, $colordefondo, $extForzada);
}

function marcaDeAgua($img_original, $img_marcadeagua, $calidad=100, $img_nueva=null, $posicion=null)
{
	return \josecarlosphp\utils\Images::marcaDeAgua($img_original, $img_marcadeagua, $calidad, $img_nueva, $posicion);
}

function watermark($imagepath, $watermarkpath, $outputpath, $xAlign='middle', $yAlign='middle', $transparency=60, $proporcionW=0)
{
	return \josecarlosphp\utils\Images::watermark($imagepath, $watermarkpath, $outputpath, $xAlign, $yAlign, $transparency, $proporcionW);
}

function getExtensionImg($file)
{
    return \josecarlosphp\utils\Images::getExtensionImg($file);
}

if(!function_exists('ImageCreateFromBmp'))
{
/**
 * Convert BMP to GD
 *
 * @param string $src
 * @param string|bool $dest
 * @return bool
 */
function bmp2gd($src, $dest = false)
{
    if(!($src_f = fopen($src, 'rb')))
    {
        return false;
    }

	if(!($dest_f = fopen($dest, 'wb')))
    {
        return false;
    }

	$header = unpack('vtype/Vsize/v2reserved/Voffset', fread( $src_f, 14));

	$info = unpack('Vsize/Vwidth/Vheight/vplanes/vbits/Vcompression/Vimagesize/Vxres/Vyres/Vncolor/Vimportant',
	fread($src_f, 40));

	extract($info);
	extract($header);

	if($type != 0x4D42)
	{
	    return false;
	}

	$palette_size = $offset - 54;
	$ncolor = $palette_size / 4;
	$gd_header = '';

	$gd_header .= ($palette_size == 0) ? "\xFF\xFE" : "\xFF\xFF";
	$gd_header .= pack("n2", $width, $height);
	$gd_header .= ($palette_size == 0) ? "\x01" : "\x00";
	if($palette_size)
	{
		$gd_header .= pack("n", $ncolor);
	}

	$gd_header .= "\xFF\xFF\xFF\xFF";

	fwrite($dest_f, $gd_header);

	if($palette_size)
	{
    	$palette = fread($src_f, $palette_size);

	    $gd_palette = '';
	    $j = 0;

    	while($j < $palette_size)
    	{
	        $b = $palette[$j++];
	        $g = $palette[$j++];
	        $r = $palette[$j++];
	        $a = $palette[$j++];

	        $gd_palette .= "$r$g$b$a";
    	}

    	$gd_palette .= str_repeat("\x00\x00\x00\x00", 256 - $ncolor);

 		fwrite($dest_f, $gd_palette);
	}

	$scan_line_size = (($bits * $width) + 7) >> 3;
	$scan_line_align = ($scan_line_size & 0x03) ? 4 - ($scan_line_size & 0x03) : 0;

	for($i = 0, $l = $height - 1; $i < $height; $i++, $l--)
	{
	    fseek($src_f, $offset + (($scan_line_size + $scan_line_align) * $l));
	    $scan_line = fread($src_f, $scan_line_size);
	    if($bits == 24)
	    {
	        $gd_scan_line = '';
	        $j = 0;
	        while($j < $scan_line_size)
	        {
	            $b = $scan_line[$j++];
	            $g = $scan_line[$j++];
	            $r = $scan_line[$j++];
	            $gd_scan_line .= "\x00$r$g$b";
	        }
    	}
	    elseif($bits == 8)
	    {
	        $gd_scan_line = $scan_line;
	    }
	    elseif($bits == 4)
	    {
	        $gd_scan_line = '';
	        $j = 0;
	        while($j < $scan_line_size)
	        {
	            $byte = ord($scan_line[$j++]);
	            $p1 = chr($byte >> 4);
	            $p2 = chr($byte & 0x0F);
	            $gd_scan_line .= "$p1$p2";
	        }
	        $gd_scan_line = substr($gd_scan_line, 0, $width);
	    }
	    elseif($bits == 1)
	    {
	        $gd_scan_line = '';
	        $j = 0;
	        while($j < $scan_line_size)
	        {
	            $byte = ord($scan_line[$j++]);
	            $p1 = chr((int) (($byte & 0x80) != 0));
	            $p2 = chr((int) (($byte & 0x40) != 0));
	            $p3 = chr((int) (($byte & 0x20) != 0));
	            $p4 = chr((int) (($byte & 0x10) != 0));
	            $p5 = chr((int) (($byte & 0x08) != 0));
	            $p6 = chr((int) (($byte & 0x04) != 0));
	            $p7 = chr((int) (($byte & 0x02) != 0));
	            $p8 = chr((int) (($byte & 0x01) != 0));
	            $gd_scan_line .= "$p1$p2$p3$p4$p5$p6$p7$p8";
	        }

	    	$gd_scan_line = substr($gd_scan_line, 0, $width);
	    }

    	fwrite($dest_f, $gd_scan_line);
	}

	fclose($src_f);
	fclose($dest_f);

	return true;
}
/**
 * Create image from BMP image file
 *
 * @param string $filename
 * @return bin string on success
 * @return bool false on failure
 */
function ImageCreateFromBmp($filename)
{
	$tmp_name = tempnam(dirname($filename), 'GD');

	if(bmp2gd($filename, $tmp_name))
	{
		$img = imagecreatefromgd($tmp_name);
		unlink($tmp_name);

		return $img;
	}

	return false;
}
}