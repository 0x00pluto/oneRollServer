<?php

namespace service;

use Common\Util\Common_Util_Log;
use Common\Util\Common_Util_ReturnVar;
use constants\constants_serverVersion;
use dbs\dbs_player;
use err\err_service_gateway;
use hellaEngine\err\err_service_gateway_call;
use hellaEngine\service\service_base as hellaServiceBase;
use hellaEngine\service\service_gatewaydata;

/**
 * 接口类,本类的生命周日,应该等于页面逻辑调用的生命周期
 *
 * @author zhipeng
 *
 */
class service_gateway extends \hellaEngine\service\service_gateway
{
    function call_end()
    {
        // 释放用户池
        dbs_player::disposeAllPlayer();
    }

    function call_after()
    {
        // 释放用户池
        dbs_player::disposeAllGuestPlayer();
    }

    /**
     * @param hellaServiceBase $classIns
     * @param service_gatewaydata $command
     * @return Common_Util_ReturnVar
     */
    protected function serviceCallable(hellaServiceBase $classIns, service_gatewaydata $command)
    {
        if ($classIns instanceof service_base &&
            $command instanceof \service\service_gatewaydata
        ) {

            // 是否需要登陆调用接口
            $isNeedLogin = $classIns->isNeedLogin();

            //客户端版本号
            $clientVersion = $command->get_clientVersion();

            if (!empty($clientVersion)) {
                if (strcmp($clientVersion, constants_serverVersion::SUPPORT_MIN_CLIENT_VERSION) < 0) {
                    Common_Util_Log::record_error("SUPPORT_MIN_CLIENT_VERSION", [$clientVersion]);
                    return Common_Util_ReturnVar::RetFail(err_service_gateway_call::NONSUPPORT_CLIENT_VERSION,
                        'NONSUPPORT_CLIENT_VERSION',
                        'NONSUPPORT_CLIENT_VERSION');
                }
            } else {

                Common_Util_Log::record_error("SUPPORT_MIN_CLIENT_VERSION", [$clientVersion]);

                return Common_Util_ReturnVar::RetFail(err_service_gateway_call::NONSUPPORT_CLIENT_VERSION,
                    'NONSUPPORT_CLIENT_VERSION',
                    'NONSUPPORT_CLIENT_VERSION');
            }

            //处理帮助函数
            if (C(\configure_constants::DEBUG) && $command->get_command_classname() === 'help') {
                $isNeedLogin = false;
            }
            // 需要登陆调用
            if ($isNeedLogin) {
                $verify = $command->get_verify();
                if (!empty ($verify)) {
                    $userid = dbs_player::getUseridFromCache($verify, true);
                    if ($userid === false) {
                        // 没有找到用户
                        return Common_Util_ReturnVar::RetFail(err_service_gateway_call::VERIFY_IS_ERROR,
                            'verify is error',
                            'VERIFY_IS_ERROR');
                    } else {

                        $userIns = dbs_player::newMasterPlayer($userid);
                        //账户不存在
                        if (!$userIns->isAccountExists()) {
                            return Common_Util_ReturnVar::RetFail(err_service_gateway_call::USER_DATA_ERROR,
                                'user data error',
                                'USER_DATA_ERROR');
                        }
                        //角色不存在
                        if ($classIns->isNeedRole() && !$userIns->isRoleExists()) {
                            return Common_Util_ReturnVar::RetFail(err_service_gateway::NOT_EXISTS_ROLE,
                                "NOT_EXISTS_ROLE",
                                'NOT_EXISTS_ROLE');
                        }
                        // 找到目标用户
                        $classIns->setCallerUserInstance($userIns);
                    }
                } else {
                    return Common_Util_ReturnVar::RetFail(err_service_gateway_call::VERIFY_IS_EMPTY,
                        'no verify',
                        'VERIFY_IS_EMPTY');
                }
            }
        }
        return parent::serviceCallable($classIns, $command);
    }
}