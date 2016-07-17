<?php
namespace Common\Util;
/**
 * @package common
 * @subpackage util
 * @author kain
 *
 */
class Common_Util_CssParse
{
	protected function removeCsscomments( $text )
	{
		while (($start = strpos($text, '/*')) !== false)
		{
			$end = strpos($text, '*/', $start + 2);
			if ($end === false) {
				$text = substr($text, 0, $start);
				break;
			}
			$text = substr($text, 0, $start)." ".substr($text, $end + 2);
		}
		return $text;
	}

	protected function parseCss($style, &$offset)
	{
		$pos = strpos($style, "{", $offset);
		if ($pos === false)
		{
			$selector = substr($style, $offset);
			$offset = strlen($style);
			return array($selector, "");
		}
		$selector = substr($style, $offset, $pos - $offset);
		$offset = $pos + 1;

		$pos = strpos($style, "}", $offset);
		if ($pos === false)
		{
			$css = substr($style, $offset);
			$offset = strlen($style);
			return array($selector, $css);
		}
		$css = substr($style, $offset, $pos - $offset);
		$offset = $pos + 1;
		return array($selector, $css);
	}

	protected function parseProperty($css, &$offset)
	{
		$pos = strpos($css, ":", $offset);
		if ($pos === false)
		{
			$property = substr($css, $offset);
			$offset = strlen($css);
			return array($property, "");
		}
		$property = substr($css, $offset, $pos - $offset);
		$offset = $pos + 1;

		$pos = strpos($css, ";", $offset);
		if ($pos === false)
		{
			$value = trim(trim(substr($css, $offset)), "'\"");
			$offset = strlen($css);
			return array($property, $value);
		}
		$value = trim(trim(substr($css, $offset, $pos - $offset)), "'\"");
		$offset = $pos + 1;
		return array($property, $value);
	}

	function isColor($value)
	{
		$charlist = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
			'a', 'b', 'c', 'd', 'e', 'f',
			'A', 'B', 'C', 'D', 'E', 'F');
		$len = strlen($value);
		if ($len < 2 || $len > 7)
		{
			return false;
		}
		if ($value[0] != '#')
		{
			return false;
		}
		for ($i=1; $i<$len; $i++)
		{
			if (!in_array($value[$i], $charlist))
			{
				return false;
			}
		}
		return true;
	}

	function parseColor($value)
	{
		$value = trim(trim($value), "'\"");
		$values = explode(" ", $value);
		$ret = "";
		foreach ($values as $value)
		{
			$value = trim($value);
			if (empty($value))
			{
				continue;
			}
			if ($this->isColor($value))
			{
				$ret = $value;
			}
		}
		return $ret;
	}

	function isFontFamily($value)
	{
		$list = array("宋体", "黑体", "楷体-GB2312", "隶书", "幼圆", "arial", "tahoma", "times new roman", "courier new", "sans-serif", "verdana");

		return in_array($value, $list) || in_array(strtolower($value), $list);
	}

	function parseFontFamily($value)
	{
		if ($this->isFontFamily($value))
		{
			return $value;
		}
		return " ";
	}

	function isFontSize($value)
	{
		$a_unit = array("px", "em", "ex", "pt", "pc", "in", "cm", "mm");

		if (strlen($value) < 3)
		{
			return false;
		}
		$unit = strtolower(substr($value, -2));
		$num = substr($value, 0, -2);

		return in_array($unit, $a_unit) && is_numeric($num);
	}

	function parseFontSize($value)
	{
		if ($this->isFontSize($value))
		{
			return $value;
		}
		return " ";
	}

	function getRealUrl($url)
	{
		if (strlen($url))
		{
			if (strtolower(substr($url, 0, 7)) != "http://"
				&& strtolower(substr($url, 0, 6)) != "ftp://"
				&& strtolower(substr($url, 0, 8)) != "https://")
			{
				$url = "http://".$url;
			}
		}
		return $url;
	}

	function parseUrl($value)
	{
		$url = array();
		$offset = 0;
		$len = strlen($value);
		while ($offset < $len)
		{
			$pos = stripos($value, "url(", $offset);
			if ($pos === false)
			{
				$offset = strlen($value);
				$url[] = $this->getRealUrl("");
				continue;
			}

			$offset = $pos + 4;
			$pos = strpos($value, ")", $offset);
			if ($pos === false)
			{
				$url[] = $this->getRealUrl(trim(trim(substr($value, $offset)), "'\""));
				$offset = strlen($value);
				continue;
			}

			$url[] = $this->getRealUrl(trim(trim(substr($value, $offset, $pos - $offset)), "'\""));
			$offset = $pos + 1;
		}
		return $url;
	}

	function filterErrorChar( $style )
	{
		return str_replace(array("<", ">"), array(" ", " "), $style);
	}

	function getBgFixed($bgfixed)
	{
		return $bgfixed ? "fixed" : "";
	}

	function getBgFillMode($bgfillmode)
	{
		if ($bgfillmode == 0)
		{
			return "no-repeat center";
		}
		else if ($bgfillmode == 2)
		{
			return "repeat-y left top";
		}
		else if ($bgfillmode == 3)
		{
			return "repeat-x center top";
		}
		return "";
	}

	function parseStyle($style)
	{
		$style = $this->removeCsscomments($style);
		$style = $this->filterErrorChar($style);

		$data = array();

		$offset = 0;
		$len = strlen($style);
		while ($offset < $len)
		{
			list($selector, $css) = $this->parseCss($style, $offset);
			$selectors = explode(",", $selector);

			$cssdata = array();

			$cssoffset = 0;
			$csslen = strlen($css);
			while($cssoffset < $csslen)
			{
				list($property, $value) = $this->parseProperty($css, $cssoffset);
				$property = trim($property);
				if (0 == strlen($property))
				{
					continue;
				}
				$cssdata[$property] = $value;
			}

			foreach($selectors as $selector)
			{
				$selector = trim($selector);
				if (0 == strlen($selector))
				{
					continue;
				}

				if (!empty($data[$selector]["css"]))
				{
					$data[$selector]["css"] = trim($data[$selector]["css"], ";").";".$css;
				}
				else
				{
					$data[$selector]["css"] = $css;
				}
				if (!is_array($data[$selector]["property"]))
				{
					$data[$selector]["property"] = array();
				}
				$data[$selector]["property"] = array_merge($data[$selector]["property"], $cssdata);
			}
		}

		return $data;
	}
}

/*

$style = "body {text-align:center;}
.frame {margin:0px auto;}
body {a:b}
body {text-align: center;}";

$parser = new Common_Util_CssParse();
$data = $parser->parseStyle($style);

var_dump($data);

$url = $parser->parseUrl("abd url('http://iask.com') #fff url('http://sina.com')a123");
var_dump($url);

$color = $parser->parseColor("abd url('http://iask.com') #fff url('http://sina.com')a123");
var_dump($color);

*/

?>