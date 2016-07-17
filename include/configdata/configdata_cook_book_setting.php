<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_cook_book_setting {
const k_id = "id";
const k_themerestaurantid = "themerestaurantid";
const k_name = "name";
const k_desc = "desc";
const k_type = "type";
const k_autoopen = "autoopen";
const k_openlevel = "openlevel";
const k_opencookbook = "opencookbook";
const k_openvariation = "openvariation";
const k_openformulaid = "openformulaid";
const k_openformulavalue = "openformulavalue";
const k_cookdishesid = "cookdishesid";
const k_needchefvit = "needchefvit";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['id'=>'1','themerestaurantid'=>'1','name'=>'COOKBOOK_NAME_czxgscx','type'=>'501','autoopen'=>'1','openlevel'=>'4','openvariation'=>'0','cookdishesid'=>'1','needchefvit'=>'6'],
['id'=>'2','themerestaurantid'=>'2','name'=>'COOKBOOK_NAME_ftq','type'=>'502','autoopen'=>'1','openlevel'=>'72','openvariation'=>'0','cookdishesid'=>'2','needchefvit'=>'6'],
['id'=>'3','themerestaurantid'=>'1','name'=>'COOKBOOK_NAME_hymgjdx','type'=>'501','autoopen'=>'1','openlevel'=>'3','openvariation'=>'0','cookdishesid'=>'3','needchefvit'=>'6'],
['id'=>'4','themerestaurantid'=>'1','name'=>'COOKBOOK_NAME_cysjhhj','type'=>'501','autoopen'=>'1','openlevel'=>'1','openvariation'=>'0','cookdishesid'=>'4','needchefvit'=>'6'],
['id'=>'5','themerestaurantid'=>'1','name'=>'COOKBOOK_NAME_fqxrxn','type'=>'501','autoopen'=>'1','openlevel'=>'2','openvariation'=>'0','cookdishesid'=>'5','needchefvit'=>'6'],
['id'=>'6','themerestaurantid'=>'2','name'=>'COOKBOOK_NAME_xtxgjgb','type'=>'502','autoopen'=>'1','openlevel'=>'70','openvariation'=>'0','cookdishesid'=>'6','needchefvit'=>'6'],
['id'=>'7','themerestaurantid'=>'3','name'=>'COOKBOOK_NAME_zsnrmtf','type'=>'503','autoopen'=>'1','openlevel'=>'40','openvariation'=>'0','cookdishesid'=>'7','needchefvit'=>'6'],
['id'=>'8','themerestaurantid'=>'2','name'=>'COOKBOOK_NAME_bz','type'=>'502','autoopen'=>'1','openlevel'=>'61','openvariation'=>'0','cookdishesid'=>'8','needchefvit'=>'6'],
['id'=>'9','themerestaurantid'=>'6','name'=>'COOKBOOK_NAME_bf','type'=>'506','autoopen'=>'1','openlevel'=>'17','openvariation'=>'0','cookdishesid'=>'9','needchefvit'=>'6'],
['id'=>'10','themerestaurantid'=>'2','name'=>'COOKBOOK_NAME_hystjrx','type'=>'502','autoopen'=>'1','openlevel'=>'69','openvariation'=>'0','cookdishesid'=>'10','needchefvit'=>'6'],
['id'=>'11','themerestaurantid'=>'2','name'=>'COOKBOOK_NAME_lbjstsg','type'=>'502','autoopen'=>'1','openlevel'=>'67','openvariation'=>'0','cookdishesid'=>'11','needchefvit'=>'6'],
['id'=>'12','themerestaurantid'=>'2','name'=>'COOKBOOK_NAME_lwpmpdf','type'=>'502','autoopen'=>'1','openlevel'=>'65','openvariation'=>'0','cookdishesid'=>'12','needchefvit'=>'6'],
['id'=>'13','themerestaurantid'=>'2','name'=>'COOKBOOK_NAME_cxdjyt','type'=>'502','autoopen'=>'1','openlevel'=>'66','openvariation'=>'0','cookdishesid'=>'13','needchefvit'=>'6'],
['id'=>'14','themerestaurantid'=>'2','name'=>'COOKBOOK_NAME_jwegbjd','type'=>'502','autoopen'=>'1','openlevel'=>'62','openvariation'=>'0','cookdishesid'=>'14','needchefvit'=>'6'],
['id'=>'15','themerestaurantid'=>'2','name'=>'COOKBOOK_NAME_kjfwsbj','type'=>'502','autoopen'=>'1','openlevel'=>'68','openvariation'=>'0','cookdishesid'=>'15','needchefvit'=>'6'],
['id'=>'16','themerestaurantid'=>'2','name'=>'COOKBOOK_NAME_xxhjz','type'=>'502','autoopen'=>'1','openlevel'=>'63','openvariation'=>'0','cookdishesid'=>'16','needchefvit'=>'6'],
['id'=>'17','themerestaurantid'=>'3','name'=>'COOKBOOK_NAME_rslwhxj','type'=>'503','autoopen'=>'1','openlevel'=>'39','openvariation'=>'0','cookdishesid'=>'17','needchefvit'=>'6'],
['id'=>'18','themerestaurantid'=>'3','name'=>'COOKBOOK_NAME_gxnysxs','type'=>'503','autoopen'=>'1','openlevel'=>'46','openvariation'=>'0','cookdishesid'=>'18','needchefvit'=>'6'],
['id'=>'19','themerestaurantid'=>'3','name'=>'COOKBOOK_NAME_csxaxbd','type'=>'503','autoopen'=>'1','openlevel'=>'35','openvariation'=>'0','cookdishesid'=>'19','needchefvit'=>'6'],
['id'=>'20','themerestaurantid'=>'3','name'=>'COOKBOOK_NAME_zhhxlm','type'=>'503','autoopen'=>'1','openlevel'=>'36','openvariation'=>'0','cookdishesid'=>'20','needchefvit'=>'6'],
['id'=>'21','themerestaurantid'=>'3','name'=>'COOKBOOK_NAME_shcsdpp','type'=>'503','autoopen'=>'1','openlevel'=>'49','openvariation'=>'0','cookdishesid'=>'21','needchefvit'=>'6'],
['id'=>'22','themerestaurantid'=>'3','name'=>'COOKBOOK_NAME_sjswss','type'=>'503','autoopen'=>'1','openlevel'=>'34','openvariation'=>'0','cookdishesid'=>'22','needchefvit'=>'6'],
['id'=>'23','themerestaurantid'=>'3','name'=>'COOKBOOK_NAME_bdzshg','type'=>'503','autoopen'=>'1','openlevel'=>'45','openvariation'=>'0','cookdishesid'=>'23','needchefvit'=>'6'],
['id'=>'24','themerestaurantid'=>'3','name'=>'COOKBOOK_NAME_xmmaxbd','type'=>'503','autoopen'=>'1','openlevel'=>'38','openvariation'=>'0','cookdishesid'=>'24','needchefvit'=>'6'],
['id'=>'25','themerestaurantid'=>'3','name'=>'COOKBOOK_NAME_xjkcbd','type'=>'503','autoopen'=>'1','openlevel'=>'42','openvariation'=>'0','cookdishesid'=>'25','needchefvit'=>'6'],
['id'=>'26','themerestaurantid'=>'4','name'=>'COOKBOOK_NAME_ftbd','type'=>'504','autoopen'=>'1','openlevel'=>'29','openvariation'=>'0','cookdishesid'=>'26','needchefvit'=>'6'],
['id'=>'27','themerestaurantid'=>'4','name'=>'COOKBOOK_NAME_ysmmsdg','type'=>'504','autoopen'=>'1','openlevel'=>'23','openvariation'=>'0','cookdishesid'=>'27','needchefvit'=>'6'],
['id'=>'28','themerestaurantid'=>'4','name'=>'COOKBOOK_NAME_mhhkdg','type'=>'504','autoopen'=>'1','openlevel'=>'28','openvariation'=>'0','cookdishesid'=>'28','needchefvit'=>'6'],
['id'=>'29','themerestaurantid'=>'4','name'=>'COOKBOOK_NAME_jbrsxqq','type'=>'504','autoopen'=>'1','openlevel'=>'27','openvariation'=>'0','cookdishesid'=>'29','needchefvit'=>'6'],
['id'=>'30','themerestaurantid'=>'4','name'=>'COOKBOOK_NAME_zxqklsb','type'=>'504','autoopen'=>'1','openlevel'=>'25','openvariation'=>'0','cookdishesid'=>'30','needchefvit'=>'6'],
['id'=>'31','themerestaurantid'=>'4','name'=>'COOKBOOK_NAME_ssfqttq','type'=>'504','autoopen'=>'1','openlevel'=>'26','openvariation'=>'0','cookdishesid'=>'31','needchefvit'=>'6'],
['id'=>'33','themerestaurantid'=>'6','name'=>'COOKBOOK_NAME_fshsldg','type'=>'506','autoopen'=>'1','openlevel'=>'19','openvariation'=>'0','cookdishesid'=>'33','needchefvit'=>'6'],
['id'=>'34','themerestaurantid'=>'4','name'=>'COOKBOOK_NAME_xhrdg','type'=>'504','autoopen'=>'1','openlevel'=>'32','openvariation'=>'0','cookdishesid'=>'34','needchefvit'=>'6'],
['id'=>'35','themerestaurantid'=>'4','name'=>'COOKBOOK_NAME_lmqsdg','type'=>'504','autoopen'=>'1','openlevel'=>'31','openvariation'=>'0','cookdishesid'=>'35','needchefvit'=>'6'],
['id'=>'36','themerestaurantid'=>'5','name'=>'COOKBOOK_NAME_mwwjdg','type'=>'505','autoopen'=>'1','openlevel'=>'58','openvariation'=>'0','cookdishesid'=>'36','needchefvit'=>'6'],
['id'=>'37','themerestaurantid'=>'4','name'=>'COOKBOOK_NAME_xcmbzdg','type'=>'504','autoopen'=>'1','openlevel'=>'30','openvariation'=>'0','cookdishesid'=>'37','needchefvit'=>'6'],
['id'=>'38','themerestaurantid'=>'4','name'=>'COOKBOOK_NAME_fstxmkl','type'=>'504','autoopen'=>'1','openlevel'=>'24','openvariation'=>'0','cookdishesid'=>'38','needchefvit'=>'6'],
['id'=>'39','themerestaurantid'=>'5','name'=>'COOKBOOK_NAME_fsyfbhj','type'=>'505','autoopen'=>'1','openlevel'=>'54','openvariation'=>'0','cookdishesid'=>'39','needchefvit'=>'6'],
['id'=>'40','themerestaurantid'=>'5','name'=>'COOKBOOK_NAME_yzxjswy','type'=>'505','autoopen'=>'1','openlevel'=>'50','openvariation'=>'0','cookdishesid'=>'40','needchefvit'=>'6'],
['id'=>'41','themerestaurantid'=>'1','name'=>'COOKBOOK_NAME_szzsxxq','type'=>'501','autoopen'=>'1','openlevel'=>'6','openvariation'=>'0','cookdishesid'=>'41','needchefvit'=>'6'],
['id'=>'42','themerestaurantid'=>'5','name'=>'COOKBOOK_NAME_xgyzjsl','type'=>'505','autoopen'=>'1','openlevel'=>'59','openvariation'=>'0','cookdishesid'=>'42','needchefvit'=>'6'],
['id'=>'43','themerestaurantid'=>'5','name'=>'COOKBOOK_NAME_azshlxh','type'=>'505','autoopen'=>'1','openlevel'=>'60','openvariation'=>'0','cookdishesid'=>'43','needchefvit'=>'6'],
['id'=>'44','themerestaurantid'=>'6','name'=>'COOKBOOK_NAME_jxbflkc','type'=>'506','autoopen'=>'1','openlevel'=>'13','openvariation'=>'0','cookdishesid'=>'44','needchefvit'=>'6'],
['id'=>'45','themerestaurantid'=>'5','name'=>'COOKBOOK_NAME_mdxjxyp','type'=>'505','autoopen'=>'1','openlevel'=>'56','openvariation'=>'0','cookdishesid'=>'45','needchefvit'=>'6'],
['id'=>'46','themerestaurantid'=>'6','name'=>'COOKBOOK_NAME_mgltps','type'=>'506','autoopen'=>'1','openlevel'=>'20','openvariation'=>'0','cookdishesid'=>'46','needchefvit'=>'6'],
['id'=>'47','themerestaurantid'=>'5','name'=>'COOKBOOK_NAME_xbyhxjf','type'=>'505','autoopen'=>'1','openlevel'=>'52','openvariation'=>'0','cookdishesid'=>'47','needchefvit'=>'6'],
['id'=>'48','themerestaurantid'=>'6','name'=>'COOKBOOK_NAME_xhxlnp','type'=>'506','autoopen'=>'1','openlevel'=>'22','openvariation'=>'0','cookdishesid'=>'48','needchefvit'=>'6'],
['id'=>'49','themerestaurantid'=>'6','name'=>'COOKBOOK_NAME_xlllbbq','type'=>'506','autoopen'=>'1','openlevel'=>'15','openvariation'=>'0','cookdishesid'=>'49','needchefvit'=>'6'],
['id'=>'50','themerestaurantid'=>'6','name'=>'COOKBOOK_NAME_zxxknrb','type'=>'506','autoopen'=>'1','openlevel'=>'10','openvariation'=>'0','cookdishesid'=>'50','needchefvit'=>'6'],
['id'=>'51','themerestaurantid'=>'6','name'=>'COOKBOOK_NAME_xjpglhd','type'=>'506','autoopen'=>'1','openlevel'=>'12','openvariation'=>'0','cookdishesid'=>'51','needchefvit'=>'6'],
['id'=>'52','themerestaurantid'=>'5','name'=>'COOKBOOK_NAME_eslst','type'=>'505','autoopen'=>'1','openlevel'=>'55','openvariation'=>'0','cookdishesid'=>'52','needchefvit'=>'6'],
['id'=>'53','themerestaurantid'=>'6','name'=>'COOKBOOK_NAME_mxgjrj','type'=>'506','autoopen'=>'1','openlevel'=>'14','openvariation'=>'0','cookdishesid'=>'53','needchefvit'=>'6'],
['id'=>'54','themerestaurantid'=>'5','name'=>'COOKBOOK_NAME_sskssl','type'=>'505','autoopen'=>'1','openlevel'=>'51','openvariation'=>'0','cookdishesid'=>'54','needchefvit'=>'6'],
['id'=>'55','themerestaurantid'=>'6','name'=>'COOKBOOK_NAME_ytrjym','type'=>'506','autoopen'=>'1','openlevel'=>'11','openvariation'=>'0','cookdishesid'=>'55','needchefvit'=>'6'],
['id'=>'56','themerestaurantid'=>'1','name'=>'COOKBOOK_NAME_ypxxj','type'=>'501','autoopen'=>'1','openlevel'=>'9','openvariation'=>'0','openformulaid'=>'601001','openformulavalue'=>'2','cookdishesid'=>'56','needchefvit'=>'12'],
['id'=>'57','themerestaurantid'=>'1','name'=>'COOKBOOK_NAME_ytlm','type'=>'501','autoopen'=>'1','openlevel'=>'5','openvariation'=>'0','cookdishesid'=>'57','needchefvit'=>'6'],
['id'=>'58','themerestaurantid'=>'1','name'=>'COOKBOOK_NAME_cmhb','type'=>'501','autoopen'=>'1','openlevel'=>'7','openvariation'=>'0','cookdishesid'=>'58','needchefvit'=>'6'],
['id'=>'59','themerestaurantid'=>'1','name'=>'COOKBOOK_NAME_gszj','type'=>'501','autoopen'=>'1','openlevel'=>'3','openvariation'=>'0','cookdishesid'=>'59','needchefvit'=>'6'],
['id'=>'60','themerestaurantid'=>'1','name'=>'COOKBOOK_NAME_hsnln','type'=>'501','autoopen'=>'1','openlevel'=>'8','openvariation'=>'0','cookdishesid'=>'60','needchefvit'=>'6']
];
}
 return self::$_data;
}
}
