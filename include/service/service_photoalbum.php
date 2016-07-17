<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;
use dbs\photoalbum\dbs_photoalbum_player;

/**
 * 相册服务
 * @auther zhipeng
 */
class service_photoalbum extends service_base
{
    function __construct()
    {
        $this->addFunctions([
            'getinfo',
            'add',
            'remove'
        ]);
    }

    /**
     * @return \dbs\dbs_baseplayer|null
     */
    protected function get_dbins()
    {
        return dbs_photoalbum_player::createWithPlayer($this->callerUserInstance);
    }

    protected function get_err_class_name()
    {
        return "err\\" . "err_dbs_photoalbum_player" . "_";
    }

    /**
     * 获取信息
     *
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function getinfo()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();

        // code
        $data = $this->get_dbins()->toArray();

        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
    }

    /**
     * 添加相片
     *
     * @param string $photoURL
     *            相册实际图片名称
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function add($photoURL)
    {
        typeCheckString($photoURL);
        return $this->get_dbins()->add($photoURL);
    }

    /**
     * 删除相册图片
     *
     * @param string $photoId
     *            相册id
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function remove($photoId)
    {
        typeCheckString($photoId);
        return $this->get_dbins()->remove($photoId);
    }
}