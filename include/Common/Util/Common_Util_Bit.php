<?php
namespace Common\Util;
/**
 * 位操作
 * @author zhipeng
 *
 */
class Common_Util_Bit {
	/**
	 * 设置位
	 *
	 * @param int $p
	 * @return number
	 */
	static function bit($p) {
		return $p >= 0 ? (1 << $p) : 0;
	}
	/**
	 * 设置位
	 *
	 * @param number $x
	 *        	原始数据
	 * @param int $p
	 *        	第几位
	 * @return number
	 */
	static function set($x, $p) {
		return $x | self::bit ( $p );
	}
	/**
	 * 是否包含为
	 *
	 * @param number $x
	 *        	原始数据
	 * @param int $p
	 *        	第几位
	 * @return boolean
	 */
	static function has($x, $p) {
		return ($x & self::bit ( $p )) != 0;
	}
	/**
	 * 清除位
	 *
	 * @param number $x
	 *        	原始数据
	 * @param int $p
	 *        	第几位
	 *
	 * @return number
	 */
	static function clear($x, $p) {
		return $x & (~ self::bit ( $p ));
	}
}