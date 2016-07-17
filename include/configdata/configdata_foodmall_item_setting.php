<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_foodmall_item_setting {
const k_mallid = "mallid";
const k_itemid = "itemid";
const k_malltype = "malltype";
const k_malllv = "malllv";
const k_desc = "desc";
const k_type = "type";
const k_stype = "stype";
const k_pricetype = "pricetype";
const k_price = "price";
const k_maxnum = "maxnum";
const k_limittime = "limittime";
const k_online = "online";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['mallid'=>'1','itemid'=>'301001','malltype'=>'0','malllv'=>'1','pricetype'=>'1','price'=>'10','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'2','itemid'=>'301005','malltype'=>'0','malllv'=>'1','pricetype'=>'1','price'=>'104','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'3','itemid'=>'301009','malltype'=>'0','malllv'=>'1','pricetype'=>'1','price'=>'7','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'4','itemid'=>'301013','malltype'=>'0','malllv'=>'1','pricetype'=>'1','price'=>'3','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'5','itemid'=>'301017','malltype'=>'0','malllv'=>'1','pricetype'=>'1','price'=>'50','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'6','itemid'=>'301021','malltype'=>'0','malllv'=>'1','pricetype'=>'1','price'=>'7','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'7','itemid'=>'301025','malltype'=>'0','malllv'=>'1','pricetype'=>'1','price'=>'18','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'8','itemid'=>'301029','malltype'=>'0','malllv'=>'1','pricetype'=>'1','price'=>'36','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'9','itemid'=>'301033','malltype'=>'0','malllv'=>'1','pricetype'=>'1','price'=>'50','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'10','itemid'=>'301037','malltype'=>'0','malllv'=>'1','pricetype'=>'1','price'=>'10','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'11','itemid'=>'301041','malltype'=>'0','malllv'=>'1','pricetype'=>'1','price'=>'50','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'12','itemid'=>'301045','malltype'=>'0','malllv'=>'1','pricetype'=>'1','price'=>'122','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'13','itemid'=>'301049','malltype'=>'0','malllv'=>'1','pricetype'=>'1','price'=>'32','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'14','itemid'=>'301053','malltype'=>'0','malllv'=>'1','pricetype'=>'1','price'=>'7','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'15','itemid'=>'301057','malltype'=>'0','malllv'=>'1','pricetype'=>'1','price'=>'82','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'16','itemid'=>'301061','malltype'=>'0','malllv'=>'1','pricetype'=>'1','price'=>'10','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'17','itemid'=>'301065','malltype'=>'0','malllv'=>'1','pricetype'=>'1','price'=>'36','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'18','itemid'=>'301069','malltype'=>'0','malllv'=>'1','pricetype'=>'1','price'=>'50','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'19','itemid'=>'301073','malltype'=>'0','malllv'=>'1','pricetype'=>'1','price'=>'50','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'20','itemid'=>'301077','malltype'=>'0','malllv'=>'1','pricetype'=>'1','price'=>'3','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'21','itemid'=>'301081','malltype'=>'0','malllv'=>'1','pricetype'=>'1','price'=>'3','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'22','itemid'=>'301085','malltype'=>'0','malllv'=>'1','pricetype'=>'1','price'=>'60','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'23','itemid'=>'301089','malltype'=>'0','malllv'=>'1','pricetype'=>'1','price'=>'118','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'24','itemid'=>'301093','malltype'=>'0','malllv'=>'1','pricetype'=>'1','price'=>'7','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'25','itemid'=>'301097','malltype'=>'0','malllv'=>'1','pricetype'=>'1','price'=>'50','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'26','itemid'=>'301101','malltype'=>'0','malllv'=>'1','pricetype'=>'1','price'=>'50','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'27','itemid'=>'301105','malltype'=>'0','malllv'=>'1','pricetype'=>'1','price'=>'7','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'28','itemid'=>'301109','malltype'=>'0','malllv'=>'1','pricetype'=>'1','price'=>'26','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'29','itemid'=>'301113','malltype'=>'0','malllv'=>'1','pricetype'=>'1','price'=>'60','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'30','itemid'=>'301117','malltype'=>'1','malllv'=>'1','pricetype'=>'1','price'=>'18','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'31','itemid'=>'301121','malltype'=>'1','malllv'=>'1','pricetype'=>'1','price'=>'18','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'32','itemid'=>'301125','malltype'=>'1','malllv'=>'1','pricetype'=>'1','price'=>'32','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'33','itemid'=>'301129','malltype'=>'1','malllv'=>'1','pricetype'=>'1','price'=>'32','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'34','itemid'=>'301133','malltype'=>'1','malllv'=>'1','pricetype'=>'1','price'=>'36','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'35','itemid'=>'301137','malltype'=>'1','malllv'=>'1','pricetype'=>'1','price'=>'7','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'36','itemid'=>'301141','malltype'=>'1','malllv'=>'1','pricetype'=>'1','price'=>'7','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'37','itemid'=>'301145','malltype'=>'1','malllv'=>'1','pricetype'=>'1','price'=>'32','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'38','itemid'=>'301149','malltype'=>'1','malllv'=>'1','pricetype'=>'1','price'=>'54','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'39','itemid'=>'301153','malltype'=>'1','malllv'=>'1','pricetype'=>'1','price'=>'26','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'40','itemid'=>'301157','malltype'=>'2','malllv'=>'1','pricetype'=>'1','price'=>'54','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'41','itemid'=>'301161','malltype'=>'2','malllv'=>'1','pricetype'=>'1','price'=>'14','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'42','itemid'=>'301165','malltype'=>'2','malllv'=>'1','pricetype'=>'1','price'=>'3','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'43','itemid'=>'301169','malltype'=>'2','malllv'=>'1','pricetype'=>'1','price'=>'201','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'44','itemid'=>'301173','malltype'=>'2','malllv'=>'1','pricetype'=>'1','price'=>'43','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'45','itemid'=>'301177','malltype'=>'2','malllv'=>'1','pricetype'=>'1','price'=>'201','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'46','itemid'=>'301181','malltype'=>'2','malllv'=>'1','pricetype'=>'1','price'=>'112','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'47','itemid'=>'301185','malltype'=>'2','malllv'=>'1','pricetype'=>'1','price'=>'107','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'48','itemid'=>'301189','malltype'=>'1','malllv'=>'1','pricetype'=>'1','price'=>'0','maxnum'=>'99','limittime'=>'0','online'=>'0'],
['mallid'=>'49','itemid'=>'301193','malltype'=>'1','malllv'=>'1','pricetype'=>'1','price'=>'0','maxnum'=>'99','limittime'=>'0','online'=>'0'],
['mallid'=>'50','itemid'=>'301197','malltype'=>'1','malllv'=>'1','pricetype'=>'1','price'=>'43','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'51','itemid'=>'301201','malltype'=>'0','malllv'=>'1','pricetype'=>'1','price'=>'64','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'52','itemid'=>'301205','malltype'=>'1','malllv'=>'1','pricetype'=>'1','price'=>'216','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'53','itemid'=>'301209','malltype'=>'2','malllv'=>'1','pricetype'=>'1','price'=>'54','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'54','itemid'=>'301213','malltype'=>'1','malllv'=>'1','pricetype'=>'1','price'=>'80','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'55','itemid'=>'301217','malltype'=>'1','malllv'=>'1','pricetype'=>'1','price'=>'14','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'56','itemid'=>'301221','malltype'=>'1','malllv'=>'1','pricetype'=>'1','price'=>'50','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'57','itemid'=>'301225','malltype'=>'2','malllv'=>'1','pricetype'=>'1','price'=>'0','maxnum'=>'99','limittime'=>'0','online'=>'0'],
['mallid'=>'58','itemid'=>'301229','malltype'=>'0','malllv'=>'1','pricetype'=>'1','price'=>'25','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'59','itemid'=>'301233','malltype'=>'0','malllv'=>'1','pricetype'=>'1','price'=>'0','maxnum'=>'99','limittime'=>'0','online'=>'0'],
['mallid'=>'60','itemid'=>'301237','malltype'=>'0','malllv'=>'1','pricetype'=>'1','price'=>'83','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'61','itemid'=>'301241','malltype'=>'0','malllv'=>'1','pricetype'=>'1','price'=>'50','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'62','itemid'=>'301245','malltype'=>'0','malllv'=>'1','pricetype'=>'1','price'=>'43','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'63','itemid'=>'301249','malltype'=>'1','malllv'=>'1','pricetype'=>'1','price'=>'36','maxnum'=>'99','limittime'=>'0','online'=>'1'],
['mallid'=>'64','itemid'=>'301253','malltype'=>'2','malllv'=>'1','pricetype'=>'1','price'=>'43','maxnum'=>'99','limittime'=>'0','online'=>'1']
];
}
 return self::$_data;
}
}
