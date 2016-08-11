<?php

namespace hellaEngine\service;

use Common\Util\Common_Util_Functions;
use hellaEngine\interfaces\service\middleWare;

/**
 * 服务基类
 *
 * @author zhipeng
 *
 */
abstract class service_base
{

    /**
     * 服务是否可用
     * @var boolean
     */
    private $enable = true;

    /**
     * 整个接口是否可用
     * @return boolean
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * 设置服务是否可用
     * @param mixed $enable
     */
    protected function setEnable($enable)
    {
        $this->enable = $enable;
    }


    /**
     * 服务借口列表
     *
     * @var array
     */
    private $functions = [];

    /**
     * 开启服务
     *
     * @param array $functionNames
     *            可用的服务名
     * @param bool $isDebugFunction 是否是测试函数
     * @return bool
     */
    protected function addFunctions(array $functionNames, $isDebugFunction = FALSE)
    {
        if (empty ($functionNames)) {
            return false;
        }
        foreach ($functionNames as $value) {
            $this->addFunction($value, $isDebugFunction);
        }
        return true;
    }


    /**
     * 添加可用接口
     *
     * @param string $functionName
     * @param bool $isDebugFunction
     * @return bool
     */
    protected function addFunction($functionName, $isDebugFunction = FALSE)
    {
        if (!is_string($functionName)) {
            return false;
        }
        if ($this->isFunctionEnabled($functionName)) {
            return true;
        }
        // 发行版测试函数不让调用
        if (!C(\configure_constants::DEBUG, null, false) && $isDebugFunction) {
            return true;
        }
        $data = new service_basecallablefunctiondata ();
        $data->set_functionname($functionName);
        $data->set_isDebugFunction($isDebugFunction);

        $this->functions [$data->get_functionname()] = $data->toArray();
        return true;
    }

    /**
     * 添加测试函数
     * @param $functionName
     */
    protected function addTestFunction($functionName)
    {
        $this->addFunction($functionName, true);
    }

    /**
     * 获取导出函数列表
     * @return array
     */
    public function getFunctions()
    {
        return $this->functions;
    }

    /**
     * 服务是否可用
     *
     * @param string $functionName
     *            服务器名称,函数名
     * @return boolean 是否可用
     */
    public function isFunctionEnabled($functionName)
    {
        if (empty ($functionName)) {
            return false;
        }
        return isset ($this->functions [$functionName]);
    }

    /**
     * 一次接口调用之前执行
     * @param $functionName
     * @param array $params
     */
    protected function callFunctionBefore($functionName, $params = [])
    {

    }

    /**
     * 一次接口调用之后执行
     * @param $functionName
     * @param array $params
     */
    protected function callFunctionAfter($functionName, $params = [])
    {

    }


    /**
     * 调用服务
     *
     * @param string $functionName
     *            服务名称
     * @param array $params
     * @return mixed
     */
    public function callFunction($functionName, $params = [])
    {
        //服务本身不可用
        if (!$this->getEnable()) {
            return false;
        }
        if (!$this->isFunctionEnabled($functionName)) {
            return false;
        }
        $callFunction = $this->createMiddleFunction();
        $context = [
            middleWare::contextFunctionName => $functionName,
            middleWare::contextParams => $params
        ];
        $callReturn = $callFunction ($context);
        return $callReturn;
    }

    /**
     * 创建中间层链式闭包回调
     *
     * @return \Closure
     */
    private function createMiddleFunction()
    {
        if (empty ($this->middleWares)) {
            //没有中间层
            return function ($context) {

                $this->callFunctionBefore($context [middleWare::contextFunctionName],
                    $context [middleWare::contextParams]);
                try {
                    $callReturn = Common_Util_Functions::call_class_func_named_object_array(static::class, $context ['functionName'], $this, $context ['params']);
                } catch (\Exception $e) {
                    $this->callFunctionAfter($context [middleWare::contextFunctionName],
                        $context [middleWare::contextParams]);
                    throw $e;
                }
                $this->callFunctionAfter($context [middleWare::contextFunctionName],
                    $context [middleWare::contextParams]);

                return $callReturn;
            };
        } else {
            //有中间层,先调用中间层函数
            return function ($context) {
                /**
                 * @var middleWare $middleWare
                 */
                $middleWare = array_shift($this->middleWares);
                return $middleWare->handle($context, $this->createMiddleFunction());
            };
        }
    }

    /**
     * 获取db实例
     *
     * @return mixed
     */
    protected function get_dbins()
    {
    }

    /**
     * 获取错误类名,助手方法,例如
     * "err_dbs_push_"
     */
    protected function get_err_class_name()
    {
        return "";
    }


    /**
     * 所有的中间件
     * @var middleWare[] $middleWares
     */
    private $middleWares = [];

    /**
     * 注册中间件
     * @param middleWare $middleWare
     */
    public function registerMiddleWare(middleWare $middleWare)
    {
        $this->middleWares [get_class($middleWare)] = $middleWare;
    }

    /**
     * 配置接口函数
     */
    protected function configureFunctions()
    {

    }

    /**
     * 启动,初始化配置
     */
    protected function configure()
    {
    }

    /**
     * 启动初始化
     */
    final public function bootstrap()
    {
        $this->configureFunctions();
        $this->configure();
    }


}