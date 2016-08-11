<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/8/11
 * Time: 下午2:23
 */

namespace servicemiddle;


use Common\Util\Common_Util_ReturnVar;
use err\err_dbs_gmtools_manager_base;
use hellaEngine\interfaces\service\middleWare;
use utilphp\util;

class servicemiddle_localrun implements middleWare
{
    function handle(array $context, \Closure $next)
    {

        if (isset($_SERVER['REMOTE_ADDR'])) {
            return Common_Util_ReturnVar::RetFail(err_dbs_gmtools_manager_base::NOT_ALLOW_IP,
                ['ip' => util::get_client_ip()]
                , 'NOT_ALLOW_REMOTE_RUN');
        }
        return $next ($context);
    }

}