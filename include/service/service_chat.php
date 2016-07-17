<?php
namespace service;
use Common\Util\Common_Util_ReturnVar;

/**
 * 聊天服务
 * @author zhipeng
 *
 */
class service_chat extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            'chat',
            'recvchat',
            'chattoneighbourhood',
            'recvneighbourhoodchat'
        ));
    }

    protected function get_dbins()
    {
        return $this->callerUserInstance->dbs_chat_normal();
    }

    /**
     * 聊天
     *
     * @param 目标用户 $destuserid
     * @param 内容 $content
     * @return Common_Util_ReturnVar
     */
    function chat($destuserid, $content)
    {
        typeCheckUserId($destuserid);
        typeCheckString($content, 200);

        return $this->get_dbins()->chat($destuserid, $content);
    }

    /**
     * 接收所有的聊天消息,客户端注意自己保存
     *
     * @return Common_Util_ReturnVar
     */
    function recvchat()
    {
        return $this->get_dbins()->recvchat();
    }

    /**
     * 发送群组聊天
     *
     * @param string $content
     * @return Common_Util_ReturnVar
     */
    function chattoneighbourhood($content)
    {
        typeCheckString($content, 200);
        return $this->get_dbins()->chattoneighbourhood($content);
    }

    /**
     * 收取群聊
     *
     * @param string $param
     * @return Common_Util_ReturnVar
     */
    function recvneighbourhoodchat()
    {
        return $this->get_dbins()->recvneighbourhoodchat();
    }
}