<?php

namespace Common\Util;

use Symfony\Component\EventDispatcher\EventDispatcher;

class Common_Util_EventDispatcher {
	/**
	 *
	 * @var EventDispatcher
	 */
	private static $_dispatcher;
	/**
	 * 默认消息分发器
	 *
	 * @return \Symfony\Component\EventDispatcher\EventDispatcher
	 */
	static function default_dispatcher() {
		if (! self::$_dispatcher instanceof EventDispatcher) {
			self::$_dispatcher = new EventDispatcher ();
		}
		return self::$_dispatcher;
	}
}