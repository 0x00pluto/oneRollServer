<?php

namespace dbs\pve\data;

use dbs\mailbox\dbs_mailbox_data;
use Common\Util\Common_Util_Configdata;
use constants\constants_mailactiontype;
use dbs\dbs_player;
use constants\constants_languagevar;
use constants\constants_mail;

class dbs_pve_data_superslotmachineinvitedata extends dbs_mailbox_data {

	/**
	 *
	 * @param unknown $fromuserid
	 * @param unknown $slotmachineguid
	 * @return \dbs\mailbox\dbs_mailbox_data
	 */
	static function create_invite_private_data($fromuserid, $slotmachineguid) {
		$ownplayer = dbs_player::newGuestPlayer( $fromuserid );

		$lang = Common_Util_Configdata::getInstance ()->get_lang ( 'MESSAGE_SUPER_SLOTMACHINE_INVITE', [
				constants_languagevar::ROLENAME => $ownplayer->db_role ()->get_rolename ()
		] );

		$ins = static::create ( '', $lang, $fromuserid );
		$ins->addAttachAction ( constants_mailactiontype::INVITE_SUPER_SLOTMACHINE, $slotmachineguid );
		$ins->set_mailtype ( constants_mail::TYPE_PRIVATE_CHAT );
		return $ins;
	}

	/**
	 *
	 * @param unknown $fromuserid
	 * @param unknown $slotmachineguid
	 * @return \dbs\mailbox\dbs_mailbox_data
	 */
	static function create_invite_group_data($fromuserid, $slotmachineguid) {
		$ownplayer = dbs_player::newGuestPlayer( $fromuserid );

		$lang = Common_Util_Configdata::getInstance ()->get_lang ( 'MESSAGE_SUPER_SLOTMACHINE_INVITE', [
				constants_languagevar::ROLENAME => $ownplayer->db_role ()->get_rolename ()
		] );

		$ins = static::create ( '', $lang, $fromuserid );
		$ins->addAttachAction ( constants_mailactiontype::INVITE_SUPER_SLOTMACHINE, $slotmachineguid );
		$ins->set_mailtype ( constants_mail::TYPE_GROUP_CHAT );
		return $ins;
	}
}