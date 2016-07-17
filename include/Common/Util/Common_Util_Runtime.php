<?php

namespace Common\Util;

class Common_Util_Runtime
{
    /**
     * 开始时间
     *
     */
    private $StartTime = 0;
    /**
     * 结束时间
     *
     */
    private $StopTime = 0;

    private function get_microtime()
    {
        list ($usec, $sec) = explode(' ', microtime());
        return (( float )$usec + ( float )$sec);
    }

    /**
     * 开始
     */
    function start()
    {
        $this->StartTime = $this->get_microtime();
    }

    /**
     * 停止
     */
    function stop()
    {
        $this->StopTime = $this->get_microtime();
    }

    /**
     * 运行时间
     *
     * @return number
     */
    function spent()
    {
        return round(($this->StopTime - $this->StartTime) * 1000, 1);
    }
}