<?php

namespace dbs\templates\neighbourhood;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_neighbourhood_groupmemberreputationdata
 * @package dbs\templates\neighbourhood
 */
class dbs_templates_neighbourhood_groupmemberreputationdata extends super
{
    /**
     * 数据类型
     *
     * @var
     */
    const DBKey_dataTemplateType = "dataTemplateType";

	/**
	 * 获取 数据类型
	 * @return string
	 */
	public function get_dataTemplateType()
	{
		return $this->getdata ( self::DBKey_dataTemplateType );
	}

    /**
     * 设置 数据类型 默认值
     */
    protected function _set_defaultvalue_dataTemplateType()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "neighbourhood.groupmemberreputationdata" );
    }
    /**
     * 威望等级
     *
     * @var
     */
    const DBKey_reputationlevel = "reputationlevel";

	/**
	 * 获取 威望等级
	 * @return int
	 */
	public function get_reputationlevel()
	{
		return $this->getdata ( self::DBKey_reputationlevel );
	}

	/**
	 * 设置 威望等级
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_reputationlevel($value)
	{
		$this->setdata ( self::DBKey_reputationlevel, intval($value) );
		return $this;
	}

	/**
     * 重置 威望等级
     * 设置为 1
     * @return $this
     */
    public function reset_reputationlevel()
    {
        return $this->reset_defaultValue(self::DBKey_reputationlevel);
    }

    /**
     * 设置 威望等级 默认值
     */
    protected function _set_defaultvalue_reputationlevel()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_reputationlevel, 1 );
    }
    /**
     * 威望经验
     *
     * @var
     */
    const DBKey_reputationexp = "reputationexp";

	/**
	 * 获取 威望经验
	 * @return int
	 */
	public function get_reputationexp()
	{
		return $this->getdata ( self::DBKey_reputationexp );
	}

	/**
	 * 设置 威望经验
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_reputationexp($value)
	{
		$this->setdata ( self::DBKey_reputationexp, intval($value) );
		return $this;
	}

	/**
     * 重置 威望经验
     * 设置为 0
     * @return $this
     */
    public function reset_reputationexp()
    {
        return $this->reset_defaultValue(self::DBKey_reputationexp);
    }

    /**
     * 设置 威望经验 默认值
     */
    protected function _set_defaultvalue_reputationexp()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_reputationexp, 0 );
    }
    /**
     * 威望总经验
     *
     * @var
     */
    const DBKey_reputationtotalexp = "reputationtotalexp";

	/**
	 * 获取 威望总经验
	 * @return int
	 */
	public function get_reputationtotalexp()
	{
		return $this->getdata ( self::DBKey_reputationtotalexp );
	}

	/**
	 * 设置 威望总经验
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_reputationtotalexp($value)
	{
		$this->setdata ( self::DBKey_reputationtotalexp, intval($value) );
		return $this;
	}

	/**
     * 重置 威望总经验
     * 设置为 0
     * @return $this
     */
    public function reset_reputationtotalexp()
    {
        return $this->reset_defaultValue(self::DBKey_reputationtotalexp);
    }

    /**
     * 设置 威望总经验 默认值
     */
    protected function _set_defaultvalue_reputationtotalexp()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_reputationtotalexp, 0 );
    }


    /**
     * @inheritDoc
     */
    public function getVersion()
    {
        return 2;
    }
    /**
     * 设置默认值
     */
    protected function initializeDefaultValues()
    {
        parent::initializeDefaultValues();
        //设置 数据类型 默认值
        $this->_set_defaultvalue_dataTemplateType();
        //设置 威望等级 默认值
        $this->_set_defaultvalue_reputationlevel();
        //设置 威望经验 默认值
        $this->_set_defaultvalue_reputationexp();
        //设置 威望总经验 默认值
        $this->_set_defaultvalue_reputationtotalexp();

    }
}