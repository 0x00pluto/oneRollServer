<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/12/1
 * Time: 下午5:58
 */

namespace hellaEngine\exception;

use Common\Util\Common_Util_ReturnVar;


/**
 * Class exception_logicSucc
 * @package hellaEngine\exception
 */
class exception_logicSucc extends \LogicException
{
    private $Data = [];

    /**
     * exception_logicSucc constructor.
     * @param array $Data
     * @param string $String
     * @param int $Code
     */
    public function __construct(array $Data = [], $String = 'SUCC', $Code = 0)
    {
        parent::__construct($String, $Code);
        $this->Data = $Data;
    }

    /**
     * 获取附加数据
     * @return array
     */
    public function getData()
    {
        return $this->Data;
    }

    /**
     * 获取返回值
     * @return Common_Util_ReturnVar
     */
    public function getRetData()
    {
        return Common_Util_ReturnVar::RetSucc($this->Data, $this->getCode(), $this->getMessage());
    }
}