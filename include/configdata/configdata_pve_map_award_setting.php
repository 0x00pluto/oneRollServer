<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_pve_map_award_setting {
const k_awardid = "awardid";
const k_point = "point";
const k_awardgamecoin = "awardgamecoin";
const k_awarddiamond = "awarddiamond";
const k_itemid = "itemid";
const k_itemcount = "itemcount";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['awardid'=>'1_0_1','point'=>'3','awardgamecoin'=>'400','awarddiamond'=>'0'],
['awardid'=>'1_0_2','point'=>'6','awardgamecoin'=>'0','awarddiamond'=>'1'],
['awardid'=>'1_0_3','point'=>'9','awardgamecoin'=>'0','awarddiamond'=>'0','itemid'=>'401011','itemcount'=>'5'],
['awardid'=>'1_1_1','point'=>'3','awardgamecoin'=>'600','awarddiamond'=>'0'],
['awardid'=>'1_1_2','point'=>'6','awardgamecoin'=>'0','awarddiamond'=>'2'],
['awardid'=>'1_1_3','point'=>'9','awardgamecoin'=>'0','awarddiamond'=>'0','itemid'=>'401010','itemcount'=>'5'],
['awardid'=>'2_0_1','point'=>'3','awardgamecoin'=>'480','awarddiamond'=>'0'],
['awardid'=>'2_0_2','point'=>'7','awardgamecoin'=>'0','awarddiamond'=>'1'],
['awardid'=>'2_0_3','point'=>'12','awardgamecoin'=>'0','awarddiamond'=>'0','itemid'=>'401013','itemcount'=>'5'],
['awardid'=>'2_1_1','point'=>'3','awardgamecoin'=>'720','awarddiamond'=>'0'],
['awardid'=>'2_1_2','point'=>'7','awardgamecoin'=>'0','awarddiamond'=>'2'],
['awardid'=>'2_1_3','point'=>'12','awardgamecoin'=>'0','awarddiamond'=>'0','itemid'=>'401012','itemcount'=>'5'],
['awardid'=>'3_0_1','point'=>'6','awardgamecoin'=>'576','awarddiamond'=>'0'],
['awardid'=>'3_0_2','point'=>'12','awardgamecoin'=>'0','awarddiamond'=>'1'],
['awardid'=>'3_0_3','point'=>'18','awardgamecoin'=>'0','awarddiamond'=>'0','itemid'=>'401015','itemcount'=>'5'],
['awardid'=>'3_1_1','point'=>'6','awardgamecoin'=>'860','awarddiamond'=>'0'],
['awardid'=>'3_1_2','point'=>'12','awardgamecoin'=>'0','awarddiamond'=>'2'],
['awardid'=>'3_1_3','point'=>'18','awardgamecoin'=>'0','awarddiamond'=>'0','itemid'=>'401014','itemcount'=>'5'],
['awardid'=>'4_0_1','point'=>'6','awardgamecoin'=>'690','awarddiamond'=>'0'],
['awardid'=>'4_0_2','point'=>'12','awardgamecoin'=>'0','awarddiamond'=>'1'],
['awardid'=>'4_0_3','point'=>'18','awardgamecoin'=>'0','awarddiamond'=>'0','itemid'=>'401011','itemcount'=>'6'],
['awardid'=>'4_1_1','point'=>'6','awardgamecoin'=>'1040','awarddiamond'=>'0'],
['awardid'=>'4_1_2','point'=>'12','awardgamecoin'=>'0','awarddiamond'=>'2'],
['awardid'=>'4_1_3','point'=>'18','awardgamecoin'=>'0','awarddiamond'=>'0','itemid'=>'401010','itemcount'=>'6'],
['awardid'=>'5_0_1','point'=>'6','awardgamecoin'=>'830','awarddiamond'=>'0'],
['awardid'=>'5_0_2','point'=>'12','awardgamecoin'=>'0','awarddiamond'=>'1'],
['awardid'=>'5_0_3','point'=>'18','awardgamecoin'=>'0','awarddiamond'=>'0','itemid'=>'401013','itemcount'=>'6'],
['awardid'=>'5_1_1','point'=>'6','awardgamecoin'=>'1240','awarddiamond'=>'0'],
['awardid'=>'5_1_2','point'=>'12','awardgamecoin'=>'0','awarddiamond'=>'2'],
['awardid'=>'5_1_3','point'=>'18','awardgamecoin'=>'0','awarddiamond'=>'0','itemid'=>'401012','itemcount'=>'6'],
['awardid'=>'6_0_1','point'=>'6','awardgamecoin'=>'990','awarddiamond'=>'0'],
['awardid'=>'6_0_2','point'=>'12','awardgamecoin'=>'0','awarddiamond'=>'1'],
['awardid'=>'6_0_3','point'=>'18','awardgamecoin'=>'0','awarddiamond'=>'0','itemid'=>'401015','itemcount'=>'6'],
['awardid'=>'6_1_1','point'=>'6','awardgamecoin'=>'1490','awarddiamond'=>'0'],
['awardid'=>'6_1_2','point'=>'12','awardgamecoin'=>'0','awarddiamond'=>'2'],
['awardid'=>'6_1_3','point'=>'18','awardgamecoin'=>'0','awarddiamond'=>'0','itemid'=>'401014','itemcount'=>'6'],
['awardid'=>'7_0_1','point'=>'6','awardgamecoin'=>'1190','awarddiamond'=>'0'],
['awardid'=>'7_0_2','point'=>'12','awardgamecoin'=>'0','awarddiamond'=>'1'],
['awardid'=>'7_0_3','point'=>'18','awardgamecoin'=>'0','awarddiamond'=>'0','itemid'=>'401011','itemcount'=>'7'],
['awardid'=>'7_1_1','point'=>'6','awardgamecoin'=>'1790','awarddiamond'=>'0'],
['awardid'=>'7_1_2','point'=>'12','awardgamecoin'=>'0','awarddiamond'=>'2'],
['awardid'=>'7_1_3','point'=>'18','awardgamecoin'=>'0','awarddiamond'=>'0','itemid'=>'401010','itemcount'=>'7'],
['awardid'=>'8_0_1','point'=>'6','awardgamecoin'=>'1430','awarddiamond'=>'0'],
['awardid'=>'8_0_2','point'=>'12','awardgamecoin'=>'0','awarddiamond'=>'1'],
['awardid'=>'8_0_3','point'=>'18','awardgamecoin'=>'0','awarddiamond'=>'0','itemid'=>'401013','itemcount'=>'7'],
['awardid'=>'8_1_1','point'=>'6','awardgamecoin'=>'2150','awarddiamond'=>'0'],
['awardid'=>'8_1_2','point'=>'12','awardgamecoin'=>'0','awarddiamond'=>'2'],
['awardid'=>'8_1_3','point'=>'18','awardgamecoin'=>'0','awarddiamond'=>'0','itemid'=>'401012','itemcount'=>'7'],
['awardid'=>'9_0_1','point'=>'6','awardgamecoin'=>'1720','awarddiamond'=>'0'],
['awardid'=>'9_0_2','point'=>'12','awardgamecoin'=>'0','awarddiamond'=>'1'],
['awardid'=>'9_0_3','point'=>'18','awardgamecoin'=>'0','awarddiamond'=>'0','itemid'=>'401015','itemcount'=>'7'],
['awardid'=>'9_1_1','point'=>'6','awardgamecoin'=>'2570','awarddiamond'=>'0'],
['awardid'=>'9_1_2','point'=>'12','awardgamecoin'=>'0','awarddiamond'=>'2'],
['awardid'=>'9_1_3','point'=>'18','awardgamecoin'=>'0','awarddiamond'=>'0','itemid'=>'401014','itemcount'=>'7'],
['awardid'=>'10_0_1','point'=>'6','awardgamecoin'=>'2060','awarddiamond'=>'0'],
['awardid'=>'10_0_2','point'=>'12','awardgamecoin'=>'0','awarddiamond'=>'1'],
['awardid'=>'10_0_3','point'=>'18','awardgamecoin'=>'0','awarddiamond'=>'0','itemid'=>'401011','itemcount'=>'8'],
['awardid'=>'10_1_1','point'=>'6','awardgamecoin'=>'3090','awarddiamond'=>'0'],
['awardid'=>'10_1_2','point'=>'12','awardgamecoin'=>'0','awarddiamond'=>'2'],
['awardid'=>'10_1_3','point'=>'18','awardgamecoin'=>'0','awarddiamond'=>'0','itemid'=>'401010','itemcount'=>'8']
];
}
 return self::$_data;
}
}
