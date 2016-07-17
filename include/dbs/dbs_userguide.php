<?php

namespace dbs;

use Common\Util\Common_Util_ReturnVar;
use configdata\configdata_player_game_guide_setting;
use constants\constants_moneychangereason;
use constants\constants_returnkey;
use constants\constants_userguide;
use err\err_dbs_userguide_beginguide;
use err\err_dbs_userguide_endguide;
use utils\utils_log;

/**
 * 说明
 * 2015年9月7日 上午10:51:33
 *
 * @author zhipeng
 *
 */
class dbs_userguide extends dbs_baseplayer
{

    /**
     * 引导步骤
     *
     * @var string
     */
    const DBKey_guidelist = "guidelist";

    /**
     * 获取 引导步骤
     *
     * @return \hellaEngine\data\multitype:
     */
    public function get_guidelist()
    {
        return $this->getdata(self::DBKey_guidelist);
    }

    /**
     * 设置 引导步骤
     *
     * @param unknown $value
     */
    private function set_guidelist($value)
    {
        $value = ( array )($value);
        $this->setdata(self::DBKey_guidelist, $value);
    }

    /**
     * 设置 引导步骤 默认值
     */
    protected function _set_defaultvalue_guidelist()
    {
        $this->set_defaultkeyandvalue(self::DBKey_guidelist, []);
    }

    /**
     * 是否离线吃菜
     *
     * @var string
     */
    const DBKey_offlineeat = "offlineeat";

    /**
     * 获取 是否离线吃菜
     */
    private function get_offlineeat()
    {
        return $this->getdata(self::DBKey_offlineeat);
    }

    /**
     * 设置 是否离线吃菜
     *
     * @param unknown $value
     */
    private function set_offlineeat($value)
    {
        $value = boolval($value);
        $this->setdata(self::DBKey_offlineeat, $value);
    }

    /**
     * 设置 是否离线吃菜 默认值
     */
    protected function _set_defaultvalue_offlineeat()
    {
        $this->set_defaultkeyandvalue(self::DBKey_offlineeat, false);
    }

    /**
     * 是否第一次帮忙加速
     *
     * @var string
     */
    const DBKey_fristHelpFriendSpeedUp = "fristHelpFriendSpeedUp";

    /**
     * 获取 是否第一次帮忙加速
     */
    public function get_fristHelpFriendSpeedUp()
    {
        return $this->getdata(self::DBKey_fristHelpFriendSpeedUp);
    }

    /**
     * 设置 是否第一次帮忙加速
     *
     * @param unknown $value
     */
    public function set_fristHelpFriendSpeedUp($value)
    {
        $value = boolval($value);
        $this->setdata(self::DBKey_fristHelpFriendSpeedUp, $value);
    }

    /**
     * 设置 是否第一次帮忙加速 默认值
     */
    protected function _set_defaultvalue_fristHelpFriendSpeedUp()
    {
        $this->set_defaultkeyandvalue(self::DBKey_fristHelpFriendSpeedUp, false);
    }

    /**
     * 第一次加速吃菜
     *
     * @var string
     */
    const DBKey_fristHelpFriendEatDishes = "fristHelpFriendEatDishes";

    /**
     * 获取 第一次加速吃菜
     */
    public function get_fristHelpFriendEatDishes()
    {
        return $this->getdata(self::DBKey_fristHelpFriendEatDishes);
    }

    /**
     * 设置 第一次加速吃菜
     *
     * @param unknown $value
     */
    public function set_fristHelpFriendEatDishes($value)
    {
        $value = boolval($value);
        $this->setdata(self::DBKey_fristHelpFriendEatDishes, $value);
    }

    /**
     * 设置 第一次加速吃菜 默认值
     */
    protected function _set_defaultvalue_fristHelpFriendEatDishes()
    {
        $this->set_defaultkeyandvalue(self::DBKey_fristHelpFriendEatDishes, false);
    }

    /**
     * 最后一次完成的引导的Key
     *
     * @var string
     */
    const DBKey_lastfinishguidekey = "lastfinishguidekey";

    /**
     * 获取 最后一次完成的引导的Key
     */
    public function get_lastfinishguidekey()
    {
        return $this->getdata(self::DBKey_lastfinishguidekey);
    }

    /**
     * 设置 最后一次完成的引导的Key
     *
     * @param unknown $value
     */
    public function set_lastfinishguidekey($value)
    {
        $value = strval($value);
        $this->setdata(self::DBKey_lastfinishguidekey, $value);
    }

    /**
     * 设置 最后一次完成的引导的Key 默认值
     */
    protected function _set_defaultvalue_lastfinishguidekey()
    {
        $this->set_defaultkeyandvalue(self::DBKey_lastfinishguidekey, constants_userguide::INVALID_KEY);
    }

    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "userguide";

    function __construct()
    {
        parent::__construct(self::DBKey_tablename);
    }

    /**
     * 获取引导配置
     *
     * @param string $guideKey
     * @return \Common\Util\multitype:|string
     */
    static function getGuideConfig($guideKey)
    {
        return getConfigData(configdata_player_game_guide_setting::class, configdata_player_game_guide_setting::k_id, $guideKey);
    }

    /**
     * 开始引导
     *
     * @param int $guidekey
     */
    function beginguide($guidekey)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_userguide_beginguide{}

        $guidekey = strval($guidekey);

        $guideList = $this->get_guidelist();
        if (isset ($guideList [$guidekey])) {
            $retCode = err_dbs_userguide_beginguide::GUIDE_IS_EXISTS;
            $retCode_Str = 'GUIDE_IS_EXISTS';
            goto failed;
        }

        $guideConfig = self::getGuideConfig($guidekey);
        if ($guideConfig === null) {
            $retCode = err_dbs_userguide_beginguide::GUIDE_KEY_ERROR;
            $retCode_Str = 'GUIDE_KEY_ERROR';
            goto failed;
        }

        if (in_array(constants_userguide::STATE_OPEN, $guideList)) {
            $retCode = err_dbs_userguide_beginguide::GUIDE_OPEN_DUPLICATE;
            $retCode_Str = 'GUIDE_OPEN_DUPLICATE';
            goto failed;
        }

        $guideList [$guidekey] = constants_userguide::STATE_OPEN;
        $this->set_guidelist($guideList);

        utils_log::getInstance()->gamelog(utils_log::LOGTYPE_USERGUIDE_BEGIN, $this->get_userid(), [
            $guidekey
        ]);

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 结束引导
     *
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function endguide()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_userguide_endguide{}

        $guideList = $this->get_guidelist();

        $guideKey = null;
        // 查找开启的引导key
        foreach ($guideList as $key => $value) {
            if ($value === constants_userguide::STATE_OPEN) {
                $guideKey = $key;
                break;
            }
        }

        if ($guideKey === null) {
            $retCode = err_dbs_userguide_endguide::NOT_OPENED_GUIDE;
            $retCode_Str = 'NOT_OPENED_GUIDE';
            goto failed;
        }

        // 设置完成
        $guideList [$guideKey] = constants_userguide::STATE_CLOSE;
        $this->set_guidelist($guideList);

        $guideConfig = self::getGuideConfig($guideKey);
        // 奖励钻石
        $awardDiamond = intval($guideConfig [configdata_player_game_guide_setting::k_awarddiamond]);
        $awardGameCoin = intval($guideConfig [configdata_player_game_guide_setting::k_awardgamecoin]);

        $this->db_owner->db_role()->add_gamecoin_and_diamonds($awardGameCoin, $awardDiamond, constants_moneychangereason::ADD_BY_USER_GUIDE);

        $data [constants_returnkey::RK_DIAMOND] = $awardDiamond;
        $data [constants_returnkey::RK_GAMECOIN] = $awardGameCoin;
        // 奖励道具
        if (isset ($guideConfig [configdata_player_game_guide_setting::k_awarditemid])) {
            $itemId = $guideConfig [configdata_player_game_guide_setting::k_awarditemid];
            $itemCount = $guideConfig [configdata_player_game_guide_setting::k_awarditemcount];

            if (dbs_warehouse::additemtowarehouse($this->db_owner, $itemId, $itemCount)) {
                $data [constants_returnkey::RK_ITEMID] = $itemId;
                $data [constants_returnkey::RK_ITEMCOUNT] = $itemCount;
            }
        }

        $this->set_lastfinishguidekey($guideKey);

        utils_log::getInstance()->gamelog(utils_log::LOGTYPE_USERGUIDE_END, $this->get_userid(), [
            $guideKey
        ]);

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 是否开启离线吃菜
     *
     * @return boolean
     */
    public function isOffLineEat()
    {
        $offlineEat = $this->get_offlineeat();
        if ($offlineEat) {
            return $offlineEat;
        }

        if ($this->db_owner->db_restaurantinfo()->get_restaurantlevel() > 6) {
            $this->set_offlineeat(true);
            return true;
        }
        return false;
    }

    /**
     * 开启离线吃菜
     *
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function startOffLineEat()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_userguide_startOffLineEat{}

        $this->set_offlineeat(true);

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 当前步骤是否是xxx
     *
     * @param string $guideKey
     * @return boolean
     */
    function isGuide($guideKey)
    {
        return $this->currentActiveGuide() === $guideKey;
    }

    /**
     * 获取当前激活的引导步骤
     *
     * @return string
     */
    function currentActiveGuide()
    {
        $guideList = $this->get_guidelist();
        foreach ($guideList as $key => $value) {
            if ($value === constants_userguide::STATE_OPEN) {
                return $key;
            }
        }
        return constants_userguide::INVALID_KEY;
    }
}