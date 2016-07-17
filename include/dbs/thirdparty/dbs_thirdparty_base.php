<?php

namespace dbs\thirdparty;

abstract class dbs_thirdparty_base
{
    function __construct()
    {
    }

    public function getPlatformId()
    {
    }

    /**
     *
     * @param string $username
     * @param string $password
     * @param int $thirdpartytype
     * @param string $specialUserid
     *            特殊USERID
     */
    public function create($username, $password, $thirdpartytype, $specialUserid = NULL, $linkuserid = NULL)
    {
    }

    public function login($username, $password, $thirdpartytype)
    {
    }

    /**
     * 删除账号
     *
     * @param string $username
     * @param string $password
     * @param int $thirdpartytype
     */
    public function delete($username, $password, $thirdpartytype)
    {
    }

    public function getAccessToken($autherizationcode)
    {
    }

    public function refreshgetToken($refreshToken)
    {
    }

    public function getUserInfo($accessToken)
    {
    }
    // public function verifyreceipt($orderId, $platformId, $playerInfo, $itemKey, $receiptbase64 = '') {
    // }
    // public function createOrderInfo($playerInfo, $platformId, $clientVersion, $rechargeId) {
    // }
    protected function _loadfromDB($db)
    {
    }
}