<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_zone_setting {
const k_zoneid = "zoneid";
const k_name = "name";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['zoneid'=>'1','name'=>'大陆'],
['zoneid'=>'2','name'=>'瑞士'],
['zoneid'=>'3','name'=>'韩国'],
['zoneid'=>'4','name'=>'新西兰'],
['zoneid'=>'5','name'=>'加拿大'],
['zoneid'=>'6','name'=>'澳大利亚'],
['zoneid'=>'7','name'=>'奥地利'],
['zoneid'=>'8','name'=>'比利时'],
['zoneid'=>'9','name'=>'巴西'],
['zoneid'=>'10','name'=>'英国'],
['zoneid'=>'11','name'=>'丹麦'],
['zoneid'=>'12','name'=>'芬兰'],
['zoneid'=>'13','name'=>'法国'],
['zoneid'=>'14','name'=>'德国'],
['zoneid'=>'15','name'=>'香港'],
['zoneid'=>'16','name'=>'印度'],
['zoneid'=>'17','name'=>'印度尼西亚'],
['zoneid'=>'18','name'=>'伊朗'],
['zoneid'=>'19','name'=>'以色列'],
['zoneid'=>'20','name'=>'意大利'],
['zoneid'=>'21','name'=>'日本'],
['zoneid'=>'22','name'=>'马来西亚'],
['zoneid'=>'23','name'=>'墨西哥'],
['zoneid'=>'24','name'=>'荷兰'],
['zoneid'=>'25','name'=>'挪威'],
['zoneid'=>'26','name'=>'菲律宾'],
['zoneid'=>'27','name'=>'葡萄牙'],
['zoneid'=>'28','name'=>'俄罗斯'],
['zoneid'=>'29','name'=>'沙特阿拉伯'],
['zoneid'=>'30','name'=>'新加坡'],
['zoneid'=>'31','name'=>'西班牙'],
['zoneid'=>'32','name'=>'瑞典'],
['zoneid'=>'33','name'=>'泰国'],
['zoneid'=>'34','name'=>'土耳其'],
['zoneid'=>'35','name'=>'阿联酋'],
['zoneid'=>'36','name'=>'乌克兰'],
['zoneid'=>'37','name'=>'美国'],
['zoneid'=>'38','name'=>'越南']
];
}
 return self::$_data;
}
}
