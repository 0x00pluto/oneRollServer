<?php

namespace hellaEngine\exception;

use Common\Util\Common_Util_ReturnVar;

/**
 * 函数过程中的异常
 * Class exception_logicError
 * @package hellaEngine\exception
 */
class exception_logicError extends \Exception
{

    private $Data = [];

    public function __construct($ErrorString, $ErrorCode = 0, $Data = [], $addTrackInfo = false)
    {
        parent::__construct($ErrorString, $ErrorCode);
        if ($addTrackInfo) {
            $Data['track'] = $this->getTraceAsString();
        }
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
        return Common_Util_ReturnVar::RetFail($this->getCode(), $this->Data, $this->getMessage());
    }


}