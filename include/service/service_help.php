<?php

namespace service;

use Common\Db\Common_Db_memcached;
use Common\Util\Common_Util_File;
use Common\Util\Common_Util_Reference;
use constants\constants_messagecmd;
use hellaEngine\data\data_base;
use hellaEngine\service\service_basecallablefunctiondata;
use hellaEngine\service\service_builder;
use Prophecy\Doubler\Generator\ReflectionInterface;

class service_help extends \hellaEngine\service\service_help
{

    /**
     * @inheritDoc
     */
    protected function configureFunctions()
    {
        parent::configureFunctions();
        $this->addFunction('test', true);
        $this->addFunction('dumpcode', true);
    }


    /**
     * 生成lua常量文件
     * @param string $classname
     * @return string
     */
    private function gen_constants_lua_file($classname)
    {
        // 生成反向消息文件
        $description = "-- generate by help.dumpcode\n";
        $description .= "-- Don't change by yourself!!\n\n";
        $shortclassname = str_replace("constants\\", "", $classname);
        $description .= "YYNetCommand_" . $shortclassname . " = " . "YYNetCommand_" . $shortclassname . " or {}\n";

        $refclass = new \ReflectionClass ($classname);
        $constants = $refclass->getConstants();

        $constants_comment = Common_Util_Reference::getConstDocument($classname);

        foreach ($constants as $key => $value) {
            if (isset ($constants_comment [$key])) {
                $description .= "--[[\n\t";
                $description .= $constants_comment [$key] . "\n";
                $description .= "--]]\n";
            }
            $description .= "YYNetCommand_" . $shortclassname . '.' . $key . " = '" . $value . "'\n";
        }

        return $description;
    }

    /**
     * 递归生成Lua文件
     * @param string $path
     */
    private function traverseDumpLuaCode($path = '.')
    {

        // 跳过文件短名称
        $skipfileShortname = $this->skipfileShortname;

        if (!is_dir($_SERVER ['DOCUMENT_ROOT'] . "/lua_code")) {
            mkdir($_SERVER ['DOCUMENT_ROOT'] . "/lua_code", 0777, true);
        }
        $zip = new \ZipArchive ();
        $zipfile = $_SERVER ['DOCUMENT_ROOT'] . "/lua_code/lua_code.zip";
        if (file_exists($zipfile)) {
            @unlink($zipfile);
        }
        $zip->open($zipfile, \ZipArchive::CREATE);

        $lua_filearray = array();

        $current_dir = opendir($path); // opendir()返回一个目录句柄,失败返回false


        while (($file = readdir($current_dir)) !== false) { // readdir()返回打开目录句柄中的一个条目
            $sub_dir = $path . DIRECTORY_SEPARATOR . $file; // 构建子目录路径

            if ($file == '.' || $file == '..') {
                continue;
            } else if (is_dir($sub_dir)) { // 如果是目录,进行递归
                echo 'Directory ' . $file . ':<br>';
                $this->traverseDumpLuaCode($sub_dir);
            } else { // 如果是文件,直接输出
                // echo 'File in Directory ' . $path . ': ' . $file . '<br>';
                $shortname = basename($file, ".php");
                // dump ( $shortname );
                if (in_array($shortname, $skipfileShortname)) {
                    continue;
                }
                $shortname = substr($shortname, 8);


                // echo '<br>';

                // 生成lua文件
                $classname = 'service\service_' . $shortname;

                $ref = new \ReflectionClass ($classname);
                // 虚类
                if ($ref->isAbstract()) {
                    continue;
                }

                $ref = service_builder::o()->create($classname);
                if (!$ref instanceof service_base || !$ref->getEnable()) {
                    continue;
                }
// 				dump ( [
// 						$classname,
// 						$ref->isExportForLuaCode ()
// 				] );
                if (!$ref->isExportForLuaCode()) {
                    continue;
                }

                $luafilename = $_SERVER ['DOCUMENT_ROOT'] . "/lua_code/YYNetCommand_" . $shortname . ".lua";
                $fp = fopen($luafilename, "wb");
//                fwrite($fp,  $ref->dumpluacode());
//                dump($this->dumpServiceLuaCode($ref));
                fwrite($fp, $this->dumpServiceLuaCode($ref));
                fclose($fp);

                $luafilepartialname = $_SERVER ['DOCUMENT_ROOT'] . "/lua_code/CTDataModelOf" . ucwords($shortname) . "_partial_messageflow.lua";
                $fppartial = fopen($luafilepartialname, "wb");
                fwrite($fppartial, $this->dumpServiceLuaModelPartialCode($ref));
//                fwrite($fppartial, $ref->dumpClientLuaModelPartialCode());
                fclose($fppartial);
                $lua_filearray [] = $luafilename;
                // 打包
                $zip->addFile($luafilename, "YYNetCommand_" . $shortname . ".lua");

                $zip->addFile($luafilepartialname, "CTDataModelOf" . ucwords($shortname) . "_partial_messageflow.lua");

                // echo '<font color="#00F000">' . $ref->getDocComment () . '</font><br>';

                // echo '<font color="#FF0000">', $shortname . '</font><br>';
            }
        }

        // 生成常量文件
        $files = Common_Util_File::traverse(C(\configure_constants::INCLUDE_PATH) . "constants");
        foreach ($files as $file) {

            $shortname = basename($file, ".php");
            $luafilename = $_SERVER ['DOCUMENT_ROOT'] . "/lua_code/YYNetCommand_" . $shortname . ".lua";
            $classcontent = $this->gen_constants_lua_file("constants\\" . $shortname);

            $fp = fopen($luafilename, "wb");
            fwrite($fp, $classcontent);
            fclose($fp);

            $zip->addFile($luafilename, "YYNetCommand_" . $shortname . ".lua");
            $lua_filearray [] = $luafilename;
        }

        // 生成数据类字段

        $files = Common_Util_File::traverse(C(\configure_constants::INCLUDE_PATH) . "dbs");
        $classcontent = "-- generate by help.dumpcode\n";
        $classcontent .= "-- Don't change by yourself!!\n\n";
        $classcontent .= "DBServerKey = DBServerKey or {} \n";
        foreach ($files as $file) {
            $shortname = basename($file, ".php");
            $namespaces = explode('_', $shortname);
            array_pop($namespaces);
            $namespace = join("\\", $namespaces);
            $classname = $namespace . "\\" . $shortname;

            try {
                $classref = new \ReflectionClass ($classname);
                if ($classref->isInstantiable() && $classref->isSubclassOf(data_base::class)) {
                    foreach ($classref->getConstants() as $key => $value) {
                        if (stripos($key, "DBKEY_") === 0) {
                            if ($value == "_id") {
                                continue;
                            }
                            $classcontent .= "DBServerKey." . $shortname . "_" . $value . " = '" . $value . "' \n";
                        }
                    }
                }
            } catch (\Exception $e) {
            }
        }
        // dump ( $classcontent );

        $luafilename = $_SERVER ['DOCUMENT_ROOT'] . "/lua_code/YYNetCommand_DBServerKey.lua";
        $fp = fopen($luafilename, "wb");
        fwrite($fp, $classcontent);
        fclose($fp);
        $zip->addFile($luafilename, "YYNetCommand_DBServerKey.lua");
        $lua_filearray [] = $luafilename;

        // 生成反向消息文件
        $luafilename = $_SERVER ['DOCUMENT_ROOT'] . "/lua_code/YYNetCommand_S2C.lua";

        $description = "-- generate by help.dumpcode\n";
        $description .= "-- Don't change by yourself!!\n\n";
        $description .= "YYNetCommand_S2C = YYNetCommand_S2C or {}\n";

        $refclass = new \ReflectionClass (constants_messagecmd::class);
        $constants = $refclass->getConstants();

        foreach ($constants as $key => $value) {
            $description .= 'YYNetCommand_S2C.' . $key . " = '" . $value . "'\n";
        }

        // dump ( $description );
        $fp = fopen($luafilename, "wb");
        fwrite($fp, $description);
        fclose($fp);

        $zip->addFile($luafilename, "YYNetCommand_S2C.lua");
        $lua_filearray [] = $luafilename;

        // 生成包含文件
        $luafilename = $_SERVER ['DOCUMENT_ROOT'] . "/lua_code/YYNetCommand_include.lua";
        $description = "-- generate by help.dumpcode\n";
        $description .= "-- Don't change by yourself!!\n";
        foreach ($lua_filearray as $value) {
            $shortname = basename($value, ".lua");
            $description .= 'require("YY.Game.socket.' . $shortname . '")' . "\n";
        }
        $fp = fopen($luafilename, "wb");
        fwrite($fp, $description);
        fclose($fp);
        $zip->addFile($luafilename, "YYNetCommand_include.lua");

        $luafilename = $_SERVER ['DOCUMENT_ROOT'] . "/lua_code/YYNetCommand_allKey.lua";
        $description = "-- generate by help.dumpcode\n";
        $description .= "-- Don't change by yourself!!\n";
        $description .= "local YYNetCommand_allKey = {\n";
        for ($i = 0; $i < count($lua_filearray); $i++) {
            $file = $lua_filearray [$i];
            $shortname = basename($file, '.lua');
            $description .= '[' . ($i + 1) . "]={key='";
            $description .= $shortname . "'},\n";
        }
        $description = rtrim($description, ",\n");
        $description .= "\n}\n";
        $description .= "return YYNetCommand_allKey";

        $fp = fopen($luafilename, "wb");
        fwrite($fp, $description);
        fclose($fp);
        $zip->addFile($luafilename, "YYNetCommand_allKey.lua");

        // YY.Game.socket
        $lua_filearray [] = $luafilename;

        $zip->close();

        foreach ($lua_filearray as $value) {
            @unlink($value);
        }
    }

    /**
     * 生成lua客户端代码
     *
     * @param service_base $serviceInstance
     * @return string
     */
    private function dumpServiceLuaCode(service_base $serviceInstance)
    {
        $tab = '     ';

        $refClass = new \ReflectionClass (get_class($serviceInstance));
        $classname = $refClass->getName();
        $shortclassname = $refClass->getShortName();
        // // 类真实名称
        $classrealname = explode("_", $shortclassname) [1];
//        dump([$classname, $shortclassname]);
//        dump($classrealname);

        $description = "-- generate by help.dumpcode\n";
        $description .= "-- Don't change by yourself!!\n";
        $description .= "--[[\n";
        $description .= $refClass->getDocComment();
        $description .= "\n--]]\n";

        $description .= "YYNetCommand_C2S = YYNetCommand_C2S or {}\n";
        foreach ($serviceInstance->getFunctions() as $functionName => $value) {
            if ($functionName != 'help') {
                $propertys = $refClass->getMethod($functionName);

                // 不给客户端导出调试代码
                $functiondata = new service_basecallablefunctiondata ();
                $functiondata->fromArray($value);
                if ($functiondata->get_isDebugFunction()) {
                    continue;
                }

                $retCode_contants = NULL;
                $retCodeAutoClassname = C(\configure_constants::APP_NAMESPACE) . "\\err\\err_" . $shortclassname . "_" . $functionName;

                // 具体错误的类
                $err_classname_prefix = $serviceInstance->get_err_class_name();
                if (!empty ($err_classname_prefix)) {
                    $err_classname = $err_classname_prefix . $functionName;

                    if (class_exists($err_classname) ||
                        interface_exists($err_classname)
                    ) {

                        $ref_retCode = new \ReflectionClass ($err_classname);
                        $retCode_contants = $ref_retCode->getConstants();
                    }
                } elseif (class_exists($retCodeAutoClassname) ||
                    interface_exists($retCodeAutoClassname)
                ) {
                    $ref_retCode = new \ReflectionClass ($retCodeAutoClassname);
                    $retCode_contants = $ref_retCode->getConstants();
                } else {
                    // 查找对应的dbs寻找返回值
                    $retCodedbsClassname = C(\configure_constants::APP_NAMESPACE) . "\\err\\err_" . "dbs_" . $classrealname . "_" . $functionName;
                    if (class_exists($retCodedbsClassname) ||
                        interface_exists($retCodedbsClassname)
                    ) {
                        $ref_retCode = new \ReflectionClass ($retCodedbsClassname);
                        $retCode_contants = $ref_retCode->getConstants();
                    }
                }

                // dump ( $retCode_contants );

                if (!is_null($retCode_contants)) {
                    $description .= "YYNet_" . $classrealname . "_" . $propertys->name . "_RetCode = {}\n";

                    foreach ($retCode_contants as $key => $retCode_contant_value) {
                        $description .= "YYNet_" . $classrealname . "_" . $propertys->name . "_RetCode." . $key . "=" . $retCode_contant_value . "\n";
                    }
                }

                $description .= "--[[\n";
                $description .= $propertys->getDocComment() . "\n--]]\n";

                // 增加消息id
                $functionname = $classrealname . "_" . $propertys->name;
                $cmdname = $classrealname . "." . $propertys->name;
                $pointname = "YYNetCommand_C2S." . $functionname;
                $description .= $pointname . " = '" . $cmdname . "'\n";

                $func = "YYNetCommand_" . $classrealname . "_" . $propertys->name . '(';

                $description .= "function " . $func;
                foreach ($propertys->getParameters() as $parameterValue) {
                    $description .= $parameterValue->name . ',';
                }
                // $description = substr($description, 0,-1);
                $description .= "callback)\n";
                $description .= $tab . 'call_remote_function(\'' . $classrealname . "." . $propertys->name . "',callback";
                if (count($propertys->getParameters()) > 0) {
                    $description .= ",{\n";
                    foreach ($propertys->getParameters() as $value) {
                        $description .= $tab . $tab . $value->name . "=" . $value->name . ",\n";
                    }
                    $description = substr($description, 0, -2);
                    $description .= "\n";
                    $description .= $tab . $tab . "})\n";
                } else {
                    $description .= ")\n";
                }
                $description .= "end\n\n\n";
            }
        }

        // dump ( $description );
        return $description;
    }

    /**
     * 生成lua客户端消息流注册代码
     *
     * @param service_base $serviceInstance
     * @return string
     */
    private function dumpServiceLuaModelPartialCode(service_base $serviceInstance)
    {
        $tab = '     ';

        $refclass = new \ReflectionClass (get_class($serviceInstance));
        $classname = $refclass->getName();
        $shortclassname = $refclass->getShortName();
        // // 类真实名称
        $classrealname = explode("_", $shortclassname) [1];
        // dump ( $classrealname );
        $classrealnameBigFirstWord = ucwords($classrealname);

        $shortmodelname = 'CTDataModelOf' . $classrealnameBigFirstWord;
        $partialclassname = $shortmodelname . "_partial_messageflow";

        $description = "-- generate by help.dumpcode\n";
        $description .= "-- Don't change by yourself!!\n";
        $description .= "--[[\n";
        $description .= $refclass->getDocComment();
        $description .= "\n--]]\n";

        $description .= "local __DEBUG = YYConstPlatform:sharedPlatform():isDebugFunction() and true\n";
        $description .= "local logfilter= " . '"' . $partialclassname . ".lua" . '"' . "\n";
        $description .= "if __DEBUG then\n";
        $description .= $tab . 'gamelog["filter"]:add(logfilter)' . "\n";
        $description .= "end\n\n";
        $description .= "local " . $shortmodelname . " = {}\n";
        $description .= "function " . $partialclassname . "(" . $shortmodelname . "__class)\n";
        $description .= $tab . "table.merge(" . $shortmodelname . "__class.__index or " . $shortmodelname . "__class," . $shortmodelname . ")\n";
        $description .= $tab . "setmetatable(" . $shortmodelname . "," . $shortmodelname . "__class)\n";
        $description .= "end\n\n";

        foreach ($serviceInstance->getFunctions() as $methodname => $value) {
            if ($methodname != 'help') {
                $propertys = $refclass->getMethod($methodname);

                // 不给客户端导出调试代码
                $functiondata = new service_basecallablefunctiondata ();
                $functiondata->fromArray($value);
                if ($functiondata->get_isDebugFunction()) {
                    continue;
                }


                $description .= "--[[\n";
                $description .= $propertys->getDocComment() . "\n--]]\n";

                $functionname = $classrealname . "_" . $propertys->name;
                $pointname = "YYNetCommand_C2S." . $functionname;

                // 增加消息id
                $func = "YYNetCommand_" . $classrealname . "_" . $propertys->name . '(';

                // 注册客户端消息流
                $description .= "function " . $shortmodelname . ":" . $propertys->name . "(";
                $yyparam_check = "";
                if (count($propertys->getParameters()) > 0) {
                    foreach ($propertys->getParameters() as $value) {
                        $description .= $value->name . ',';
                        $yyparam_check .= "YYParam_c_notnil(" . $value->name . ")\n" . $tab;
                    }
                }
                $description .= "callback)\n";
                $description .= $tab . $yyparam_check . "\n";

                $description .= $tab . $func;
                if (count($propertys->getParameters()) > 0) {
                    foreach ($propertys->getParameters() as $value) {
                        $description .= $value->name . ',';
                    }
                }


                $description .= "function ( msgdata )\n";
                $description .= $tab . $tab . "local succ = HttpMessageDealer_preProcessMsg(self,msgdata)\n";
                $description .= $tab . $tab . "if succ then\n";
                $description .= $tab . $tab . $tab . "local data = HttpNetWorkCenter_getRtnData(msgdata)\n\n";
                $description .= $tab . $tab . $tab . "--do something\n\n";
                $description .= $tab . $tab . $tab . "if callback then\n";
                $description .= $tab . $tab . $tab . $tab . "callback(data)\n";
                $description .= $tab . $tab . $tab . "end\n";
                $description .= $tab . $tab . "end\n";
                $description .= $tab . "end)\n";
                $description .= "end\n";

                $description .= "register_message_flow(" . $pointname . ",function(msgdata,params)\n";
                $description .= $tab . "local msgparam = HttpNetWorkCenter_getParams(msgdata)\n";
                $description .= $tab . "if HttpNetWorkCenter_isSucc(msgdata) then \n";
                $description .= $tab . $tab . "--todo\n";
                $description .= $tab . "end\n";
                $description .= "end)\n\n\n";
            }
        }

        // dump ( $description );
        return $description;
    }

    /**
     * 生成代码
     */
    public function dumpcode()
    {
        $this->traverseDumpLuaCode(dirname(__FILE__));

        $a = '<a href="./lua_code/lua_code.zip">接口代码下载</a>';
        dump($a);
    }

    public function test()
    {
        echo 'test';

        $mem = Common_Db_memcached::getInstance();
        dump($mem->add('a', 1, 60));
        dump($mem->add('a', 2, 60));

        dump($_SERVER ['DOCUMENT_ROOT']);
        // $lock = Common_Util_LockMemcache::newlock ( 'aaaa' );
        // dump ( $lock->lock ( 60 ) );

        // $locka = Common_Util_LockMemcache::newlock ( 'aaaa' );
        // dump ( $locka->lock ( 60 ) );

        // Common_Util_Configdata::getInstance ()->buildconfigdata ( configdata_item_building_setting::class, "id" );
        // $value = Common_Util_Configdata::getInstance ()->get_global_config ( "ROLE_CREATE_DIAMOND" );
        // dump ( $value );
    }


}