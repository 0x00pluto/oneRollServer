<?php
namespace Common\Util;
/**
 * @package common
 * @subpackage util
 * @author kain
 *
 */
define("PRIVACY1_EMAIL", 0);
define("PRIVACY1_ADDRESS", 2);
define("PRIVACY1_TEL", 4);
define("PRIVACY1_MOBILE", 6);
define("PRIVACY1_QQ", 8);
define("PRIVACY1_MSN", 10);
define("PRIVACY1_INDEX", 12);//任何人0  仅好友1 隐藏2
define("PRIVACY1_MSG", 14);
define("PRIVACY1_FRIEND", 16);  // 明星用户
define("PRIVACY1_BIRTHDAY", 18);
define("PRIVACY1_HOMETOWN", 20);
define("PRIVACY1_CITY", 22);
define("PRIVACY1_BODYFORM", 24);
define("PRIVACY1_TRAINWITH", 26);
define("PRIVACY1_MOTTO", 28);
define("PRIVACY1_INTRO", 30);

define("PRIVACY2_WISHLIST", 0);
define("PRIVACY2_IDOL", 2);
define("PRIVACY2_INTEREST", 4);
define("PRIVACY2_FAVBOOK", 6);
define("PRIVACY2_FAVMOVIE", 8);
define("PRIVACY2_FAVTV", 10);
define("PRIVACY2_EXINFO", 12);
define("PRIVACY2_EDUCATION", 14);
define("PRIVACY2_CAREER", 16);
define("PRIVACY2_GENDER", 18);
define("PRIVACY2_REAL_NAME", 20);
define("PRIVACY2_ZIP", 22);
define("PRIVACY2_ASTRO", 24);
define("PRIVACY2_BLOOD", 26);
define("PRIVACY2_MARRIAGE", 28);
define("PRIVACY2_FRIENDRANGE", 30);

define("PRIVACY3_FORBIDSEARCH", 0); //1禁止被搜索
define("PRIVACY3_FOOTPRINT", 2);
define("PRIVACY3_FORBIDBLOG", 4);
define("PRIVACY3_FORBIDGAME", 6);
define("PRIVACY3_FAKEUSER", 8);//1临时封杀  3永久封杀 0正常
define("PRIVACY3_ADDFNOTIP", 10);
define("PRIVACY3_UNLIMIT", 12);
define("PRIVACY3_OPENREG", 14);
define("PRIVACY3_SAFENOTICE", 16);
define("PRIVACY3_STATEHISTORY", 18);
define("PRIVACY3_NEWCITY", 20);  // 同城交友, 使用过图层方式注册或修改居住城市
define("PRIVACY3_ELECTION", 22); // 有竞选功能的群中使用
define("PRIVACY3_FRIENDORDER", 24); //标志是否好友有排序
define("PRIVACY3_HIDEBIRTHYEAR", 26); // 出生年份对外保密
define("PRIVACY3_FLASHLOGO", 28); //是否打开动感头像
define("PRIVACY3_NEWMSG_REMIND", 30); //新消息提醒

define("PRIVACY4_ACCOUNTTYPE", 0); // 帐户类型 0/email帐户/1/用户名帐户,QQ号,手机号
define("PRIVACY4_BECARED",2); //被家长关心了...
define("PRIVACY4_KXT", 4); // 是否开通开心微博 0/未开通/1/已经开通
define("PRIVACY4_REGTYPE", 6); // 注册类型 0/开心网注册/1/组件简易注册
define("PRIVACY4_DROP", 8); // 帐户删除
define("PRIVACY4_INIT_APPGROUP", 10);	//左侧新版组件列表数据初始化 2011.1
define("PRIVACY4_KXG", 12); // 是否开通海贝 0/未开通/1/已经开通

class Common_Util_Privacy
{
	function get($item, $privacy1, $privacy2)
	{
		if (defined("PRIVACY1_".strtoupper($item)))
		{
			return ($privacy1 >> constant("PRIVACY1_".strtoupper($item))) & 3;
		}
		else if (defined("PRIVACY2_".strtoupper($item)))
		{
			return ($privacy2 >> constant("PRIVACY2_".strtoupper($item))) & 3;
		}
		return 0;
	}

	function get2($item, $privacy3, $privacy4)
	{
		if (defined("PRIVACY3_".strtoupper($item)))
		{
			return ($privacy3 >> constant("PRIVACY3_".strtoupper($item))) & 3;
		}
		else if (defined("PRIVACY4_".strtoupper($item)))
		{
			return ($privacy4 >> constant("PRIVACY4_".strtoupper($item))) & 3;
		}
		return 0;
	}

	function set($item, $value, &$privacy1, &$privacy2)
	{
		if (defined("PRIVACY1_".strtoupper($item)))
		{
			$tmp = 3 << constant("PRIVACY1_".strtoupper($item));
			$privacy1 = $privacy1 | $tmp;
			$privacy1 = $privacy1 - $tmp;
			$privacy1 = $privacy1 | (($value & 3) << constant("PRIVACY1_".strtoupper($item)));
			if ($privacy1 > 2147483647 || $privacy1 < -2147483648)
			{	//兼容64位操作系统
				$privacy1 = ($privacy1 << 32) >> 32;
			}
		}
		else if (defined("PRIVACY2_".strtoupper($item)))
		{
			$tmp = 3 << constant("PRIVACY2_".strtoupper($item));
			$privacy2 = $privacy2 | $tmp;
			$privacy2 = $privacy2 - $tmp;
			$privacy2 = $privacy2 | (($value & 3) << constant("PRIVACY2_".strtoupper($item)));
			if ($privacy2 > 2147483647 || $privacy2 < -2147483648)
			{	//兼容64位操作系统
				$privacy2 = ($privacy2 << 32) >> 32;
			}
		}
	}

	function set2($item, $value, &$privacy3, &$privacy4)
	{
		if ($item == 'fakeuser') {
			global $multilog;
			$ret = var_export(debug_backtrace(), true);
			$multilog->addSysDebugLog("log_set_fakeuser_".$value ."_". $_SERVER['REQUEST_URI']."|".getenv("SCRIPT_NAME")."|".getenv("HTTP_REFERER")."|".$ret);
		}

		if (defined("PRIVACY3_".strtoupper($item)))
		{
			$tmp = 3 << constant("PRIVACY3_".strtoupper($item));
			$privacy3 = $privacy3 | $tmp;
			$privacy3 = $privacy3 - $tmp;
			$privacy3 = $privacy3 | (($value & 3) << constant("PRIVACY3_".strtoupper($item)));
			if ($privacy3 > 2147483647 || $privacy3 < -2147483648)
			{	//兼容64位操作系统
				$privacy3 = ($privacy3 << 32) >> 32;
			}
		}
		else if (defined("PRIVACY4_".strtoupper($item)))
		{
			$tmp = 3 << constant("PRIVACY4_".strtoupper($item));
			$privacy4 = $privacy4 | $tmp;
			$privacy4 = $privacy4 - $tmp;
			$privacy4 = $privacy4 | (($value & 3) << constant("PRIVACY4_".strtoupper($item)));
			if ($privacy4 > 2147483647 || $privacy4 < -2147483648)
			{	//兼容64位操作系统
				$privacy4 = ($privacy4 << 32) >> 32;
			}
		}
	}

	function checkPrivacy($str)
	{
		if (defined("PRIVACY1_".strtoupper($str)))
		{
			return "1";
		}
		else if (defined("PRIVACY2_".strtoupper($str)))
		{
			return "2";
		}
		else if (defined("PRIVACY3_".strtoupper($str)))
		{
			return "3";
		}
		else if (defined("PRIVACY4_".strtoupper($str)))
		{
			return "4";
		}
		else
		{
			return "0";
		}
	}
}

?>