<?php
namespace dbs;
use constants\constants_mission;
use configdata\configdata_mission_setting;
class dbs_missionachievement extends dbs_baseplayer {
	function __construct() {
		parent::__construct ( 'missionachievement', array (
				self::DBKey_userid => ''
		) );
	}
	private static $_autoopenachievements = NULL;
	/**
	 * 获取自动开启的成就任务
	 */
	public static function get_autoopenachievements() {
		if (is_null ( self::$_autoopenachievements )) {
			foreach ( configdata_mission_setting::data () as $key => $value ) {
				if ($value [configdata_mission_setting::k_type] == constants_mission::MISSION_TYPE_ACHIEVEMENT && $value [configdata_mission_setting::k_autoopen] == '1') {
					self::$_autoopenachievements [$key] = $value;
				}
			}
		}
		return self::$_autoopenachievements;
	}
}