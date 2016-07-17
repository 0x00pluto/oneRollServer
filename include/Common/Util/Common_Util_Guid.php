<?php

namespace Common\Util;

class Common_Util_Guid
{
    /**
     * 生成GUID
     * @param string $prefix
     * @return string
     */
    static function uuid($prefix = '')
    {
        return $prefix . self::uuid_fromString(uniqid(mt_rand(), true));
    }

    /**
     * md5 切割GUID格式.
     * @param string $unMd5String 未被MD5加密的字符串
     * @return string
     */
    static function uuid_fromString($unMd5String)
    {
        $chars = md5($unMd5String);
        $uuid = substr($chars, 0, 8) . '-';
        $uuid .= substr($chars, 8, 4) . '-';
        $uuid .= substr($chars, 12, 4) . '-';
        $uuid .= substr($chars, 16, 4) . '-';
        $uuid .= substr($chars, 20, 12);
        return $uuid;
    }


    static function gen_userid()
    {
        return self::uuid("userid-");
    }

    static function gen_verify()
    {
        return self::uuid("verify-");
    }

    /**
     * 生成随机密码
     *
     * @return string
     */
    static function gen_password()
    {
        return self::uuid("pwd-");
    }

    /**
     * 生成道具id
     *
     * @return string
     */
    static function gen_itemid()
    {
        return self::uuid("itemid-");
    }

    /**
     * 生成仓库位置
     */
    static function gen_warehousepos()
    {
        return self::uuid("pos-");
    }

    /**
     * 生成建筑id
     *
     * @return string
     */
    static function gen_buildingid()
    {
        return self::uuid("building-");
    }

    /**
     * 生成请求guid
     *
     * @return string
     */
    static function gen_friend_request()
    {
        return self::uuid("friendrequest-");
    }

    static function gen_visitor()
    {
        return self::uuid("visitor-");
    }

    /**
     * 厨师id
     *
     * @return string
     */
    static function gen_chefguid()
    {
        return self::uuid("chefid-");
    }

    /**
     * 生产邮件id
     */
    static function gen_mailid()
    {
        return self::uuid("mailid-");
    }

    /**
     * 生成邮件附属操作id
     */
    static function gen_attachactoinid()
    {
        return self::uuid("mailattachactionid-");
    }

    /**
     * 生成红包id
     *
     * @return string
     */
    static function gen_neighboorhoodgiftpackageid()
    {
        return self::uuid("gift-");
    }

    /**
     * 生产充值id
     *
     * @return string
     */
    static function gen_recharge_orderid()
    {
        return self::uuid("orderid-");
    }

    /**
     * 生成公告id
     */
    static function gen_notice_guid()
    {
        return self::uuid("notice-");
    }

    /**
     * 生成机器人用户名
     *
     * @return string
     */
    static function gen_robot_username()
    {
        return self::uuid("robot_username-");
    }

    /**
     * 生成交易id
     */
    static function gen_trade_guid()
    {
        return self::uuid("tradeid-");
    }

    /**
     * 宝箱id
     *
     * @return string
     */
    static function gen_box_guid()
    {
        return self::uuid("boxid-");
    }

    /**
     * 老虎机id
     */
    static function gen_superslotmachine_guid()
    {
        return self::uuid("superslotmachine-");
    }

    /**
     * 生成群组邀请码
     *
     * @return string
     */
    static function gen_group_inviteguid()
    {
        return self::uuid("groupinviteguid-");
    }

    /**
     * 生成相册图片id
     *
     * @return string
     */
    static function gen_photoalbum_id()
    {
        return self::uuid("photoalbum_id-");
    }

    /**
     * 生成公告id
     * @return string
     */
    static function gen_bulletin_id()
    {
        return self::uuid("bulletin_id-");
    }

    /**
     * 生成训练房间id
     * @return string
     */
    static function gen_train_room_id()
    {
        return self::uuid("train_room_id-");
    }

    /**
     * 生成请求ID
     * @return string
     */
    static function gen_requestId()
    {
        return self::uuid("request_id-");
    }

    /**
     * 生成时装商店ID
     * @return string
     */
    static function gen_fashionShopId()
    {
        return self::uuid("fashion_shop_id-");
    }
}