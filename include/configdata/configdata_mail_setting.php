<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_mail_setting {
const k_id = "id";
const k_type = "type";
const k_subtype = "subtype";
const k_mergeid = "mergeid";
const k_languageid = "languageid";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['id'=>'1000','type'=>'user','languageid'=>'MAIL_CHEF_TRAIN_REQUEST_NO_PRESENTS'],
['id'=>'1001','type'=>'user','languageid'=>'MAIL_CHEF_TRAIN_REQUEST_WITH_PRESENTS'],
['id'=>'1002','type'=>'user','languageid'=>'MAIL_CHEF_TRAIN_ACCEPT_REQUEST'],
['id'=>'1003','type'=>'user','languageid'=>'MAIL_CHEF_TRAIN_ACCEPT_ONE_REJECT_REQUEST'],
['id'=>'1004','type'=>'user','languageid'=>'MAIL_CHEF_TRAIN_REJECT_REQUEST'],
['id'=>'1005','type'=>'user','languageid'=>'MAIL_CHEF_TRAIN_SPEEDUP'],
['id'=>'1006','type'=>'system','mergeid'=>'10000','languageid'=>'MAIL_CHEF_TRAIN_FINISH_SINGLE'],
['id'=>'1007','type'=>'user','languageid'=>'MAIL_CHEF_TRAIN_FINISH_DOUBLE'],
['id'=>'1008','type'=>'user','languageid'=>'MAIL_CHEF_TRAIN_FINISH_SEND_GIFT'],
['id'=>'1009','type'=>'system','mergeid'=>'10001','languageid'=>'MAIL_CHEF_TRAIN_FINISH_CAN_SHOP'],
['id'=>'1010','type'=>'user','languageid'=>'MAIL_CHEF_TRAIN_ACCEPT_ONE_REJECT_REQUEST_WITH_PRESENTS'],
['id'=>'1011','type'=>'user','languageid'=>'MAIL_CHEF_TRAIN_REJECT_REQUEST_WITH_PRESENTS'],
['id'=>'2000','type'=>'user','languageid'=>'MAIL_ITEM_GRAFT_REQUEST'],
['id'=>'2001','type'=>'user','languageid'=>'MAIL_ITEM_GRAFT_ACCEPT_REQUEST'],
['id'=>'2002','type'=>'user','languageid'=>'MAIL_ITEM_GRAFT_REFUSE_REQUEST'],
['id'=>'2003','type'=>'system','mergeid'=>'10000','languageid'=>'MAIL_ITEM_GRAFT_REQUEST_EXPIRED'],
['id'=>'2004','type'=>'user','languageid'=>'MAIL_ITEM_GRAFT_TIMEOUT'],
['id'=>'2005','type'=>'user','languageid'=>'MAIL_ITEM_GRAFT_SPEEDUP'],
['id'=>'2006','type'=>'user','languageid'=>'MAIL_ITEM_GRAFT_SPEEDUP_ADD_ITEM'],
['id'=>'2007','type'=>'user','languageid'=>'MAIL_ITEM_GRAFT_COMPLETE'],
['id'=>'3000','type'=>'user','languageid'=>'MAIL_HIRE_CHEF_REQUEST_WITHOUT_PRESENT'],
['id'=>'3001','type'=>'user','languageid'=>'MAIL_HIRE_CHEF_REQUEST_WITH_PRESENT'],
['id'=>'3002','type'=>'user','languageid'=>'MAIL_HIRE_CHEF_REQUEST_REFUSE'],
['id'=>'3003','type'=>'user','languageid'=>'MAIL_HIRE_CHEF_REQUEST_EXPIRED'],
['id'=>'3004','type'=>'user','languageid'=>'MAIL_HIRE_CHEF_REQUEST_ACCEPT'],
['id'=>'3005','type'=>'user','languageid'=>'MAIL_HIRE_CHEF_GO_HOME'],
['id'=>'3006','type'=>'system','mergeid'=>'10000','languageid'=>'MAIL_HIRE_CHEF_GO_BACK'],
['id'=>'4000','type'=>'system','mergeid'=>'10002','languageid'=>'MAIL_INVITE_MASTERGIFT'],
['id'=>'4001','type'=>'user','languageid'=>'MAIL_INVITE_SLAVEGIFT'],
['id'=>'5000','type'=>'user','languageid'=>'MAIL_FRIEND_STARTTALKING'],
['id'=>'6000','type'=>'system','mergeid'=>'10000','languageid'=>'MAIL_FASHIONDRESS_OVERTIME'],
['id'=>'7000','type'=>'system','mergeid'=>'10000','languageid'=>'MAIL_RAFFLE_TEN_OFF_CAPACITY'],
['id'=>'8000','type'=>'system','mergeid'=>'10000','languageid'=>'MAIL_MONTH_CARD_COLLECT']
];
}
 return self::$_data;
}
}
