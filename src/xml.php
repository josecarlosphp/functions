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
 * @desc        Common use functions - xml.
 */

/**
 * Converts XML to array.
 *
 * @param string $url
 * @param int $get_attributes
 * @param string $priority
 * @param string $encoding
 * @return array
 */
function xml2array($url, $get_attributes=1, $priority='tag', $encoding='UTF-8')
{
	return \josecarlosphp\utils\Xml::xml2array($url, $get_attributes, $priority, $encoding);
}

function formatearxmlfile($xmlpath, $elementTag, $fieldsTags)
{
	return \josecarlosphp\utils\Xml::formatXmlFile($xmlpath, $elementTag, $fieldsTags);
}
/**
 * Convierte un archivo XML en un CSV.
 *
 * La función xmlfile2csvfileB() emplea xmlfile2csvfile() si no existe la clase SimpleXMLElement.
 * No podemos hacer que la función xmlfile2csvfile() emplee xmlfile2csvfileB() si existe SimpleXMLElement,
 * porque existe la posibilidad de un comportamiento no esperado.
 * No obstante, siempre procuraremos usar xmlfile2csvfileB() en vez de xmlfile2csvfile().
 *
 * @param string $xmlpath
 * @param string $csvpath
 * @param string $elementTag
 * @param array $fieldsTags
 * @param string $delimiter
 * @param string $enclosure
 * @param bool $trim
 */
function xmlfile2csvfile($xmlpath, $csvpath, $elementTag, $fieldsTags, $delimiter=',', $enclosure='"', $trim=true)
{
	return \josecarlosphp\utils\Xml::xmlfile2csvfile($xmlpath, $csvpath, $elementTag, $fieldsTags, $delimiter, $enclosure, $trim);
}
/**
 * Convierte un archivo XML en un CSV.
 *
 * Esta función emplea xmlfile2csvfile() si no existe la clase SimpleXMLElement.
 * Siempre procuraremos esta función en vez de xmlfile2csvfile().
 *
 * @param string $xmlpath
 * @param string $csvpath
 * @param mixed $elementTag
 * @param array $fieldsTags
 * @param string $delimiter
 * @param string $enclosure
 * @param bool $trim
 */
function xmlfile2csvfileB($xmlpath, $csvpath, $elementTag, $fieldsTags=array(), $delimiter=',', $enclosure='"', $tagComb='', $fieldsTagsComb=array(), $xmlTo='xml', $trim=true)
{
	self::xmlfile2csvfileB($xmlpath, $csvpath, $elementTag, $fieldsTags, $delimiter, $enclosure, $tagComb, $fieldsTagsComb, $xmlTo, $trim);
}

function xmlfile2cabecera($xmlpath, $elementTag)
{
	return \josecarlosphp\utils\Xml::xmlsfile2header($xmlpath, $elementTag);
}
