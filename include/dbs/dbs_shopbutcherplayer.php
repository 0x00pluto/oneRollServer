<?php

namespace dbs;

use dbs\shopmaterial\dbs_shopmaterial_base;
use constants\constants_mall;

/**
 * 肉店用户信息
 *
 * @author zhipeng
 *
 */
class dbs_shopbutcherplayer extends dbs_shopmaterial_base {

	/**
	 * 肉店
	 *
	 * @var unknown
	 */
	protected $mallType = constants_mall::TYPE_BUTCHER;
	function __construct() {
		parent::__construct ( "shopbutcherplayer", '2000' );
	}
}