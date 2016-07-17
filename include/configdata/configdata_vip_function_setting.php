<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_vip_function_setting {
const k_viplevel = "viplevel";
const k_equipmentupgradecrit = "equipmentupgradecrit";
const k_equipmentupgradecritvalue = "equipmentupgradecritvalue";
const k_cheffillvittime = "cheffillvittime";
const k_chefhiretime = "chefhiretime";
const k_givechefequipmenttimes = "givechefequipmenttimes";
const k_neighboorhood_send_gift_1 = "neighboorhood_send_gift_1";
const k_neighboorhood_send_gift_2 = "neighboorhood_send_gift_2";
const k_neighboorhood_send_gift_3 = "neighboorhood_send_gift_3";
const k_neighboorhood_thanks_award_reputation = "neighboorhood_thanks_award_reputation";
const k_frist_lottery_add_weight = "frist_lottery_add_weight";
const k_pve_daily_times_recharge_count = "pve_daily_times_recharge_count";
const k_pve_daily_ticket_buy_times = "pve_daily_ticket_buy_times";
const k_supermachine_rolltimes = "supermachine_rolltimes";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['viplevel'=>'0','equipmentupgradecrit'=>'100','equipmentupgradecritvalue'=>'1','cheffillvittime'=>'2','chefhiretime'=>'10','givechefequipmenttimes'=>'10','neighboorhood_send_gift_1'=>'3','neighboorhood_send_gift_2'=>'5','neighboorhood_send_gift_3'=>'10','neighboorhood_thanks_award_reputation'=>'500','frist_lottery_add_weight'=>'0','pve_daily_times_recharge_count'=>'2','pve_daily_ticket_buy_times'=>'1','supermachine_rolltimes'=>'1'],
['viplevel'=>'1','equipmentupgradecrit'=>'200','equipmentupgradecritvalue'=>'2','cheffillvittime'=>'2','chefhiretime'=>'10','givechefequipmenttimes'=>'10','neighboorhood_send_gift_1'=>'3','neighboorhood_send_gift_2'=>'5','neighboorhood_send_gift_3'=>'10','neighboorhood_thanks_award_reputation'=>'1000','frist_lottery_add_weight'=>'0','pve_daily_times_recharge_count'=>'2','pve_daily_ticket_buy_times'=>'2','supermachine_rolltimes'=>'1'],
['viplevel'=>'2','equipmentupgradecrit'=>'300','equipmentupgradecritvalue'=>'2','cheffillvittime'=>'3','chefhiretime'=>'15','givechefequipmenttimes'=>'10','neighboorhood_send_gift_1'=>'3','neighboorhood_send_gift_2'=>'5','neighboorhood_send_gift_3'=>'10','neighboorhood_thanks_award_reputation'=>'1500','frist_lottery_add_weight'=>'0','pve_daily_times_recharge_count'=>'3','pve_daily_ticket_buy_times'=>'3','supermachine_rolltimes'=>'200'],
['viplevel'=>'3','equipmentupgradecrit'=>'400','equipmentupgradecritvalue'=>'3','cheffillvittime'=>'3','chefhiretime'=>'15','givechefequipmenttimes'=>'10','neighboorhood_send_gift_1'=>'3','neighboorhood_send_gift_2'=>'5','neighboorhood_send_gift_3'=>'10','neighboorhood_thanks_award_reputation'=>'2000','frist_lottery_add_weight'=>'0','pve_daily_times_recharge_count'=>'4','pve_daily_ticket_buy_times'=>'4','supermachine_rolltimes'=>'200'],
['viplevel'=>'4','equipmentupgradecrit'=>'500','equipmentupgradecritvalue'=>'3','cheffillvittime'=>'3','chefhiretime'=>'15','givechefequipmenttimes'=>'10','neighboorhood_send_gift_1'=>'3','neighboorhood_send_gift_2'=>'5','neighboorhood_send_gift_3'=>'10','neighboorhood_thanks_award_reputation'=>'2500','frist_lottery_add_weight'=>'5000','pve_daily_times_recharge_count'=>'5','pve_daily_ticket_buy_times'=>'5','supermachine_rolltimes'=>'200'],
['viplevel'=>'5','equipmentupgradecrit'=>'600','equipmentupgradecritvalue'=>'3','cheffillvittime'=>'3','chefhiretime'=>'15','givechefequipmenttimes'=>'10','neighboorhood_send_gift_1'=>'3','neighboorhood_send_gift_2'=>'5','neighboorhood_send_gift_3'=>'10','neighboorhood_thanks_award_reputation'=>'3000','frist_lottery_add_weight'=>'5000','pve_daily_times_recharge_count'=>'6','pve_daily_ticket_buy_times'=>'6','supermachine_rolltimes'=>'200'],
['viplevel'=>'6','equipmentupgradecrit'=>'700','equipmentupgradecritvalue'=>'3','cheffillvittime'=>'3','chefhiretime'=>'15','givechefequipmenttimes'=>'10','neighboorhood_send_gift_1'=>'3','neighboorhood_send_gift_2'=>'5','neighboorhood_send_gift_3'=>'10','neighboorhood_thanks_award_reputation'=>'3500','frist_lottery_add_weight'=>'5000','pve_daily_times_recharge_count'=>'7','pve_daily_ticket_buy_times'=>'7','supermachine_rolltimes'=>'200'],
['viplevel'=>'7','equipmentupgradecrit'=>'800','equipmentupgradecritvalue'=>'4','cheffillvittime'=>'3','chefhiretime'=>'20','givechefequipmenttimes'=>'10','neighboorhood_send_gift_1'=>'3','neighboorhood_send_gift_2'=>'5','neighboorhood_send_gift_3'=>'10','neighboorhood_thanks_award_reputation'=>'4000','frist_lottery_add_weight'=>'10000','pve_daily_times_recharge_count'=>'8','pve_daily_ticket_buy_times'=>'8','supermachine_rolltimes'=>'200'],
['viplevel'=>'8','equipmentupgradecrit'=>'900','equipmentupgradecritvalue'=>'4','cheffillvittime'=>'4','chefhiretime'=>'20','givechefequipmenttimes'=>'10','neighboorhood_send_gift_1'=>'3','neighboorhood_send_gift_2'=>'5','neighboorhood_send_gift_3'=>'10','neighboorhood_thanks_award_reputation'=>'4500','frist_lottery_add_weight'=>'10000','pve_daily_times_recharge_count'=>'9','pve_daily_ticket_buy_times'=>'9','supermachine_rolltimes'=>'200'],
['viplevel'=>'9','equipmentupgradecrit'=>'1000','equipmentupgradecritvalue'=>'4','cheffillvittime'=>'4','chefhiretime'=>'20','givechefequipmenttimes'=>'10','neighboorhood_send_gift_1'=>'3','neighboorhood_send_gift_2'=>'5','neighboorhood_send_gift_3'=>'10','neighboorhood_thanks_award_reputation'=>'5000','frist_lottery_add_weight'=>'10000','pve_daily_times_recharge_count'=>'10','pve_daily_ticket_buy_times'=>'10','supermachine_rolltimes'=>'200'],
['viplevel'=>'10','equipmentupgradecrit'=>'1100','equipmentupgradecritvalue'=>'4','cheffillvittime'=>'4','chefhiretime'=>'20','givechefequipmenttimes'=>'10','neighboorhood_send_gift_1'=>'3','neighboorhood_send_gift_2'=>'5','neighboorhood_send_gift_3'=>'10','neighboorhood_thanks_award_reputation'=>'5500','frist_lottery_add_weight'=>'10000','pve_daily_times_recharge_count'=>'11','pve_daily_ticket_buy_times'=>'11','supermachine_rolltimes'=>'200']
];
}
 return self::$_data;
}
}
