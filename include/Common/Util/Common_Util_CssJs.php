<?php
namespace Common\Util;
/**
 * @package common
 * @subpackage util
 * @author kain
 *
 */
/**
 *  1.拼接css/js相关html
 *  2.分析css/js版本号
 *  3.分析js依赖关系
 */

class Common_Util_CssJs
{
    /**
     * get html from css list
     */
    public static function getCssHtml(array $list)
    {
        $html = "";
        if(count($list) > 0)
        {
            $html = implode("\n", array_map(array(self, "cssParser"), array_values(self::version($list, "css"))));
        }
        return $html;
    }

    /**
     * get html from js list
     * @param $deferred 确定文件是否可以延迟加载（可以延迟加载的放在尾部，其余的放在头部）
     */
    public static function getJsHtml(array $list, $deferred = false)
    {
        $html = "";
        if(count($list) > 0)
        {
            if($deferred === false)
            {
                // 头部拼接方式（只需要版本号，不分析依赖关系）
                $html = implode("\n", array_map(array(self, "jsParser"), array_values(self::version($list))));
            }
            else
            {
                // 尾部js分析依赖关系
                $dependency = self::getDependency(array_unique($list));

                // 拼接尾部js三要素：异步依赖关系、异步调用js版本号、同步调用js列表
                $html .= "<script type=\"text/javascript\">\n";
                $html .= "K.Resource.addResourceDepends(".json_encode($dependency["asyncDepends"]).");\n";
                $html .= "K.Resource.addResourceMap(".json_encode(self::version($dependency["async"])).");\n";
                $html .= implode("\n", array_map(array(self, "deferredJsParser"), array_values(self::version($dependency["sync"]))));
                $html .= "\n</script>";
            }
        }
        return $html;
    }

    /**
     * tag js css list with version info
     */
    private static function version($list, $type = "js")
    {
        // js versioned list
        $versionedList = array();

        // 逐个文件标记版本号
        $postfix = $type === "js" ? ".js" : ".css";
        $versionConfig = $type === "js" ? Common_Conf_JsVersion::$versions : Common_Conf_CssVersion::$versions;
        foreach($list as $item)
        {
            $version = 0;
            if(isset($versionConfig[$item]))
            {
                $version = $versionConfig[$item];
            }
            $part = explode($postfix, $item);
            if(count($part) === 2 && $part[1] === '') { // 只给.js结尾的文件加版本号
                $name = $part[0];
                $versionCode = sprintf("%04d", intval($version)).substr(md5(SYS_CODE.intval($version).$name), 0, 5);
                $versionedList[$name] = $name."-".$versionCode.$postfix;
            } else {
                $versionedList[$item] = $item;
            }
        }
        return $versionedList;
    }

    /**
     * get js dependencies
     */
    private static function getDependency($list)
    {
        $dependsConfig = Common_Conf_JsDepend::$depends;

        // 同步依赖关系分析
        $dependsData = array(
            "loaded" => array(),            // 已经分析过依赖关系的js list
            "toload" => $list,              // 待分析的js list
            "async" => array(),             // 分析获得的初步异步加载关系
        );
        self::getCyclicDependency(&$dependsData, $dependsConfig);

        // 异步依赖关系分析
        $asyncDependsData = array(
            "loaded" => array(),            // 已经分析过的异步依赖关系的js list
            "toload" => $dependsData["async"],  // 待分析的js list
            "depends" => array(),           // 分析获得的异步依赖关系
        );
        self::getCyclicAsyncDependency(&$asyncDependsData, $dependsConfig);

        return array(
            "sync" => $dependsData["loaded"],
            "async" => $asyncDependsData["loaded"],
            "asyncDepends" => $asyncDependsData["depends"],
        );
    }

    /*
     * get js cyclic dependency
     */
    private static function getCyclicDependency(array $depends, array $dependencyConfig)
    {
        while($item = array_pop($depends["toload"]))
        {
            if(!in_array($item, $depends["loaded"])) // 分析还未被分析的js，防止死循环
            {
                if(isset($dependencyConfig[$item]))
                {
                    $configDepends = $dependencyConfig[$item];

                    // 获取同步js依赖
                    if(isset($configDepends["sync"]))
                    {
                        $depends["toload"] = array_merge($configDepends["sync"], $depends["toload"]);
                    }

                    // 获取异步依赖
                    if(isset($configDepends["async"]))
                    {
                        $depends["async"] = array_merge($depends["async"], $configDepends["async"]);
                    }
                }
                $depends["loaded"][] = $item;
            }
        }
    }

    /**
     * get js cylic async dependency
     */
    private static function getCyclicAsyncDependency(array $depends, array $dependencyConfig)
    {
        while($item = array_pop($depends["toload"]))
        {
            if(!in_array($item, $depends["loaded"])) // 分析还未被分析的js，防止死循环
            {
                if(isset($dependencyConfig[$item]))
                {
                    $configDepends = $dependencyConfig[$item];

                    // 获取同步依赖
                    if(isset($configDepends["sync"]))
                    {
                        $depends["toload"] = array_merge($configDepends["sync"], $depends["toload"]);

                        // 同步依赖关系，需要将depends单独记录，Haibei框架需要这样的依赖关系来加载异步js
                        $depends["depends"][$item] = $configDepends["sync"];
                    }

                    // 获取异步依赖
                    if(isset($configDepends["async"]))
                    {
                        $depends["toload"] = array_merge($configDepends["async"], $depends["toload"]);
                    }
                }
                $depends["loaded"][] = $item;
            }
        }
    }

    /**
     * single css file html parser
     */
    private static function cssParser($css)
    {
        $host = strpos($css, 'http://') === 0 ? '' : "http://" . CSS_HOST;
        return "<link href=\"".$host.$css."\" rel=\"stylesheet\" type=\"text/css\" />";
    }

    /**
     * single js file html parser
     */
    private static function jsParser($js)
    {
        $host = strpos($js, 'http://') === 0 ? '' : "http://" . JS_HOST;
        return "<script src=\"".$host.$js."\" type=\"text/javascript\"></script>";
    }

    /**
     * single deferred js file html parser
     */
    private static function deferredJsParser($js)
    {
        $host = strpos($js, 'http://') === 0 ? '' : "http://" . JS_HOST;
        return "K.Resource.loadJS(\"".$host.htmlspecialchars($js)."\");";
    }
}
?>