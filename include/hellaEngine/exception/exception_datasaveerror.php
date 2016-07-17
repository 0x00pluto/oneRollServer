<?php

namespace hellaEngine\exception;

class exception_datasaveerror extends \RuntimeException
{
    /**
     * 错误详细信息
     * @var array
     */
    private $errorDetail = [];

    /**
     * @return array
     */
    public function getErrorDetail()
    {
        return $this->errorDetail;
    }

    /**
     * @param array $errorDetail
     */
    public function setErrorDetail($errorDetail)
    {
        $this->errorDetail = $errorDetail;
    }


}