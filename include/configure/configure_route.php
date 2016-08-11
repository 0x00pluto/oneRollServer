<?php
if (!function_exists('app_route')) {
    /**
     * 应用程序路由
     */
    function app_route()
    {
        $routes = [
            "api1.cooking.com" => "",
            "api.cooking.com" => "",
            "apiphone.cooking.com" => "",
            "apiphone1.cooking.com" => "",
            "oneroll.tomatofuns.com" => "",
            "gmtools.tomatofuns.com" => "",
            "test.tomatofuns.com" => "",
        ];

//        echo $routes [$_SERVER ['HTTP_HOST']];
        if (empty($_SERVER ['HTTP_HOST'])) {
            $_SERVER ['HTTP_HOST'] = "oneroll.tomatofuns.com";
            C(configure_constants::APP_NAMESPACE, "");
        } elseif (isset ($routes [$_SERVER ['HTTP_HOST']])) {
            C(configure_constants::APP_NAMESPACE, $routes [$_SERVER ['HTTP_HOST']]);
        } else {
            throw(new RuntimeException("no found app route:" . $_SERVER ['HTTP_HOST']));
        }
    }

    app_route();
}