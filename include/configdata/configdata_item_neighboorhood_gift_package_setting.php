<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_item_neighboorhood_gift_package_setting {
const k_id = "id";
const k_quality = "quality";
const k_selldiamond = "selldiamond";
const k_sellgamecoin = "sellgamecoin";
const k_recvtimes = "recvtimes";
const k_awardreputation = "awardreputation";
const k_awarditemid = "awarditemid";
const k_awarditemcount = "awarditemcount";
const k_duringtime = "duringtime";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['id'=>'207001','quality'=>'1','selldiamond'=>'0','sellgamecoin'=>'50000','recvtimes'=>'8','awardreputation'=>'10','awarditemid'=>'401001','awarditemcount'=>'10','duringtime'=>'86400'],
['id'=>'207002','quality'=>'2','selldiamond'=>'100','sellgamecoin'=>'0','recvtimes'=>'10','awardreputation'=>'20','awarditemid'=>'401002','awarditemcount'=>'10','duringtime'=>'86400'],
['id'=>'207003','quality'=>'3','selldiamond'=>'500','sellgamecoin'=>'0','recvtimes'=>'12','awardreputation'=>'30','awarditemid'=>'401003','awarditemcount'=>'10','duringtime'=>'86400']
];
}
 return self::$_data;
}
}
