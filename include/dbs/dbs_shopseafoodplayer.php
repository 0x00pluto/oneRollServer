<?php

namespace dbs;

use dbs\shopmaterial\dbs_shopmaterial_base;
use constants\constants_mall;

class dbs_shopseafoodplayer extends dbs_shopmaterial_base {
	/**
	 * 海鲜
	 *
	 * @var unknown
	 */
	protected $mallType = constants_mall::TYPE_SEAFOOD;
	public function __construct() {
		parent::__construct ( 'shopseafoodplayer', '3000' );
	}
}