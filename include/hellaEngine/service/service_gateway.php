<?php

namespace hellaEngine\service;

use Common\Util\Common_Util_Log;
use Common\Util\Common_Util_Message;
use Common\Util\Common_Util_ReturnVar;
use Common\Util\MissingArgumentException;
use hellaEngine\err\err_service_gateway_call;
use hellaEngine\exception\exception_logicError;
use hellaEngine\exception\exception_logicSucc;
use hellaEngine\interfaces\interfaces_call;

/**
 * 接口类,本类的生命周日,应该等于页面逻辑调用的生命周期
 *
 * @author zhipeng
 *
 */
class service_gateway implements interfaces_call
{
    private $serviceCache = [];

    /**
     *
     * {@inheritDoc}
     *
     * @see \hellaEngine\interfaces\interfaces_call::call_before()
     */
    function call_before()
    {
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \hellaEngine\interfaces\interfaces_call::call_after()
     */
    function call_after()
    {
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \hellaEngine\interfaces\interfaces_call::call_end()
     */
    function call_end()
    {
    }

    /**
     * 服务类名前缀
     *
     * @return string
     */
    protected function get_service_classprefix()
    {
        return C(\configure_constants::APP_NAMESPACE) . "\\service\\service_";
    }

    /**
     * command is array:
     * {
     * cmd:function name
     * cmdid:command order id,++
     * params:{
     * key:value,
     * key1:value1
     * ......
     * }
     * @param service_gatewaydata $command
     * @return Common_Util_ReturnVar|mixed
     */
    function call(service_gatewaydata $command)
    {
        $cmd = $command->get_command();
        $cmdId = $command->get_commandid();
        $params = $command->get_params();
        $verify = $command->get_verify();

        $cmdclassname = $command->get_command_classname();
        $cmdmethodname = $command->get_command_methodname();

        // 转换类名
        $className = $this->get_service_classprefix() . $cmdclassname;
        // 函数名称
        $classFunctionName = $cmdmethodname;
        // 函数返回

        // 服务不存在
        if (!class_exists($className)) {
            // 如果是help函数,重定向到引擎里面
            // 业务App没有重载service_help,这里也让他使用,所以需要一个重定向
            if ($cmdclassname === 'help') {
                $className = '\hellaEngine\service\service_' . $cmdclassname;
            } else {

                $functionRet = Common_Util_ReturnVar::RetFail(err_service_gateway_call::SERVICE_CLASS_NOT_FOUND,
                    "SERVICE_CLASS_NOT_FOUND",
                    'SERVICE_CLASS_NOT_FOUND');
                goto end;
            }
        }
        //接口实例是从缓存中获取的
        $classForCache = false;
        if (isset ($this->serviceCache [$className])) {
            $classIns = $this->serviceCache [$className];
            $classForCache = true;
        } else {
            // 类实例
            $classIns = new $className ();
            $this->serviceCache [$className] = $classIns;
        }

        if (!$classIns instanceof service_base) {
            $functionRet = Common_Util_ReturnVar::RetFail(
                err_service_gateway_call::SERVER_CLASS_TYPE_ERROR,
                "SERVER_CLASS_TYPE_ERROR",
                'SERVER_CLASS_TYPE_ERROR');
            goto end;
        }
        if (!$classForCache) {
            $classIns->bootstrap();
        }

        if (!$classIns->isFunctionEnabled($classFunctionName)) {
            $functionRet = Common_Util_ReturnVar::RetFail(
                err_service_gateway_call::NO_CALLABLE,
                'no callable'
                , 'NO_CALLABLE');

            goto end;
        }

        $functionRet = $this->serviceCallable($classIns, $command);
        if ($functionRet->is_failed()) {
            goto end;
        }

        try {
            $functionRet = $classIns->callFunction($classFunctionName, $params);
        } catch (MissingArgumentException $e) {
            $functionRet = Common_Util_ReturnVar::RetFail(
                err_service_gateway_call::ARGUMENT_ERROR,
                "MissingArgumentException\n" .
                $e->getMessage(), "ARGUMENT_ERROR");
        } catch (exception_logicError $e) {
            $functionRet = $e->getRetData();
        } catch (exception_logicSucc $e) {
            $functionRet = $e->getRetData();
        } catch (\Exception $e) {

            Common_Util_Log::record_error('callFunction Error',
                [
                    'functionName' => $cmd,
                    'params' => $params,
                    'e' => $e->getMessage()
                ]);
        } finally {

        }

        end:
        // 释放类实例
//        unset ($classIns);

        if (is_null($functionRet)) {
            $functionRet = [];
        } else {
            $functionRet = $functionRet->to_Array();
        }

        $functionRet [Common_Util_Message::DBKey_cmd] = $cmd;
        $functionRet [Common_Util_Message::DBKey_cmdid] = $cmdId;

        return $functionRet;
    }

    /**
     * 是否可以调用接口
     *
     * @param service_base $classIns
     *            接口类的实例
     * @param service_gatewaydata $command
     *            命令关键字
     * @return Common_Util_ReturnVar
     */
    protected function serviceCallable(service_base $classIns, service_gatewaydata $command)
    {
        return Common_Util_ReturnVar::RetSucc();
    }
}
