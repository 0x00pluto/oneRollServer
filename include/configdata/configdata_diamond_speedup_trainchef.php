<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_diamond_speedup_trainchef {
const k_id = "id";
const k_minsec = "minsec";
const k_maxsec = "maxsec";
const k_diamond = "diamond";
const k_gamecoin = "gamecoin";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['id'=>'1','minsec'=>'1','maxsec'=>'300','diamond'=>'1','gamecoin'=>'1'],
['id'=>'2','minsec'=>'301','maxsec'=>'1800','diamond'=>'2','gamecoin'=>'1'],
['id'=>'3','minsec'=>'1801','maxsec'=>'3600','diamond'=>'4','gamecoin'=>'1'],
['id'=>'4','minsec'=>'3601','maxsec'=>'7200','diamond'=>'8','gamecoin'=>'1'],
['id'=>'5','minsec'=>'7201','maxsec'=>'10800','diamond'=>'11','gamecoin'=>'1'],
['id'=>'6','minsec'=>'10801','maxsec'=>'14400','diamond'=>'15','gamecoin'=>'1'],
['id'=>'7','minsec'=>'14401','maxsec'=>'18000','diamond'=>'19','gamecoin'=>'1'],
['id'=>'8','minsec'=>'18001','maxsec'=>'21600','diamond'=>'23','gamecoin'=>'1'],
['id'=>'9','minsec'=>'21601','maxsec'=>'25200','diamond'=>'26','gamecoin'=>'1'],
['id'=>'10','minsec'=>'25201','maxsec'=>'28800','diamond'=>'30','gamecoin'=>'1'],
['id'=>'11','minsec'=>'28801','maxsec'=>'32400','diamond'=>'34','gamecoin'=>'1'],
['id'=>'12','minsec'=>'32401','maxsec'=>'36000','diamond'=>'38','gamecoin'=>'1'],
['id'=>'13','minsec'=>'36001','maxsec'=>'39600','diamond'=>'41','gamecoin'=>'1'],
['id'=>'14','minsec'=>'39601','maxsec'=>'43200','diamond'=>'45','gamecoin'=>'1'],
['id'=>'15','minsec'=>'43201','maxsec'=>'46800','diamond'=>'49','gamecoin'=>'1'],
['id'=>'16','minsec'=>'46801','maxsec'=>'50400','diamond'=>'53','gamecoin'=>'1'],
['id'=>'17','minsec'=>'50401','maxsec'=>'54000','diamond'=>'56','gamecoin'=>'1'],
['id'=>'18','minsec'=>'54001','maxsec'=>'57600','diamond'=>'60','gamecoin'=>'1'],
['id'=>'19','minsec'=>'57601','maxsec'=>'61200','diamond'=>'64','gamecoin'=>'1'],
['id'=>'20','minsec'=>'61201','maxsec'=>'64800','diamond'=>'68','gamecoin'=>'1'],
['id'=>'21','minsec'=>'64801','maxsec'=>'68400','diamond'=>'71','gamecoin'=>'1'],
['id'=>'22','minsec'=>'68401','maxsec'=>'72000','diamond'=>'75','gamecoin'=>'1'],
['id'=>'23','minsec'=>'72001','maxsec'=>'75600','diamond'=>'79','gamecoin'=>'1'],
['id'=>'24','minsec'=>'75601','maxsec'=>'79200','diamond'=>'83','gamecoin'=>'1'],
['id'=>'25','minsec'=>'79201','maxsec'=>'82800','diamond'=>'86','gamecoin'=>'1'],
['id'=>'26','minsec'=>'82801','maxsec'=>'86400','diamond'=>'90','gamecoin'=>'1'],
['id'=>'27','minsec'=>'86401','maxsec'=>'90000','diamond'=>'94','gamecoin'=>'1'],
['id'=>'28','minsec'=>'90001','maxsec'=>'93600','diamond'=>'98','gamecoin'=>'1'],
['id'=>'29','minsec'=>'93601','maxsec'=>'97200','diamond'=>'101','gamecoin'=>'1'],
['id'=>'30','minsec'=>'97201','maxsec'=>'100800','diamond'=>'105','gamecoin'=>'1'],
['id'=>'31','minsec'=>'100801','maxsec'=>'104400','diamond'=>'109','gamecoin'=>'1'],
['id'=>'32','minsec'=>'104401','maxsec'=>'108000','diamond'=>'113','gamecoin'=>'1'],
['id'=>'33','minsec'=>'108001','maxsec'=>'111600','diamond'=>'116','gamecoin'=>'1'],
['id'=>'34','minsec'=>'111601','maxsec'=>'115200','diamond'=>'120','gamecoin'=>'1'],
['id'=>'35','minsec'=>'115201','maxsec'=>'118800','diamond'=>'124','gamecoin'=>'1'],
['id'=>'36','minsec'=>'118801','maxsec'=>'122400','diamond'=>'128','gamecoin'=>'1'],
['id'=>'37','minsec'=>'122401','maxsec'=>'126000','diamond'=>'131','gamecoin'=>'1'],
['id'=>'38','minsec'=>'126001','maxsec'=>'129600','diamond'=>'135','gamecoin'=>'1'],
['id'=>'39','minsec'=>'129601','maxsec'=>'133200','diamond'=>'139','gamecoin'=>'1'],
['id'=>'40','minsec'=>'133201','maxsec'=>'136800','diamond'=>'143','gamecoin'=>'1'],
['id'=>'41','minsec'=>'136801','maxsec'=>'140400','diamond'=>'146','gamecoin'=>'1'],
['id'=>'42','minsec'=>'140401','maxsec'=>'144000','diamond'=>'150','gamecoin'=>'1'],
['id'=>'43','minsec'=>'144001','maxsec'=>'147600','diamond'=>'154','gamecoin'=>'1'],
['id'=>'44','minsec'=>'147601','maxsec'=>'151200','diamond'=>'158','gamecoin'=>'1'],
['id'=>'45','minsec'=>'151201','maxsec'=>'154800','diamond'=>'161','gamecoin'=>'1'],
['id'=>'46','minsec'=>'154801','maxsec'=>'158400','diamond'=>'165','gamecoin'=>'1'],
['id'=>'47','minsec'=>'158401','maxsec'=>'162000','diamond'=>'169','gamecoin'=>'1'],
['id'=>'48','minsec'=>'162001','maxsec'=>'165600','diamond'=>'173','gamecoin'=>'1'],
['id'=>'49','minsec'=>'165601','maxsec'=>'169200','diamond'=>'176','gamecoin'=>'1'],
['id'=>'50','minsec'=>'169201','maxsec'=>'172800','diamond'=>'180','gamecoin'=>'1'],
['id'=>'51','minsec'=>'172801','maxsec'=>'176400','diamond'=>'184','gamecoin'=>'1'],
['id'=>'52','minsec'=>'176401','maxsec'=>'180000','diamond'=>'188','gamecoin'=>'1'],
['id'=>'53','minsec'=>'180001','maxsec'=>'183600','diamond'=>'191','gamecoin'=>'1'],
['id'=>'54','minsec'=>'183601','maxsec'=>'187200','diamond'=>'195','gamecoin'=>'1'],
['id'=>'55','minsec'=>'187201','maxsec'=>'190800','diamond'=>'199','gamecoin'=>'1'],
['id'=>'56','minsec'=>'190801','maxsec'=>'194400','diamond'=>'203','gamecoin'=>'1'],
['id'=>'57','minsec'=>'194401','maxsec'=>'198000','diamond'=>'206','gamecoin'=>'1'],
['id'=>'58','minsec'=>'198001','maxsec'=>'201600','diamond'=>'210','gamecoin'=>'1'],
['id'=>'59','minsec'=>'201601','maxsec'=>'205200','diamond'=>'214','gamecoin'=>'1'],
['id'=>'60','minsec'=>'205201','maxsec'=>'208800','diamond'=>'218','gamecoin'=>'1'],
['id'=>'61','minsec'=>'208801','maxsec'=>'212400','diamond'=>'221','gamecoin'=>'1'],
['id'=>'62','minsec'=>'212401','maxsec'=>'216000','diamond'=>'225','gamecoin'=>'1'],
['id'=>'63','minsec'=>'216001','maxsec'=>'219600','diamond'=>'229','gamecoin'=>'1'],
['id'=>'64','minsec'=>'219601','maxsec'=>'223200','diamond'=>'233','gamecoin'=>'1'],
['id'=>'65','minsec'=>'223201','maxsec'=>'226800','diamond'=>'236','gamecoin'=>'1'],
['id'=>'66','minsec'=>'226801','maxsec'=>'230400','diamond'=>'240','gamecoin'=>'1'],
['id'=>'67','minsec'=>'230401','maxsec'=>'234000','diamond'=>'244','gamecoin'=>'1'],
['id'=>'68','minsec'=>'234001','maxsec'=>'237600','diamond'=>'248','gamecoin'=>'1'],
['id'=>'69','minsec'=>'237601','maxsec'=>'241200','diamond'=>'251','gamecoin'=>'1'],
['id'=>'70','minsec'=>'241201','maxsec'=>'244800','diamond'=>'255','gamecoin'=>'1'],
['id'=>'71','minsec'=>'244801','maxsec'=>'248400','diamond'=>'259','gamecoin'=>'1'],
['id'=>'72','minsec'=>'248401','maxsec'=>'252000','diamond'=>'263','gamecoin'=>'1'],
['id'=>'73','minsec'=>'252001','maxsec'=>'255600','diamond'=>'266','gamecoin'=>'1'],
['id'=>'74','minsec'=>'255601','maxsec'=>'259200','diamond'=>'270','gamecoin'=>'1']
];
}
 return self::$_data;
}
}
