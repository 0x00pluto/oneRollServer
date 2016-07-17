<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_csv_resources_setting {
const k_key = "key";
const k_value = "value";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['key'=>'ResourceCheckCode','value'=>'SVN_26173'],
['key'=>'SVNRevision','value'=>'26173']
];
}
 return self::$_data;
}
}
