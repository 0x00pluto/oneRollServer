<?php

namespace servicemiddle;

use Common\Util\Common_Util_ReturnVar;
use dbs\gmtools\dbs_gmtools_allowips;
use err\err_dbs_gmtools_manager_base;
use hellaEngine\interfaces\service\middleWare;
use utilphp\util;

class servicemiddle_gmallowip implements middleWare
{
    /**
     *
     * {@inheritDoc}
     *
     * @see \hellaEngine\interfaces\service\middleWare::handle()
     */
    public function handle(array $context, \Closure $next)
    {
        $allDatas = dbs_gmtools_allowips::all([
            dbs_gmtools_allowips::DBKey_ipaddress => util::get_client_ip()
        ]);

        if (count($allDatas) == 0) {

            return Common_Util_ReturnVar::RetFail(err_dbs_gmtools_manager_base::NOT_ALLOW_IP,
                ['ip' => util::get_client_ip()]
                , 'NOT_ALLOW_IP');
        }
        return $next ($context);
    }
}