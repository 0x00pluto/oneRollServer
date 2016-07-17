<?php

namespace dbs\templates\chef;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_chef_property
 * @package dbs\templates\chef
 */
class dbs_templates_chef_property extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "chef.property" );
    }
    /**
     * 烹饪能力
     *
     * @var
     */
    const DBKey_cookingability = "cookingability";

	/**
	 * 获取 烹饪能力
	 * @return int
	 */
	public function get_cookingability()
	{
		return $this->getdata ( self::DBKey_cookingability );
	}

	/**
	 * 设置 烹饪能力
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_cookingability($value)
	{
		$this->setdata ( self::DBKey_cookingability, intval($value) );
		return $this;
	}

	/**
     * 重置 烹饪能力
     * 设置为 0
     * @return $this
     */
    public function reset_cookingability()
    {
        return $this->reset_defaultValue(self::DBKey_cookingability);
    }

    /**
     * 设置 烹饪能力 默认值
     */
    protected function _set_defaultvalue_cookingability()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_cookingability, 0 );
    }
    /**
     * 中餐
     *
     * @var
     */
    const DBKey_chinesefood = "chinesefood";

	/**
	 * 获取 中餐
	 * @return int
	 */
	public function get_chinesefood()
	{
		return $this->getdata ( self::DBKey_chinesefood );
	}

	/**
	 * 设置 中餐
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_chinesefood($value)
	{
		$this->setdata ( self::DBKey_chinesefood, intval($value) );
		return $this;
	}

	/**
     * 重置 中餐
     * 设置为 0
     * @return $this
     */
    public function reset_chinesefood()
    {
        return $this->reset_defaultValue(self::DBKey_chinesefood);
    }

    /**
     * 设置 中餐 默认值
     */
    protected function _set_defaultvalue_chinesefood()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_chinesefood, 0 );
    }
    /**
     * 西餐加成
     *
     * @var
     */
    const DBKey_westernfood = "westernfood";

	/**
	 * 获取 西餐加成
	 * @return int
	 */
	public function get_westernfood()
	{
		return $this->getdata ( self::DBKey_westernfood );
	}

	/**
	 * 设置 西餐加成
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_westernfood($value)
	{
		$this->setdata ( self::DBKey_westernfood, intval($value) );
		return $this;
	}

	/**
     * 重置 西餐加成
     * 设置为 0
     * @return $this
     */
    public function reset_westernfood()
    {
        return $this->reset_defaultValue(self::DBKey_westernfood);
    }

    /**
     * 设置 西餐加成 默认值
     */
    protected function _set_defaultvalue_westernfood()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_westernfood, 0 );
    }
    /**
     * 日料加成
     *
     * @var
     */
    const DBKey_japenesefood = "japenesefood";

	/**
	 * 获取 日料加成
	 * @return int
	 */
	public function get_japenesefood()
	{
		return $this->getdata ( self::DBKey_japenesefood );
	}

	/**
	 * 设置 日料加成
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_japenesefood($value)
	{
		$this->setdata ( self::DBKey_japenesefood, intval($value) );
		return $this;
	}

	/**
     * 重置 日料加成
     * 设置为 0
     * @return $this
     */
    public function reset_japenesefood()
    {
        return $this->reset_defaultValue(self::DBKey_japenesefood);
    }

    /**
     * 设置 日料加成 默认值
     */
    protected function _set_defaultvalue_japenesefood()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_japenesefood, 0 );
    }
    /**
     * 法餐加成
     *
     * @var
     */
    const DBKey_frenchfood = "frenchfood";

	/**
	 * 获取 法餐加成
	 * @return int
	 */
	public function get_frenchfood()
	{
		return $this->getdata ( self::DBKey_frenchfood );
	}

	/**
	 * 设置 法餐加成
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_frenchfood($value)
	{
		$this->setdata ( self::DBKey_frenchfood, intval($value) );
		return $this;
	}

	/**
     * 重置 法餐加成
     * 设置为 0
     * @return $this
     */
    public function reset_frenchfood()
    {
        return $this->reset_defaultValue(self::DBKey_frenchfood);
    }

    /**
     * 设置 法餐加成 默认值
     */
    protected function _set_defaultvalue_frenchfood()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_frenchfood, 0 );
    }
    /**
     * 创意餐加成
     *
     * @var
     */
    const DBKey_ideafood = "ideafood";

	/**
	 * 获取 创意餐加成
	 * @return int
	 */
	public function get_ideafood()
	{
		return $this->getdata ( self::DBKey_ideafood );
	}

	/**
	 * 设置 创意餐加成
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_ideafood($value)
	{
		$this->setdata ( self::DBKey_ideafood, intval($value) );
		return $this;
	}

	/**
     * 重置 创意餐加成
     * 设置为 0
     * @return $this
     */
    public function reset_ideafood()
    {
        return $this->reset_defaultValue(self::DBKey_ideafood);
    }

    /**
     * 设置 创意餐加成 默认值
     */
    protected function _set_defaultvalue_ideafood()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_ideafood, 0 );
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
        //设置 烹饪能力 默认值
        $this->_set_defaultvalue_cookingability();
        //设置 中餐 默认值
        $this->_set_defaultvalue_chinesefood();
        //设置 西餐加成 默认值
        $this->_set_defaultvalue_westernfood();
        //设置 日料加成 默认值
        $this->_set_defaultvalue_japenesefood();
        //设置 法餐加成 默认值
        $this->_set_defaultvalue_frenchfood();
        //设置 创意餐加成 默认值
        $this->_set_defaultvalue_ideafood();

    }
}