<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_restaurant_level_setting {
const k_level = "level";
const k_needexp = "needexp";
const k_totalexp = "totalexp";
const k_chairs = "chairs";
const k_gamecoin = "gamecoin";
const k_diamond = "diamond";
const k_dinnertablemax = "dinnertablemax";
const k_cookingtable_max = "cookingtable_max";
const k_graftslotcount = "graftslotcount";
const k_employeechefnum = "employeechefnum";
const k_reputation = "reputation";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['level'=>'1','needexp'=>'0','totalexp'=>'0','chairs'=>'2','gamecoin'=>'0','diamond'=>'0','dinnertablemax'=>'2','cookingtable_max'=>'2','graftslotcount'=>'1','employeechefnum'=>'2','reputation'=>'1'],
['level'=>'2','needexp'=>'86','totalexp'=>'86','chairs'=>'3','gamecoin'=>'188','diamond'=>'5','dinnertablemax'=>'4','cookingtable_max'=>'2','graftslotcount'=>'1','employeechefnum'=>'3','reputation'=>'2'],
['level'=>'3','needexp'=>'198','totalexp'=>'284','chairs'=>'3','gamecoin'=>'288','diamond'=>'5','dinnertablemax'=>'4','cookingtable_max'=>'3','graftslotcount'=>'2','employeechefnum'=>'4','reputation'=>'3'],
['level'=>'4','needexp'=>'273','totalexp'=>'557','chairs'=>'4','gamecoin'=>'388','diamond'=>'5','dinnertablemax'=>'5','cookingtable_max'=>'3','graftslotcount'=>'2','employeechefnum'=>'5','reputation'=>'4'],
['level'=>'5','needexp'=>'306','totalexp'=>'863','chairs'=>'4','gamecoin'=>'488','diamond'=>'5','dinnertablemax'=>'5','cookingtable_max'=>'3','graftslotcount'=>'3','employeechefnum'=>'6','reputation'=>'5'],
['level'=>'6','needexp'=>'484','totalexp'=>'1347','chairs'=>'4','gamecoin'=>'588','diamond'=>'5','dinnertablemax'=>'6','cookingtable_max'=>'4','graftslotcount'=>'3','employeechefnum'=>'7','reputation'=>'6'],
['level'=>'7','needexp'=>'340','totalexp'=>'1687','chairs'=>'4','gamecoin'=>'688','diamond'=>'5','dinnertablemax'=>'6','cookingtable_max'=>'4','graftslotcount'=>'3','employeechefnum'=>'8','reputation'=>'7'],
['level'=>'8','needexp'=>'394','totalexp'=>'2081','chairs'=>'5','gamecoin'=>'788','diamond'=>'5','dinnertablemax'=>'7','cookingtable_max'=>'4','graftslotcount'=>'3','employeechefnum'=>'9','reputation'=>'8'],
['level'=>'9','needexp'=>'515','totalexp'=>'2596','chairs'=>'5','gamecoin'=>'888','diamond'=>'5','dinnertablemax'=>'7','cookingtable_max'=>'4','graftslotcount'=>'3','employeechefnum'=>'10','reputation'=>'9'],
['level'=>'10','needexp'=>'960','totalexp'=>'3556','chairs'=>'5','gamecoin'=>'988','diamond'=>'5','dinnertablemax'=>'8','cookingtable_max'=>'4','graftslotcount'=>'3','employeechefnum'=>'11','reputation'=>'10'],
['level'=>'11','needexp'=>'780','totalexp'=>'4336','chairs'=>'7','gamecoin'=>'1088','diamond'=>'5','dinnertablemax'=>'4','cookingtable_max'=>'2','graftslotcount'=>'3','employeechefnum'=>'12','reputation'=>'11'],
['level'=>'12','needexp'=>'1100','totalexp'=>'5436','chairs'=>'7','gamecoin'=>'1188','diamond'=>'5','dinnertablemax'=>'4','cookingtable_max'=>'2','graftslotcount'=>'3','employeechefnum'=>'13','reputation'=>'12'],
['level'=>'13','needexp'=>'1100','totalexp'=>'6536','chairs'=>'7','gamecoin'=>'1288','diamond'=>'5','dinnertablemax'=>'4','cookingtable_max'=>'2','graftslotcount'=>'3','employeechefnum'=>'14','reputation'=>'13'],
['level'=>'14','needexp'=>'1200','totalexp'=>'7736','chairs'=>'7','gamecoin'=>'1388','diamond'=>'5','dinnertablemax'=>'4','cookingtable_max'=>'2','graftslotcount'=>'3','employeechefnum'=>'15','reputation'=>'14'],
['level'=>'15','needexp'=>'1300','totalexp'=>'9036','chairs'=>'8','gamecoin'=>'1488','diamond'=>'0','dinnertablemax'=>'5','cookingtable_max'=>'2','graftslotcount'=>'3','employeechefnum'=>'16','reputation'=>'15'],
['level'=>'16','needexp'=>'1400','totalexp'=>'10436','chairs'=>'8','gamecoin'=>'1588','diamond'=>'5','dinnertablemax'=>'5','cookingtable_max'=>'2','graftslotcount'=>'3','employeechefnum'=>'17','reputation'=>'16'],
['level'=>'17','needexp'=>'1500','totalexp'=>'11936','chairs'=>'8','gamecoin'=>'1688','diamond'=>'5','dinnertablemax'=>'5','cookingtable_max'=>'2','graftslotcount'=>'3','employeechefnum'=>'18','reputation'=>'17'],
['level'=>'18','needexp'=>'1600','totalexp'=>'13536','chairs'=>'8','gamecoin'=>'1788','diamond'=>'5','dinnertablemax'=>'5','cookingtable_max'=>'2','graftslotcount'=>'3','employeechefnum'=>'19','reputation'=>'18'],
['level'=>'19','needexp'=>'1700','totalexp'=>'15236','chairs'=>'8','gamecoin'=>'1888','diamond'=>'5','dinnertablemax'=>'5','cookingtable_max'=>'2','graftslotcount'=>'3','employeechefnum'=>'20','reputation'=>'19'],
['level'=>'20','needexp'=>'1800','totalexp'=>'17036','chairs'=>'9','gamecoin'=>'1988','diamond'=>'5','dinnertablemax'=>'6','cookingtable_max'=>'2','graftslotcount'=>'3','employeechefnum'=>'21','reputation'=>'20'],
['level'=>'21','needexp'=>'1800','totalexp'=>'18836','chairs'=>'9','gamecoin'=>'2088','diamond'=>'10','dinnertablemax'=>'6','cookingtable_max'=>'2','graftslotcount'=>'3','employeechefnum'=>'22','reputation'=>'21'],
['level'=>'22','needexp'=>'1800','totalexp'=>'20636','chairs'=>'9','gamecoin'=>'2188','diamond'=>'10','dinnertablemax'=>'6','cookingtable_max'=>'2','graftslotcount'=>'3','employeechefnum'=>'23','reputation'=>'22'],
['level'=>'23','needexp'=>'1800','totalexp'=>'22436','chairs'=>'9','gamecoin'=>'2288','diamond'=>'10','dinnertablemax'=>'7','cookingtable_max'=>'3','graftslotcount'=>'3','employeechefnum'=>'24','reputation'=>'23'],
['level'=>'24','needexp'=>'1800','totalexp'=>'24236','chairs'=>'9','gamecoin'=>'2388','diamond'=>'10','dinnertablemax'=>'7','cookingtable_max'=>'3','graftslotcount'=>'3','employeechefnum'=>'25','reputation'=>'24'],
['level'=>'25','needexp'=>'1800','totalexp'=>'26036','chairs'=>'10','gamecoin'=>'2488','diamond'=>'10','dinnertablemax'=>'7','cookingtable_max'=>'3','graftslotcount'=>'3','employeechefnum'=>'26','reputation'=>'25'],
['level'=>'26','needexp'=>'1800','totalexp'=>'27836','chairs'=>'10','gamecoin'=>'2588','diamond'=>'10','dinnertablemax'=>'7','cookingtable_max'=>'3','graftslotcount'=>'3','employeechefnum'=>'27','reputation'=>'26'],
['level'=>'27','needexp'=>'1800','totalexp'=>'29636','chairs'=>'10','gamecoin'=>'2688','diamond'=>'10','dinnertablemax'=>'8','cookingtable_max'=>'3','graftslotcount'=>'3','employeechefnum'=>'28','reputation'=>'27'],
['level'=>'28','needexp'=>'1800','totalexp'=>'31436','chairs'=>'10','gamecoin'=>'2788','diamond'=>'10','dinnertablemax'=>'8','cookingtable_max'=>'3','graftslotcount'=>'3','employeechefnum'=>'29','reputation'=>'28'],
['level'=>'29','needexp'=>'1800','totalexp'=>'33236','chairs'=>'10','gamecoin'=>'2888','diamond'=>'20','dinnertablemax'=>'8','cookingtable_max'=>'3','graftslotcount'=>'3','employeechefnum'=>'30','reputation'=>'29'],
['level'=>'30','needexp'=>'1800','totalexp'=>'35036','chairs'=>'11','gamecoin'=>'2988','diamond'=>'20','dinnertablemax'=>'9','cookingtable_max'=>'3','graftslotcount'=>'3','employeechefnum'=>'31','reputation'=>'30'],
['level'=>'31','needexp'=>'1800','totalexp'=>'36836','chairs'=>'11','gamecoin'=>'3088','diamond'=>'20','dinnertablemax'=>'9','cookingtable_max'=>'3','graftslotcount'=>'3','employeechefnum'=>'32','reputation'=>'31'],
['level'=>'32','needexp'=>'1800','totalexp'=>'38636','chairs'=>'11','gamecoin'=>'3188','diamond'=>'20','dinnertablemax'=>'9','cookingtable_max'=>'3','graftslotcount'=>'3','employeechefnum'=>'33','reputation'=>'32'],
['level'=>'33','needexp'=>'1800','totalexp'=>'40436','chairs'=>'11','gamecoin'=>'3288','diamond'=>'20','dinnertablemax'=>'9','cookingtable_max'=>'3','graftslotcount'=>'3','employeechefnum'=>'34','reputation'=>'33'],
['level'=>'34','needexp'=>'1800','totalexp'=>'42236','chairs'=>'11','gamecoin'=>'3388','diamond'=>'20','dinnertablemax'=>'10','cookingtable_max'=>'3','graftslotcount'=>'3','employeechefnum'=>'35','reputation'=>'34'],
['level'=>'35','needexp'=>'1800','totalexp'=>'44036','chairs'=>'12','gamecoin'=>'3488','diamond'=>'20','dinnertablemax'=>'10','cookingtable_max'=>'3','graftslotcount'=>'3','employeechefnum'=>'36','reputation'=>'35'],
['level'=>'36','needexp'=>'1800','totalexp'=>'45836','chairs'=>'12','gamecoin'=>'3588','diamond'=>'20','dinnertablemax'=>'10','cookingtable_max'=>'3','graftslotcount'=>'3','employeechefnum'=>'37','reputation'=>'36'],
['level'=>'37','needexp'=>'1800','totalexp'=>'47636','chairs'=>'12','gamecoin'=>'3688','diamond'=>'20','dinnertablemax'=>'10','cookingtable_max'=>'3','graftslotcount'=>'3','employeechefnum'=>'38','reputation'=>'37'],
['level'=>'38','needexp'=>'1800','totalexp'=>'49436','chairs'=>'12','gamecoin'=>'3788','diamond'=>'20','dinnertablemax'=>'10','cookingtable_max'=>'3','graftslotcount'=>'4','employeechefnum'=>'39','reputation'=>'38'],
['level'=>'39','needexp'=>'1800','totalexp'=>'51236','chairs'=>'12','gamecoin'=>'3888','diamond'=>'20','dinnertablemax'=>'11','cookingtable_max'=>'3','graftslotcount'=>'5','employeechefnum'=>'40','reputation'=>'39'],
['level'=>'40','needexp'=>'1800','totalexp'=>'53036','chairs'=>'13','gamecoin'=>'3988','diamond'=>'50','dinnertablemax'=>'11','cookingtable_max'=>'3','graftslotcount'=>'6','employeechefnum'=>'41','reputation'=>'40'],
['level'=>'41','needexp'=>'1800','totalexp'=>'54836','chairs'=>'13','gamecoin'=>'4088','diamond'=>'50','dinnertablemax'=>'11','cookingtable_max'=>'3','graftslotcount'=>'7','employeechefnum'=>'42','reputation'=>'41'],
['level'=>'42','needexp'=>'1800','totalexp'=>'56636','chairs'=>'13','gamecoin'=>'4188','diamond'=>'50','dinnertablemax'=>'11','cookingtable_max'=>'3','graftslotcount'=>'8','employeechefnum'=>'43','reputation'=>'42'],
['level'=>'43','needexp'=>'1800','totalexp'=>'58436','chairs'=>'13','gamecoin'=>'4288','diamond'=>'50','dinnertablemax'=>'11','cookingtable_max'=>'3','graftslotcount'=>'9','employeechefnum'=>'44','reputation'=>'43'],
['level'=>'44','needexp'=>'1800','totalexp'=>'60236','chairs'=>'13','gamecoin'=>'4388','diamond'=>'50','dinnertablemax'=>'12','cookingtable_max'=>'3','graftslotcount'=>'10','employeechefnum'=>'45','reputation'=>'44'],
['level'=>'45','needexp'=>'1800','totalexp'=>'62036','chairs'=>'14','gamecoin'=>'4488','diamond'=>'50','dinnertablemax'=>'12','cookingtable_max'=>'3','graftslotcount'=>'10','employeechefnum'=>'46','reputation'=>'45'],
['level'=>'46','needexp'=>'1800','totalexp'=>'63836','chairs'=>'14','gamecoin'=>'4588','diamond'=>'50','dinnertablemax'=>'12','cookingtable_max'=>'3','graftslotcount'=>'10','employeechefnum'=>'47','reputation'=>'46'],
['level'=>'47','needexp'=>'1800','totalexp'=>'65636','chairs'=>'14','gamecoin'=>'4688','diamond'=>'50','dinnertablemax'=>'12','cookingtable_max'=>'3','graftslotcount'=>'10','employeechefnum'=>'48','reputation'=>'47'],
['level'=>'48','needexp'=>'1800','totalexp'=>'67436','chairs'=>'14','gamecoin'=>'4788','diamond'=>'50','dinnertablemax'=>'13','cookingtable_max'=>'3','graftslotcount'=>'10','employeechefnum'=>'49','reputation'=>'48'],
['level'=>'49','needexp'=>'1800','totalexp'=>'69236','chairs'=>'14','gamecoin'=>'4888','diamond'=>'50','dinnertablemax'=>'13','cookingtable_max'=>'3','graftslotcount'=>'10','employeechefnum'=>'50','reputation'=>'49'],
['level'=>'50','needexp'=>'1800','totalexp'=>'71036','chairs'=>'15','gamecoin'=>'4988','diamond'=>'50','dinnertablemax'=>'13','cookingtable_max'=>'3','graftslotcount'=>'10','employeechefnum'=>'51','reputation'=>'50'],
['level'=>'51','needexp'=>'1800','totalexp'=>'72836','chairs'=>'15','gamecoin'=>'5088','diamond'=>'50','dinnertablemax'=>'13','cookingtable_max'=>'3','graftslotcount'=>'10','employeechefnum'=>'52','reputation'=>'51'],
['level'=>'52','needexp'=>'1800','totalexp'=>'74636','chairs'=>'15','gamecoin'=>'5188','diamond'=>'50','dinnertablemax'=>'14','cookingtable_max'=>'3','graftslotcount'=>'10','employeechefnum'=>'53','reputation'=>'52'],
['level'=>'53','needexp'=>'1800','totalexp'=>'76436','chairs'=>'15','gamecoin'=>'5288','diamond'=>'50','dinnertablemax'=>'14','cookingtable_max'=>'3','graftslotcount'=>'10','employeechefnum'=>'54','reputation'=>'53'],
['level'=>'54','needexp'=>'1800','totalexp'=>'78236','chairs'=>'15','gamecoin'=>'5388','diamond'=>'50','dinnertablemax'=>'14','cookingtable_max'=>'3','graftslotcount'=>'10','employeechefnum'=>'55','reputation'=>'54'],
['level'=>'55','needexp'=>'1800','totalexp'=>'80036','chairs'=>'16','gamecoin'=>'5488','diamond'=>'50','dinnertablemax'=>'14','cookingtable_max'=>'3','graftslotcount'=>'10','employeechefnum'=>'56','reputation'=>'55'],
['level'=>'56','needexp'=>'1800','totalexp'=>'81836','chairs'=>'16','gamecoin'=>'5588','diamond'=>'50','dinnertablemax'=>'15','cookingtable_max'=>'3','graftslotcount'=>'10','employeechefnum'=>'57','reputation'=>'56'],
['level'=>'57','needexp'=>'1800','totalexp'=>'83636','chairs'=>'16','gamecoin'=>'5688','diamond'=>'50','dinnertablemax'=>'15','cookingtable_max'=>'3','graftslotcount'=>'10','employeechefnum'=>'58','reputation'=>'57'],
['level'=>'58','needexp'=>'1800','totalexp'=>'85436','chairs'=>'16','gamecoin'=>'5788','diamond'=>'50','dinnertablemax'=>'15','cookingtable_max'=>'3','graftslotcount'=>'10','employeechefnum'=>'59','reputation'=>'58'],
['level'=>'59','needexp'=>'1800','totalexp'=>'87236','chairs'=>'16','gamecoin'=>'5888','diamond'=>'50','dinnertablemax'=>'15','cookingtable_max'=>'3','graftslotcount'=>'10','employeechefnum'=>'60','reputation'=>'59'],
['level'=>'60','needexp'=>'1800','totalexp'=>'89036','chairs'=>'17','gamecoin'=>'5988','diamond'=>'50','dinnertablemax'=>'15','cookingtable_max'=>'3','graftslotcount'=>'10','employeechefnum'=>'61','reputation'=>'60'],
['level'=>'61','needexp'=>'1800','totalexp'=>'90836','chairs'=>'17','gamecoin'=>'6088','diamond'=>'50','dinnertablemax'=>'16','cookingtable_max'=>'3','graftslotcount'=>'10','employeechefnum'=>'62','reputation'=>'61'],
['level'=>'62','needexp'=>'1800','totalexp'=>'92636','chairs'=>'17','gamecoin'=>'6188','diamond'=>'50','dinnertablemax'=>'16','cookingtable_max'=>'3','graftslotcount'=>'10','employeechefnum'=>'63','reputation'=>'62'],
['level'=>'63','needexp'=>'1800','totalexp'=>'94436','chairs'=>'17','gamecoin'=>'6288','diamond'=>'50','dinnertablemax'=>'16','cookingtable_max'=>'3','graftslotcount'=>'10','employeechefnum'=>'64','reputation'=>'63'],
['level'=>'64','needexp'=>'1800','totalexp'=>'96236','chairs'=>'17','gamecoin'=>'6388','diamond'=>'50','dinnertablemax'=>'16','cookingtable_max'=>'3','graftslotcount'=>'10','employeechefnum'=>'65','reputation'=>'64'],
['level'=>'65','needexp'=>'1800','totalexp'=>'98036','chairs'=>'17','gamecoin'=>'6488','diamond'=>'50','dinnertablemax'=>'16','cookingtable_max'=>'3','graftslotcount'=>'10','employeechefnum'=>'66','reputation'=>'65'],
['level'=>'66','needexp'=>'1800','totalexp'=>'99836','chairs'=>'18','gamecoin'=>'6588','diamond'=>'50','dinnertablemax'=>'17','cookingtable_max'=>'3','graftslotcount'=>'10','employeechefnum'=>'67','reputation'=>'66'],
['level'=>'67','needexp'=>'1800','totalexp'=>'101636','chairs'=>'18','gamecoin'=>'6688','diamond'=>'50','dinnertablemax'=>'17','cookingtable_max'=>'3','graftslotcount'=>'10','employeechefnum'=>'68','reputation'=>'67'],
['level'=>'68','needexp'=>'1800','totalexp'=>'103436','chairs'=>'18','gamecoin'=>'6788','diamond'=>'50','dinnertablemax'=>'17','cookingtable_max'=>'3','graftslotcount'=>'10','employeechefnum'=>'69','reputation'=>'68'],
['level'=>'69','needexp'=>'1800','totalexp'=>'105236','chairs'=>'18','gamecoin'=>'6888','diamond'=>'50','dinnertablemax'=>'17','cookingtable_max'=>'4','graftslotcount'=>'10','employeechefnum'=>'70','reputation'=>'69'],
['level'=>'70','needexp'=>'1800','totalexp'=>'107036','chairs'=>'18','gamecoin'=>'6988','diamond'=>'50','dinnertablemax'=>'17','cookingtable_max'=>'4','graftslotcount'=>'10','employeechefnum'=>'71','reputation'=>'70'],
['level'=>'71','needexp'=>'1800','totalexp'=>'108836','chairs'=>'18','gamecoin'=>'7088','diamond'=>'50','dinnertablemax'=>'17','cookingtable_max'=>'4','graftslotcount'=>'10','employeechefnum'=>'72','reputation'=>'71'],
['level'=>'72','needexp'=>'1800','totalexp'=>'110636','chairs'=>'18','gamecoin'=>'7188','diamond'=>'50','dinnertablemax'=>'17','cookingtable_max'=>'4','graftslotcount'=>'10','employeechefnum'=>'73','reputation'=>'72'],
['level'=>'73','needexp'=>'1800','totalexp'=>'112436','chairs'=>'19','gamecoin'=>'7288','diamond'=>'50','dinnertablemax'=>'17','cookingtable_max'=>'4','graftslotcount'=>'10','employeechefnum'=>'74','reputation'=>'73'],
['level'=>'74','needexp'=>'1800','totalexp'=>'114236','chairs'=>'19','gamecoin'=>'7388','diamond'=>'50','dinnertablemax'=>'17','cookingtable_max'=>'4','graftslotcount'=>'10','employeechefnum'=>'75','reputation'=>'74'],
['level'=>'75','needexp'=>'1800','totalexp'=>'116036','chairs'=>'19','gamecoin'=>'7488','diamond'=>'50','dinnertablemax'=>'17','cookingtable_max'=>'4','graftslotcount'=>'10','employeechefnum'=>'76','reputation'=>'75'],
['level'=>'76','needexp'=>'1800','totalexp'=>'117836','chairs'=>'19','gamecoin'=>'7588','diamond'=>'50','dinnertablemax'=>'17','cookingtable_max'=>'4','graftslotcount'=>'10','employeechefnum'=>'77','reputation'=>'76'],
['level'=>'77','needexp'=>'1800','totalexp'=>'119636','chairs'=>'19','gamecoin'=>'7688','diamond'=>'50','dinnertablemax'=>'17','cookingtable_max'=>'4','graftslotcount'=>'10','employeechefnum'=>'78','reputation'=>'77'],
['level'=>'78','needexp'=>'1800','totalexp'=>'121436','chairs'=>'19','gamecoin'=>'7788','diamond'=>'50','dinnertablemax'=>'17','cookingtable_max'=>'4','graftslotcount'=>'10','employeechefnum'=>'79','reputation'=>'78'],
['level'=>'79','needexp'=>'1800','totalexp'=>'123236','chairs'=>'19','gamecoin'=>'7888','diamond'=>'50','dinnertablemax'=>'17','cookingtable_max'=>'4','graftslotcount'=>'10','employeechefnum'=>'80','reputation'=>'79'],
['level'=>'80','needexp'=>'1800','totalexp'=>'125036','chairs'=>'19','gamecoin'=>'7988','diamond'=>'50','dinnertablemax'=>'17','cookingtable_max'=>'4','graftslotcount'=>'10','employeechefnum'=>'81','reputation'=>'80'],
['level'=>'81','needexp'=>'1800','totalexp'=>'126836','chairs'=>'19','gamecoin'=>'8088','diamond'=>'50','dinnertablemax'=>'17','cookingtable_max'=>'4','graftslotcount'=>'10','employeechefnum'=>'82','reputation'=>'81'],
['level'=>'82','needexp'=>'1800','totalexp'=>'128636','chairs'=>'20','gamecoin'=>'8188','diamond'=>'50','dinnertablemax'=>'17','cookingtable_max'=>'4','graftslotcount'=>'10','employeechefnum'=>'83','reputation'=>'82'],
['level'=>'83','needexp'=>'1800','totalexp'=>'130436','chairs'=>'20','gamecoin'=>'8288','diamond'=>'50','dinnertablemax'=>'17','cookingtable_max'=>'4','graftslotcount'=>'10','employeechefnum'=>'84','reputation'=>'83'],
['level'=>'84','needexp'=>'1800','totalexp'=>'132236','chairs'=>'20','gamecoin'=>'8388','diamond'=>'50','dinnertablemax'=>'17','cookingtable_max'=>'4','graftslotcount'=>'10','employeechefnum'=>'85','reputation'=>'84'],
['level'=>'85','needexp'=>'1800','totalexp'=>'134036','chairs'=>'20','gamecoin'=>'8488','diamond'=>'50','dinnertablemax'=>'17','cookingtable_max'=>'5','graftslotcount'=>'10','employeechefnum'=>'86','reputation'=>'85'],
['level'=>'86','needexp'=>'1800','totalexp'=>'135836','chairs'=>'20','gamecoin'=>'8588','diamond'=>'50','dinnertablemax'=>'17','cookingtable_max'=>'5','graftslotcount'=>'10','employeechefnum'=>'87','reputation'=>'86'],
['level'=>'87','needexp'=>'1800','totalexp'=>'137636','chairs'=>'20','gamecoin'=>'8688','diamond'=>'50','dinnertablemax'=>'17','cookingtable_max'=>'5','graftslotcount'=>'10','employeechefnum'=>'88','reputation'=>'87'],
['level'=>'88','needexp'=>'1800','totalexp'=>'139436','chairs'=>'20','gamecoin'=>'8788','diamond'=>'50','dinnertablemax'=>'17','cookingtable_max'=>'5','graftslotcount'=>'10','employeechefnum'=>'89','reputation'=>'88'],
['level'=>'89','needexp'=>'1800','totalexp'=>'141236','chairs'=>'20','gamecoin'=>'8888','diamond'=>'50','dinnertablemax'=>'17','cookingtable_max'=>'5','graftslotcount'=>'10','employeechefnum'=>'90','reputation'=>'89'],
['level'=>'90','needexp'=>'1800','totalexp'=>'143036','chairs'=>'20','gamecoin'=>'8988','diamond'=>'50','dinnertablemax'=>'17','cookingtable_max'=>'5','graftslotcount'=>'10','employeechefnum'=>'91','reputation'=>'90'],
['level'=>'91','needexp'=>'1800','totalexp'=>'144836','chairs'=>'20','gamecoin'=>'9088','diamond'=>'50','dinnertablemax'=>'17','cookingtable_max'=>'5','graftslotcount'=>'10','employeechefnum'=>'92','reputation'=>'91'],
['level'=>'92','needexp'=>'1800','totalexp'=>'146636','chairs'=>'21','gamecoin'=>'9188','diamond'=>'50','dinnertablemax'=>'17','cookingtable_max'=>'5','graftslotcount'=>'10','employeechefnum'=>'93','reputation'=>'92'],
['level'=>'93','needexp'=>'1800','totalexp'=>'148436','chairs'=>'21','gamecoin'=>'9288','diamond'=>'50','dinnertablemax'=>'17','cookingtable_max'=>'5','graftslotcount'=>'10','employeechefnum'=>'94','reputation'=>'93'],
['level'=>'94','needexp'=>'1800','totalexp'=>'150236','chairs'=>'21','gamecoin'=>'9388','diamond'=>'50','dinnertablemax'=>'17','cookingtable_max'=>'5','graftslotcount'=>'10','employeechefnum'=>'95','reputation'=>'94'],
['level'=>'95','needexp'=>'1800','totalexp'=>'152036','chairs'=>'21','gamecoin'=>'9488','diamond'=>'50','dinnertablemax'=>'17','cookingtable_max'=>'5','graftslotcount'=>'10','employeechefnum'=>'96','reputation'=>'95'],
['level'=>'96','needexp'=>'1800','totalexp'=>'153836','chairs'=>'21','gamecoin'=>'9588','diamond'=>'50','dinnertablemax'=>'17','cookingtable_max'=>'5','graftslotcount'=>'10','employeechefnum'=>'97','reputation'=>'96'],
['level'=>'97','needexp'=>'1800','totalexp'=>'155636','chairs'=>'21','gamecoin'=>'9688','diamond'=>'50','dinnertablemax'=>'17','cookingtable_max'=>'5','graftslotcount'=>'10','employeechefnum'=>'98','reputation'=>'97'],
['level'=>'98','needexp'=>'1800','totalexp'=>'157436','chairs'=>'21','gamecoin'=>'9788','diamond'=>'50','dinnertablemax'=>'17','cookingtable_max'=>'5','graftslotcount'=>'10','employeechefnum'=>'99','reputation'=>'98'],
['level'=>'99','needexp'=>'1800','totalexp'=>'159236','chairs'=>'21','gamecoin'=>'9888','diamond'=>'50','dinnertablemax'=>'17','cookingtable_max'=>'5','graftslotcount'=>'10','employeechefnum'=>'100','reputation'=>'99'],
['level'=>'100','needexp'=>'1800','totalexp'=>'161036','chairs'=>'21','gamecoin'=>'9988','diamond'=>'50','dinnertablemax'=>'17','cookingtable_max'=>'5','graftslotcount'=>'10','employeechefnum'=>'101','reputation'=>'100']
];
}
 return self::$_data;
}
}
