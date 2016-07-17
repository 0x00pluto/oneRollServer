<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_chef_job_setting {
const k_jobid = "jobid";
const k_openlevel = "openlevel";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['jobid'=>'1','openlevel'=>'1'],
['jobid'=>'2','openlevel'=>'50'],
['jobid'=>'3','openlevel'=>'30'],
['jobid'=>'4','openlevel'=>'40']
];
}
 return self::$_data;
}
}
