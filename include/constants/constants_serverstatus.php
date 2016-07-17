<?php

namespace constants;

class constants_serverstatus {
	/**
	 * 服务关闭
	 *
	 * @var integer
	 */
	const STATE_CLOSE = 0;
	/**
	 * 服务器开放
	 *
	 * @var integer
	 */
	const STATE_OPEN = 1;
	/**
	 * 服务器维护
	 *
	 * @var integer
	 */
	const STATE_MAINTENANCE = 2;
}