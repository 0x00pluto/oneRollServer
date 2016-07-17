<?php

namespace dbs\base;

use Common\Util\Common_Util_ReturnVar;
use constants\constants_returnkey;
use err\err_dbs_base_level_addexp;

/**
 * 升级服务基类
 *
 * @author zhipeng
 *
 */
trait dbs_base_level
{
    /**
     * 获得当前等级的经验值
     */
    abstract protected function _get_exp();

    /**
     * 设置 当前等级的经验
     *
     * @param int $value
     */
    abstract protected function _set_exp($value);

    /**
     * 获取 等级
     */
    abstract protected function _get_level();

    /**
     * 设置 等级
     *
     * @param int $value
     */
    abstract protected function _set_level($value);

    /**
     * 获取 总经验
     */
    abstract protected function _get_totalexp();

    /**
     * 设置 总经验
     *
     * @param int $value
     */
    abstract protected function _set_totalexp($value);

    /**
     * 获取升级配置
     *
     * @param int $level
     */
    abstract protected function _get_levelup_config($level);

    /**
     * 获取需要经验的配置的关键字
     *
     * @return string
     */
    protected function _get_conf_k_needexp()
    {
        return 'needexp';
    }

    /**
     * 获取总经验的配置关键字
     *
     * @return string
     */
    protected function _get_conf_k_totalexp()
    {
        return 'totalexp';
    }


    /**
     * 强制设置等级和经验
     * @param int $newLevel
     * @return bool
     */
    protected function _set_level_force($newLevel)
    {
        $levelConf = $this->_get_levelup_config($newLevel);
        if (is_null($levelConf)) {
            return false;
        }
        $this->_set_level($newLevel);
        $this->_set_exp(0);
        if (isset ($levelConf [$this->_get_conf_k_totalexp()])) {
            $this->_set_totalexp($levelConf [$this->_get_conf_k_totalexp()]);
        }
        return true;
    }

    /**
     * 增加经验
     *
     * @param int $exp
     * @return Common_Util_ReturnVar
     */
    protected function addexp($exp)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();

        // code
        $exp = intval($exp);
        if ($exp <= 0) {
            $retCode = err_dbs_base_level_addexp::ERROR_EXP_VALUE_WRONG;
            $retCode_Str = 'ERROR_EXP_VALUE_WRONG';
            goto failed;
        }
        // 设置经验
        $newExp = $this->_get_exp() + $exp;

        // 当前等级
        $level = $this->_get_level();
        $nextLevel = $level + 1;
        $levelConf = $this->_get_levelup_config($nextLevel);
        // 等级最大了
        if (is_null($levelConf)) {

            $retCode = err_dbs_base_level_addexp::ERROR_LEVEL_MAX;
            $retCode_Str = 'ERROR_LEVEL_MAX';
            goto failed;
        } else {
            $this->_set_totalexp($exp + $this->_get_totalexp());

            while (TRUE) {
                $levelConf = $this->_get_levelup_config($nextLevel);
                // 等级最大了
                if (is_null($levelConf)) {
                    // 修正剩余的经验.
                    $this->_set_totalexp($this->_get_totalexp() - $newExp);
                    $newExp = 0;
                    break;
                } else {
                    $needExp = intval($levelConf [$this->_get_conf_k_needexp()]);
                    if ($newExp >= $needExp) {
                        $newExp -= $needExp;
                        // 升级
                        $level++;
                        // 下一等级
                        $nextLevel = $level + 1;
                    } else {
                        break;
                    }
                }
            }
        }

        $this->_set_exp($newExp);
        if ($level != $this->_get_level()) {
            $this->_set_level($level);
            $data [constants_returnkey::RK_LEVEL] = $level;
            $data [constants_returnkey::RK_UPGRADE] = true;
        }

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }
}

