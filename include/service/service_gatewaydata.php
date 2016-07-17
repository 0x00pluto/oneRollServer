<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/3/14
 * Time: 下午3:25
 */

namespace service;


class service_gatewaydata extends \hellaEngine\service\service_gatewaydata
{
    /**
     * 客户端版本号
     *
     * @var string
     */
    const DBKey_clientVersion = "clientVersion";

    /**
     * 获取 客户端版本号
     */
    public function get_clientVersion()
    {
        return $this->getdata(self::DBKey_clientVersion);
    }

    /**
     * 设置 客户端版本号
     *
     * @param string $value
     */
    public function set_clientVersion($value)
    {
        $value = strval($value);
        $this->setdata(self::DBKey_clientVersion, $value);
    }

    /**
     * 设置 客户端版本号 默认值
     */
    protected function _set_defaultvalue_clientVersion()
    {
        $this->set_defaultkeyandvalue(self::DBKey_clientVersion, '');


    }

    /**
     * @inheritDoc
     */
    protected function initializeDefaultValues()
    {
        $this->_set_defaultvalue_clientVersion();
        parent::initializeDefaultValues();
    }


}