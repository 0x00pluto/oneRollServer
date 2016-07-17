<?php
namespace Common\Util;
/**
 * @package common
 * @subpackage util
 * @author kain
 *
 */
/**
 * 数据项校验
 *
 */
class Common_Util_DataValidator
{
	static public function isInteger($int)
	{
		return self::_checkInt($int); //(strval(intval($int)) == $int);
	}

	static public function isPositiveInteger($int)
	{
		return self::_checkInt($int, array('options'=>array('min_range'=>1))); //$this->isInteger($int) && $int > 0;
	}

	static public function isNaturalNumber($int)
	{
		return self::_checkInt($int, array('options'=>array('min_range'=>0))); //
	}

	static public function isValidUID($uid)
	{
		return self::isPositiveInteger($uid);
	}

	static public function isValidEmail($param)
	{
		return filter_var($param, FILTER_VALIDATE_EMAIL) !== false;
	}

	static private function _checkInt($param, array $options = array())
	{
		return filter_var($param, FILTER_VALIDATE_INT, $options) !== false;
	}

}

?>