<?php

namespace dbs\templates\themeRestaurant;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_themeRestaurant_themeRestaurantInfo
 * @package dbs\templates\themeRestaurant
 */
class dbs_templates_themeRestaurant_themeRestaurantInfo extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "themeRestaurant.themeRestaurantInfo" );
    }
    /**
     * 主题餐厅ID
     *
     * @var
     */
    const DBKey_id = "id";

	/**
	 * 获取 主题餐厅ID
	 * @return int
	 */
	public function get_id()
	{
		return $this->getdata ( self::DBKey_id );
	}

	/**
	 * 设置 主题餐厅ID
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_id($value)
	{
		$this->setdata ( self::DBKey_id, intval($value) );
		return $this;
	}

	/**
     * 重置 主题餐厅ID
     * 设置为 0
     * @return $this
     */
    public function reset_id()
    {
        return $this->reset_defaultValue(self::DBKey_id);
    }

    /**
     * 设置 主题餐厅ID 默认值
     */
    protected function _set_defaultvalue_id()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_id, 0 );
    }
    /**
     * 客流数
     *
     * @var
     */
    const DBKey_customFlow = "customFlow";

	/**
	 * 获取 客流数
	 * @return int
	 */
	public function get_customFlow()
	{
		return $this->getdata ( self::DBKey_customFlow );
	}

	/**
	 * 设置 客流数
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_customFlow($value)
	{
		$this->setdata ( self::DBKey_customFlow, intval($value) );
		return $this;
	}

	/**
     * 重置 客流数
     * 设置为 0
     * @return $this
     */
    public function reset_customFlow()
    {
        return $this->reset_defaultValue(self::DBKey_customFlow);
    }

    /**
     * 设置 客流数 默认值
     */
    protected function _set_defaultvalue_customFlow()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_customFlow, 0 );
    }
    /**
     * 是否自动经营
     *
     * @var
     */
    const DBKey_manageData = "manageData";

	/**
	 * 获取 是否自动经营
	 * @return array
	 */
	protected function get_manageData()
	{
		return $this->getdata ( self::DBKey_manageData );
	}

	/**
	 * 设置 是否自动经营
	 *
	 * @param array $value
	 * @return $this
	 */
	protected function set_manageData($value)
	{
		$this->setdata ( self::DBKey_manageData, $value );
		return $this;
	}

	/**
     * 重置 是否自动经营
     * 设置为 []
     * @return $this
     */
    public function reset_manageData()
    {
        return $this->reset_defaultValue(self::DBKey_manageData);
    }

    /**
     * 设置 是否自动经营 默认值
     */
    protected function _set_defaultvalue_manageData()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_manageData, [] );
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
        //设置 主题餐厅ID 默认值
        $this->_set_defaultvalue_id();
        //设置 客流数 默认值
        $this->_set_defaultvalue_customFlow();
        //设置 是否自动经营 默认值
        $this->_set_defaultvalue_manageData();

    }
}