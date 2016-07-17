<?php
namespace Common\Util;
/**
 * @package common
 * @subpackage util
 * @author kain
 *
 */
define("NOTICE_INFO", 0);
define("NOTICE_LOGO", 1);
define("NOTICE_PHOTO", 2);
define("NOTICE_DIARY", 3);
define("NOTICE_CREATE_GROUP", 4);
define("NOTICE_JOIN_GROUP", 5);
define("NOTICE_ADD_FRIEND", 6);
define("NOTICE_INSAPP", 7);
define("NOTICE_MSG_FRIEND", 8);
define("NOTICE_COMMENT_FRIEND", 9);

define("DEFAULT_NOTICE_INFO", 1);
define("DEFAULT_NOTICE_LOGO", 1);
define("DEFAULT_NOTICE_PHOTO", 1);
define("DEFAULT_NOTICE_DIARY", 1);
define("DEFAULT_NOTICE_CREATE_GROUP", 1);
define("DEFAULT_NOTICE_JOIN_GROUP", 1);
define("DEFAULT_NOTICE_ADD_FRIEND", 1);
define("DEFAULT_NOTICE_INSAPP", 1);
define("DEFAULT_NOTICE_MSG_FRIEND", 1);
define("DEFAULT_NOTICE_COMMENT_FRIEND", 1);

class Common_Util_Notice
{
	function get($item, $notice)
	{
		if (defined("NOTICE_".strtoupper($item)))
		{
			$tmp = ($notice >> constant("NOTICE_".strtoupper($item))) & 1;
			if (constant("DEFAULT_NOTICE_".strtoupper($item)))
			{
				$tmp = $tmp ? "0" : "1";
			}
			return $tmp;
		}
		return 0;
	}

	function set($item, $value, &$notice)
	{
		if (defined("NOTICE_".strtoupper($item)))
		{
			$value = $value & 1;
			if (constant("DEFAULT_NOTICE_".strtoupper($item)))
			{
				$value = $value ? "0" : "1";
			}
			$tmp = 1 << constant("NOTICE_".strtoupper($item));
			$notice = $notice | $tmp;
			$notice = $notice - $tmp;
			$notice = $notice | ($value << constant("NOTICE_".strtoupper($item)));
			if ($notice > 2147483647 || $notice < -2147483648)
			{	//兼容64位操作系统
				$notice = ($notice << 32) >> 32;
			}
		}
	}
}

?>