<?php
use Common\Util\Common_Util_EventDispatcher;
$dispatcher = Common_Util_EventDispatcher::default_dispatcher ();
$dispatcher->addListener ( "123", [
		'dbs\dbs_shopplayer',
		'listener'
] );
