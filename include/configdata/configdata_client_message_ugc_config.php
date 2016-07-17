<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_client_message_ugc_config {
const k_id = "id";
const k_type = "type";
const k_subtype = "subtype";
const k_messagekey = "messagekey";
const k_messagevalue = "messagevalue";
const k_diamond = "diamond";
const k_gamecoin = "gamecoin";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['id'=>'1','type'=>'1','subtype'=>'101','messagekey'=>'system'],
['id'=>'2','type'=>'1','subtype'=>'102','messagekey'=>'systemnotice'],
['id'=>'3','type'=>'1','subtype'=>'103','messagekey'=>'systenallowance'],
['id'=>'4','type'=>'3','subtype'=>'301','messagekey'=>'chefrobed'],
['id'=>'5','type'=>'3','subtype'=>'302','messagekey'=>'chefemployed'],
['id'=>'6','type'=>'3','subtype'=>'303','messagekey'=>'redbag'],
['id'=>'7','type'=>'3','subtype'=>'304','messagekey'=>'getredbag'],
['id'=>'8','type'=>'3','subtype'=>'305','messagekey'=>'sendmaterial'],
['id'=>'9','type'=>'3','subtype'=>'306','messagekey'=>'helpupgradestar'],
['id'=>'10','type'=>'3','subtype'=>'307','messagekey'=>'helpspeedupdish'],
['id'=>'11','type'=>'3','subtype'=>'308','messagekey'=>'helpconsumedish'],
['id'=>'12','type'=>'3','subtype'=>'309','messagekey'=>'chefdisappear'],
['id'=>'13','type'=>'3','subtype'=>'310','messagekey'=>'cheftrained'],
['id'=>'14','type'=>'3','subtype'=>'311','messagekey'=>'chefrecharged'],
['id'=>'15','type'=>'3','subtype'=>'312','messagekey'=>'chefequiped'],
['id'=>'16','type'=>'3','subtype'=>'313','messagekey'=>'equipmentenhuanced'],
['id'=>'17','type'=>'3','subtype'=>'314','messagekey'=>'tradecomplete'],
['id'=>'18','type'=>'2','subtype'=>'201','messagekey'=>'thanks'],
['id'=>'19','type'=>'2','subtype'=>'202','messagekey'=>'chat'],
['id'=>'20','type'=>'3','subtype'=>'315','messagekey'=>'tigmachinerequire'],
['id'=>'21','type'=>'2','subtype'=>'203','messagekey'=>'chat']
];
}
 return self::$_data;
}
}
