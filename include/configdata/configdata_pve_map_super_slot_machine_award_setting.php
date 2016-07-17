<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_pve_map_super_slot_machine_award_setting {
const k_awardid = "awardid";
const k_itemid = "itemid";
const k_itemcount = "itemcount";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['awardid'=>'award_0_0','itemid'=>'2','itemcount'=>'1'],
['awardid'=>'award_0_1','itemid'=>'2','itemcount'=>'10'],
['awardid'=>'award_0_2','itemid'=>'2','itemcount'=>'100'],
['awardid'=>'award_1_0','itemid'=>'204001','itemcount'=>'4'],
['awardid'=>'award_1_1','itemid'=>'204001','itemcount'=>'40'],
['awardid'=>'award_1_2','itemid'=>'204001','itemcount'=>'400'],
['awardid'=>'award_2_0','itemid'=>'204002','itemcount'=>'10'],
['awardid'=>'award_2_1','itemid'=>'204002','itemcount'=>'20'],
['awardid'=>'award_2_2','itemid'=>'204002','itemcount'=>'50'],
['awardid'=>'award_3_0','itemid'=>'210001','itemcount'=>'1'],
['awardid'=>'award_3_1','itemid'=>'210001','itemcount'=>'1'],
['awardid'=>'award_3_2','itemid'=>'210001','itemcount'=>'1'],
['awardid'=>'award_4_0','itemid'=>'1','itemcount'=>'6'],
['awardid'=>'award_4_1','itemid'=>'1','itemcount'=>'60'],
['awardid'=>'award_4_2','itemid'=>'1','itemcount'=>'600']
];
}
 return self::$_data;
}
}
