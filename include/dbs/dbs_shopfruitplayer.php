<?php

namespace dbs;

use dbs\shopmaterial\dbs_shopmaterial_base;
use constants\constants_mall;

class dbs_shopfruitplayer extends dbs_shopmaterial_base {
	/**
	 * 果蔬
	 *
	 * @var unknown
	 */
	protected $mallType = constants_mall::TYPE_FRUIT;
	public function __construct() {
		parent::__construct ( 'shopfruitplayer', '1000' );
	}
}