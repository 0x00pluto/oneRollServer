<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/8/11
 * Time: 上午11:30
 */

namespace servicemiddle;


use Common\Util\Common_Util_Ip;
use Common\Util\Common_Util_ReturnVar;
use err\err_dbs_gmtools_manager_base;
use hellaEngine\interfaces\service\middleWare;
use utilphp\util;

class servicemiddle_iplimits implements middleWare
{


    /**
     * ip 允许列表
     * @var array
     */
    private $IPAllows;

    /**
     * servicemiddle_iplimits constructor.
     * @param array $IPAllows
     */
    public function __construct(array $IPAllows)
    {
        $this->IPAllows = $IPAllows;
    }

    function handle(array $context, \Closure $next)
    {

        $ipUtils = new Common_Util_Ip();

        if (isset($_SERVER['REMOTE_ADDR']) && !$ipUtils->checkIpEx(util::get_client_ip(), $this->IPAllows)) {
            return Common_Util_ReturnVar::RetFail(err_dbs_gmtools_manager_base::NOT_ALLOW_IP,
                ['ip' => util::get_client_ip()]
                , 'NOT_ALLOW_IP');
        }
        return $next ($context);
    }

}