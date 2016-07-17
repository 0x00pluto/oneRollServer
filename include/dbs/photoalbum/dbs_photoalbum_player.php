<?php

namespace dbs\photoalbum;

use Common\Util\Common_Util_Configdata;
use Common\Util\Common_Util_Guid;
use Common\Util\Common_Util_ReturnVar;
use constants\constants_returnkey;
use dbs\templates\photoalbum\dbs_templates_photoalbum_photoalbum;
use err\err_dbs_photoalbum_player_add;
use err\err_dbs_photoalbum_player_remove;

/**
 * 说明
 * 2015年11月18日 下午7:40:21
 *
 * @author zhipeng
 *
 */
class dbs_photoalbum_player extends dbs_templates_photoalbum_photoalbum
{

    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);
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
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_photoalbum_player_add{}

        $photoURL = strval($photoURL);

        $albumlist = $this->get_albumlist();
        $limitcount = Common_Util_Configdata::getInstance()->get_global_config_value('PHOTO_ALBUM_MAX_COUNT')->int_value();
        if (count($albumlist) >= $limitcount) {
            $retCode = err_dbs_photoalbum_player_add::PHOTO_ABLUM_MAX_COUNT;
            $retCode_Str = 'PHOTO_ABLUM_MAX_COUNT';
            goto failed;
        }
        $albumid = Common_Util_Guid::gen_photoalbum_id();
        $albumlist [$albumid] = $photoURL;

        $this->set_albumlist($albumlist);

        $data [constants_returnkey::RK_ABLUM] = [
            $albumid => $photoURL
        ];

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
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
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_photoalbum_player_remove{}

        // code
        $photoId = strval($photoId);
        $albumlist = $this->get_albumlist();

        if (!isset ($albumlist [$photoId])) {
            $retCode = err_dbs_photoalbum_player_remove::PHOTO_ID_NOT_EXISTS;
            $retCode_Str = 'PHOTO_ID_NOT_EXISTS';
            goto failed;
        }

        unset ($albumlist [$photoId]);
        $this->set_albumlist($albumlist);

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }
}