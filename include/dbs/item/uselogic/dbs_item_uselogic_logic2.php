<?php

namespace dbs\item\uselogic;

use configdata\configdata_mall_item_package_setting;
use constants\constants_itemuselogic;
use constants\constants_moneychangereason;
use dbs\dbs_item;
use dbs\dbs_warehouse;

/**
 * 开启礼包
 *
 * @author zhipeng
 *
 *
 */
class dbs_item_uselogic_logic2 extends dbs_item_uselogic_base {
	/**
	 * 获取礼包配置
	 *
	 * @param unknown $packageid
	 * @return multitype:multitype:string
	 */
	private function getpackageconfig($packageid) {
		$packageid = strval ( $packageid );
		$datas = configdata_mall_item_package_setting::data ();
		$config = array ();
		foreach ( $datas as $data ) {
			if ($data [configdata_mall_item_package_setting::k_packageid] == $packageid) {
				$config [$data [configdata_mall_item_package_setting::k_id]] = $data;
			}
		}
		return $config;
	}
	public function get_logicid() {
		return constants_itemuselogic::TYPE_OPEN_PACKAGE;
	}
	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \dbs\item\uselogic\dbs_item_uselogic_base::useitem()
	 */
	function useitem($player,  array $useparams, array $Options) {

		// dump ( $useparams );
		if (count ( $useparams ) != 1) {
			return false;
		}

		$packageconfig = $this->getpackageconfig ( $useparams [0] );
		// dump ( $packageconfig );
		if (is_null ( $packageconfig )) {
			return false;
		}

		foreach ( $packageconfig as $value ) {
			$itemid = $value [configdata_mall_item_package_setting::k_itemid];
			$itemcount = intval ( $value [configdata_mall_item_package_setting::k_itemcount] );
			// dump ( $itemid );
			if (dbs_item::is_gamecoin ( $itemid )) {
				$player->db_role ()->add_gamecoin ( $itemcount, constants_moneychangereason::OPEN_PACKAGE );
			} elseif (dbs_item::is_diamond ( $itemid )) {
				$player->db_role ()->add_diamond ( $itemcount, constants_moneychangereason::OPEN_PACKAGE );
			} else {
				$warehouse = dbs_warehouse::getwarehousebyitemid ( $player, $itemid );
				if (! is_null ( $warehouse )) {

					$warehouse->addItemByItemId ( $itemid, $itemcount, true );
				}
			}
		}

		return true;

		// dump ( $packageconfig );
	}
}