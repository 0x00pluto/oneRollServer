<?php

namespace dbs\templates\friendhelp;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_friendhelp_helpExpandData
 * @package dbs\templates\friendhelp
 */
class dbs_templates_friendhelp_helpExpandData extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "friendhelp.helpExpandData" );
    }
    /**
     * 主题餐厅ID
     *
     * @var
     */
    const DBKey_themeRestaurantId = "themeRestaurantId";

	/**
	 * 获取 主题餐厅ID
	 * @return int
	 */
	public function get_themeRestaurantId()
	{
		return $this->getdata ( self::DBKey_themeRestaurantId );
	}

	/**
	 * 设置 主题餐厅ID
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_themeRestaurantId($value)
	{
		$this->setdata ( self::DBKey_themeRestaurantId, intval($value) );
		return $this;
	}

	/**
     * 重置 主题餐厅ID
     * 设置为 0
     * @return $this
     */
    public function reset_themeRestaurantId()
    {
        return $this->reset_defaultValue(self::DBKey_themeRestaurantId);
    }

    /**
     * 设置 主题餐厅ID 默认值
     */
    protected function _set_defaultvalue_themeRestaurantId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_themeRestaurantId, 0 );
    }
    /**
     * 帮忙用户列表:用户ID=>helperData
     *
     * @var
     */
    const DBKey_helpers = "helpers";

	/**
	 * 获取 帮忙用户列表:用户ID=>helperData
	 * @return array
	 */
	public function get_helpers()
	{
		return $this->getdata ( self::DBKey_helpers );
	}

	/**
	 * 设置 帮忙用户列表:用户ID=>helperData
	 *
	 * @param array $value
	 * @return $this
	 */
	protected function set_helpers($value)
	{
		$this->setdata ( self::DBKey_helpers, $value );
		return $this;
	}

	/**
     * 重置 帮忙用户列表:用户ID=>helperData
     * 设置为 []
     * @return $this
     */
    public function reset_helpers()
    {
        return $this->reset_defaultValue(self::DBKey_helpers);
    }

    /**
     * 设置 帮忙用户列表:用户ID=>helperData 默认值
     */
    protected function _set_defaultvalue_helpers()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_helpers, [] );
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
        $this->_set_defaultvalue_themeRestaurantId();
        //设置 帮忙用户列表:用户ID=>helperData 默认值
        $this->_set_defaultvalue_helpers();

    }
}