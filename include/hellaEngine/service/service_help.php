<?php

namespace hellaEngine\service;

use Common\Db\Common_Db_memcached;
use Common\Util\Common_Util_Reference;
use constants\constants_helpdocs;

/**
 * 助手函数
 * Class service_help
 * @package hellaEngine\service
 */
class service_help extends service_base
{

    /**
     * @inheritDoc
     */
    protected function configureFunctions()
    {
        $this->addFunction('help', true);
    }

    /**
     * 剔除一些公共服务
     * @var array
     */
    protected $skipfileShortname = array(
        'service_base',
        'service_Base',
        'service_help',
        'service_gateway',
        'service_functiondata'
    );

    /**
     * 递归生成说明文档
     * @param string $path
     * @return array
     */
    private function traverse($path = '.')
    {
        // 跳过文件短名称
        $skipfileShortname = $this->skipfileShortname;

        $outputstring = "";

        $arr = array();

        $current_dir = opendir($path); // opendir()返回一个目录句柄,失败返回false
        while (($file = readdir($current_dir)) !== false) { // readdir()返回打开目录句柄中的一个条目
            $sub_dir = $path . DIRECTORY_SEPARATOR . $file; // 构建子目录路径
            if ($file == '.' || $file == '..') {
                continue;
            } else if (is_dir($sub_dir)) { // 如果是目录,进行递归
                echo 'Directory ' . $file . ':<br>';
            } else { // 如果是文件,直接输出
                $shortname = basename($file, ".php");
                if (in_array($shortname, $skipfileShortname)) {
                    continue;
                }
                $shortname = substr($shortname, 8);

                // dump ( $shortname );
                // break;

                $service = array();
                $outputstring .= '<br>';

                $classname = C(\configure_constants::APP_NAMESPACE) . '\service\service_' . $shortname;

                $ref = new \ReflectionClass ($classname);
                // 虚类
                if ($ref->isAbstract()) {
                    continue;
                }
                $outputstring .= '<font color="#006600">' . $ref->getDocComment() . '</font><br>';

                $outputstring .= '<font color="#FF0000">' . $shortname . '</font><br>';

                $service [constants_helpdocs::CLASSNAME] = $classname;
                $service [constants_helpdocs::SHORT_CLASSNAME] = $shortname;
                $service [constants_helpdocs::DOCCOMMENTS] = $ref->getDocComment();
                $classins = service_builder::o()->create($classname);

                if ($classins instanceof service_base && $classins->getEnable()) {

                    $service [constants_helpdocs::SERVICES] = $this->createHelpDocument($classins);
                    $arr [$classname] = $service;
                }
            }
        }


        return $arr;
    }


    /**
     * 生成对应的说明文档
     * @param service_base $service
     * @return array
     */
    private function createHelpDocument(service_base $serviceInstance)
    {
        $arr = array();
        if (C(\configure_constants::DEBUG)) {

            $refclass = new \ReflectionClass (get_class($serviceInstance));
            $classname = $refclass->getName();
            $shortclassname = $refclass->getShortName();
            // 类真实名称
            $classrealname = explode("_", $shortclassname) [1];

            $arr [constants_helpdocs::CLASSNAME] = $classname;
            $arr [constants_helpdocs::SHORT_CLASSNAME] = $shortclassname;

            $services = array();

            $description = '<br>';

            foreach ($serviceInstance->getFunctions() as $methodname => $value) {
                if ($methodname != 'help') {
                    $service = array();

                    // dump ( $methodname );
                    $propertys = $refclass->getMethod($methodname);
                    $description .= "<font color=\"#009900\">" . $propertys->getDocComment();
                    $service [constants_helpdocs::DOCCOMMENTS] = $propertys->getDocComment();
                    $service [constants_helpdocs::SERVICE_DATA] = $value;
                    // retCode Name
                    // 通过函数名称自动拼接
                    $retCode_contants = NULL;
                    $retCodeAutoClassname = C(\configure_constants::APP_NAMESPACE) . "\\err\\err_" . $shortclassname . "_" . $methodname;

                    // 具体错误的类
                    $err_classname_prefix = $serviceInstance->get_err_class_name();
                    if (!empty ($err_classname_prefix)) {
                        $err_classname = $err_classname_prefix . $methodname;
                        if (class_exists($err_classname) || interface_exists($err_classname)) {

                            $ref_retCode = new \ReflectionClass ($err_classname);
                            $retCode_contants = $ref_retCode->getConstants();
                        }
                    }
                    if (is_null($retCode_contants)) {
                        if (class_exists($retCodeAutoClassname) || interface_exists($retCodeAutoClassname)) {
                            $ref_retCode = new \ReflectionClass ($retCodeAutoClassname);
                            $retCode_contants = $ref_retCode->getConstants();
                        } else {
                            // 查找对应的dbs寻找返回值
                            $retCodedbsClassname = C(\configure_constants::APP_NAMESPACE) . "\\err\\err_" . "dbs_" . $classrealname . "_" . $methodname;
                            if (class_exists($retCodedbsClassname)) {
                                $ref_retCode = new \ReflectionClass ($retCodedbsClassname);
                                $retCode_contants = $ref_retCode->getConstants();
                            }
                        }
                    }
                    if (!is_null($retCode_contants)) {

                        $constants_comments = Common_Util_Reference::getConstDocument($ref_retCode->getShortName());
                        $description .= "<br>";
                        $retcodeString = "";
                        foreach ($retCode_contants as $key => $value_info) {

                            if (isset ($constants_comments [$key])) {
                                $retcodeString .= $constants_comments [$key] . "<br>";
                            }
                            $retcodeString .= "YYNet_" . $shortclassname . "_" . $propertys->name . "_RetCode." . $key . "=" . $value_info . "<br>";
                        }
                        $description .= $retcodeString;

                        $service [constants_helpdocs::RETCODECOMMENTS] = $retcodeString;

                    }

                    $description .= "</font><br>";

                    $description .= "<font color=\"#FF0000\">function " . $propertys->name . '(';
                    $service [constants_helpdocs::FUNCTIONNAME] = $propertys->name;
                    $params = array();
                    // $service [constants_helpdocs::FUNCTIONPARAMS] = $propertys->getParameters ();
                    foreach ($propertys->getParameters() as $ParameterValue) {
                        $description .= $ParameterValue->name . ',';
                        $params [] = $ParameterValue->name;
                    }
                    $service [constants_helpdocs::FUNCTIONPARAMS] = $params;

                    if (count($propertys->getParameters()) > 0) {
                        $description = substr($description, 0, -1);
                    }
                    $description .= ')</font><br><br>';

                    $services [$service [constants_helpdocs::FUNCTIONNAME]] = $service;
                }
            }

            $arr [constants_helpdocs::SERVICES] = $services;
        }
        return $arr;
    }


    public function help()
    {
        $path = C(\configure_constants::APP_PATH) . '/service';
        $services = $this->traverse($path);
        sort($services);
        $this->createHtmlDocments($services);
    }

    /**
     * 生成Html页面
     * @param $services
     */
    private function createHtmlDocments($services)
    {
        $documentDIR = $_SERVER ['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "tmp";

        if (!is_dir($documentDIR)) {
            mkdir($documentDIR, 0775, true);
        }
        $app_namespace = C(\configure_constants::APP_NAMESPACE);
        $app_namespace = strtr($app_namespace, "\\", "_");

        $shorthtmlfilename = "/tmp/documents" . $app_namespace . ".html";

        $htmlfilename = $_SERVER ['DOCUMENT_ROOT'] . $shorthtmlfilename;

        $handle = fopen($htmlfilename, "w");
        if (!$handle) {
            dump("open:" . $htmlfilename . " error!");
            return;
        }

        $contents = "<html>\n";
        $contents .= '<head><title>餐厅服务器API文档</title>';
        $contents .= '<style type="text/css">
a:link,a:visited{
 text-decoration:none;  /*超链接无下划线*/
}
a:hover{
 text-decoration:underline;  /*鼠标放上去有下划线*/
}
</style>';
        $contents .= '</head>';
        $contents .= "<body>\n";
        $contents .= '<h1>夺宝API文档 </h1>';
        $contents .= '<h2>生成日期:' . date("c") . '</h2>';

        $contents .= '<h3>通过调用 <a href=http://' . $_SERVER ['HTTP_HOST'] . '/test.php?functionname=help.help&backurl=' . $shorthtmlfilename . '>help.help</a> 生成</h3>';
        $contents .= '<h3>通过调用 <a href=http://' . $_SERVER ['HTTP_HOST'] . '/test.php?functionname=help.dumpcode&backurl=' . $shorthtmlfilename . '>help.dumpcode</a> 生成客户端代码 <a href=http://' . $_SERVER ['HTTP_HOST'] . '/lua_code/lua_code.zip>接口代码下载</a></h3>';

        $contents .= '<hr/>';
        // backurl
        // http://' . $_SERVER ['HTTP_HOST'] . '/test.php?

        $tables = "<table border=\"0\">";
        $tables .= "<tr>";
        $tables .= "<th>接口名称</th>";
        $tables .= "<th>接口描述</th>";
        $tables .= "<th>接口名称</th>";
        $tables .= "<th>接口描述</th>";
        $tables .= "<th>接口名称</th>";
        $tables .= "<th>接口描述</th>";

        $tables .= "</tr>";

        $servicecount = count($services) / 3;

        for ($i = 0; $i < $servicecount; $i++) {

            $value = $services [$i * 3];
            $nextvalue = isset ($services [$i * 3 + 1]) ? $services [$i * 3 + 1] : null;
            $thirdnextvalue = isset ($services [$i * 3 + 2]) ? $services [$i * 3 + 2] : null;

            if ($i % 2 == 0) {
                $bgcolor = '"#FFFFFF"';
            } else {
                $bgcolor = '"#CCCCCC"';
            }

            $tables .= "<tr bgcolor=" . $bgcolor . ">";

            $key = $value [constants_helpdocs::CLASSNAME];
            $tables .= "<td height=\"30\"><font color=\"#FF0000\"><a href=\"#" . $key . "\">" . $value [constants_helpdocs::SHORT_CLASSNAME] . "</a></font></td>";
            $tables .= "<td height=\"30\"><font color=\"#006600\">" . $value [constants_helpdocs::DOCCOMMENTS] . "</font></td>";

            if (!is_null($nextvalue)) {
                $key = $nextvalue [constants_helpdocs::CLASSNAME];
                $tables .= "<td height=\"30\"><font color=\"#FF0000\"><a href=\"#" . $key . "\">" . $nextvalue [constants_helpdocs::SHORT_CLASSNAME] . "</a></font></td>";
                $tables .= "<td height=\"30\"><font color=\"#006600\">" . $nextvalue [constants_helpdocs::DOCCOMMENTS] . "</font></td>";
            }
            if (!is_null($thirdnextvalue)) {
                $key = $thirdnextvalue [constants_helpdocs::CLASSNAME];
                $tables .= "<td height=\"30\"><font color=\"#FF0000\"><a href=\"#" . $key . "\">" . $thirdnextvalue [constants_helpdocs::SHORT_CLASSNAME] . "</a></font></td>";
                $tables .= "<td height=\"30\"><font color=\"#006600\">" . $thirdnextvalue [constants_helpdocs::DOCCOMMENTS] . "</font></td>";
            }
            $tables .= "</tr>";
        }

        $tables .= "</table>";
        $contents .= $tables;

        // 具体服务信息
        foreach ($services as $value) {

            $key = $value [constants_helpdocs::CLASSNAME];

            $contents .= '<hr/><h1>';
            $contents .= '<a name="' . $key . '" href="#" >' . $key . '</a>';
            $contents .= '    <a href="#" >返回头部</a>';
            $contents .= '    <a href=http://' . $_SERVER ['HTTP_HOST'] . '/test.php?functionname=help.help&backurl=' . $shorthtmlfilename . '#' . $key . '>刷新接口</a>';
            $contents .= '</h1>';

            $contents .= '<h2>' . $value [constants_helpdocs::DOCCOMMENTS] . '</h2>';

            $testfunctionservername = $value [constants_helpdocs::SHORT_CLASSNAME];

            $service_table = "<table border=\"1\">";
            $service_table .= "<tr>";
            $service_table .= "<th>函数名称</th>";
            $service_table .= "<th>函数描述</th>";
            $service_table .= "<th>返回值描述</th>";
            $service_table .= "<th>是否是测试函数</th>";
            $service_table .= "</tr>";

            $functionservice = $value [constants_helpdocs::SERVICES] [constants_helpdocs::SERVICES];
            foreach ($functionservice as $functionname => $value) {

                $params = implode(",", $value [constants_helpdocs::FUNCTIONPARAMS]);

                // dump ( $_SERVER );
                $testfunctionname = $testfunctionservername . '.' . $functionname;

                $postparams = "";
                foreach ($value [constants_helpdocs::FUNCTIONPARAMS] as $value1) {
                    $postparams .= $value1 . "%3d%3f%26";
                }

                if (strlen($postparams) > 0) {
                    $postparams = substr($postparams, 0, strlen($postparams) - 3);
                    // dump ( $postparams );
                }

                // htmlspecialchars_decode($string)
                // htmlspecialchars($string)

                $service_functiondata = new service_basecallablefunctiondata ();
                $service_functiondata->fromArray($value [constants_helpdocs::SERVICE_DATA]);

                $hrefparams = 'functionname=' . $testfunctionname;
                $hrefparams .= '&params=' . ($postparams);
                $service_table .= "<tr >";
                $service_table .= '<td><font color="#FF0000"><a target="_blank" href="http://' . $_SERVER ['HTTP_HOST'] . '/test.php?' . $hrefparams . '">' . $functionname . " (" . $params . ")</a></font></td>";
                $service_table .= "<td><font color=\"#006600\">" . str_replace("\n", "<br>", $value [constants_helpdocs::DOCCOMMENTS]) . "</font></td>";

                if (isset ($value [constants_helpdocs::RETCODECOMMENTS])) {
                    $service_table .= "<td><font color=\"#006600\">" . $value [constants_helpdocs::RETCODECOMMENTS] . "</font></td>";
                } else {
                    $service_table .= "<td><font color=\"#006600\">暂无说明</font></td>";
                }
                if ($service_functiondata->get_isDebugFunction()) {
                    $service_table .= "<td><font color=\"#FF0000\">是</font></td>";
                } else {
                    $service_table .= "<td><font color=\"#006600\">否</font></td>";
                }
                $service_table .= "</tr>";
            }

            $service_table .= "</table>";
            $service_table .= '<hr/>';
            $service_table .= "<br><br><br><br><br><br><br>";

            $contents .= $service_table;
        }

        $contents .= "</body>\n";
        $contents .= "</html>";

        fputs($handle, $contents);
        fclose($handle);

        $a = '<a href=".' . $shorthtmlfilename . '" target="_blank">说明文档 移步这里</a><br>';
        echo($a);
    }
}