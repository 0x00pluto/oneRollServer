<?php

namespace Common\Util;

/**
 * 消息池
 *
 * @author zhipeng
 *
 */
class Common_Util_MessagePool {
	private $_pool = [ ];

	/**
	 * 压入消息队列
	 *
	 * @param Common_Util_Message $message
	 */
	public function pushMessage(Common_Util_Message $message) {
		$this->_pool [] = $message;
	}

	/**
	 * 弹出消息队列
	 *
	 * @return null|Common_Util_Message
	 */
	public function popMessage() {
		return array_shift ( $this->_pool );
	}
	/**
	 *
	 * @var Common_Util_MessagePool
	 */
	private static $_returnmessagepool;

	/**
	 * 默认返回消息池
	 *
	 * @return \Common\Util\Common_Util_MessagePool
	 */
	public static function returnmessagepool() {
		if (! self::$_returnmessagepool instanceof self) {
			self::$_returnmessagepool = new self ();
		}
		return self::$_returnmessagepool;
	}
}