<?php
namespace constants;
/**
 * Class constants_platformtype
 * @package constants
 */
class constants_platformtype
{
    /**
     * 测试渠道
     *
     */
    const FANQIE_DEBUG_SIMULATOR = 0;

    /**
     * 真机 测试,内网
     */
    const FANQIE_DEBUG_Phone = 1;
    /**
     * 线上渠道,Appstore
     *
     */
    const APPSTORE = 3;

    /**
     * 真机 测试,外网测试服务器
     */
    const TEST002 = 6;
    /**
     * google
     * @var integer
     */
    const GOOGLEPLAY = 7;
    /**
     * IOS Inhouse渠道
     * @var integer
     */
    const INHOUSE = 8;
    /**
     * 小米渠道
     */
    const XIAOMI = 9;
    /**
     * 机器人渠道
     *
     */
    const ROBOT = 999;
}