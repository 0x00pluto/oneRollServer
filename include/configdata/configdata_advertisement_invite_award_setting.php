<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_advertisement_invite_award_setting {
const k_id = "id";
const k_invitecountmin = "invitecountmin";
const k_invitecountmax = "invitecountmax";
const k_gamecoin = "gamecoin";
const k_diamond = "diamond";
const k_itemid = "itemid";
const k_itemcount = "itemcount";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['id'=>'1','invitecountmin'=>'1','invitecountmax'=>'2','gamecoin'=>'30'],
['id'=>'2','invitecountmin'=>'2','invitecountmax'=>'3','gamecoin'=>'50'],
['id'=>'3','invitecountmin'=>'3','invitecountmax'=>'4','gamecoin'=>'100'],
['id'=>'4','invitecountmin'=>'4','invitecountmax'=>'5','diamond'=>'100'],
['id'=>'5','invitecountmin'=>'5','invitecountmax'=>'9999','itemid'=>'209002','itemcount'=>'1']
];
}
 return self::$_data;
}
}
