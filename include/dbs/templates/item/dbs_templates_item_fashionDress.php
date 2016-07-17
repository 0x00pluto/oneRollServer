<?php

namespace dbs\templates\item;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_item_fashionDress
 * @package dbs\templates\item
 */
class dbs_templates_item_fashionDress extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "item.fashionDress" );
    }
    /**
     * 绑定厨师ID
     *
     * @var
     */
    const DBKey_bindChefId = "bindChefId";

	/**
	 * 获取 绑定厨师ID
	 * @return string
	 */
	public function get_bindChefId()
	{
		return $this->getdata ( self::DBKey_bindChefId );
	}

	/**
	 * 设置 绑定厨师ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_bindChefId($value)
	{
		$this->setdata ( self::DBKey_bindChefId, strval($value) );
		return $this;
	}

	/**
     * 重置 绑定厨师ID
     * 设置为 ""
     * @return $this
     */
    public function reset_bindChefId()
    {
        return $this->reset_defaultValue(self::DBKey_bindChefId);
    }

    /**
     * 设置 绑定厨师ID 默认值
     */
    protected function _set_defaultvalue_bindChefId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_bindChefId, "" );
    }
    /**
     * 过期时间
     *
     * @var
     */
    const DBKey_expiredTime = "expiredTime";

	/**
	 * 获取 过期时间
	 * @return int
	 */
	public function get_expiredTime()
	{
		return $this->getdata ( self::DBKey_expiredTime );
	}

	/**
	 * 设置 过期时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_expiredTime($value)
	{
		$this->setdata ( self::DBKey_expiredTime, intval($value) );
		return $this;
	}

	/**
     * 重置 过期时间
     * 设置为 0
     * @return $this
     */
    public function reset_expiredTime()
    {
        return $this->reset_defaultValue(self::DBKey_expiredTime);
    }

    /**
     * 设置 过期时间 默认值
     */
    protected function _set_defaultvalue_expiredTime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_expiredTime, 0 );
    }
    /**
     * 是否已经使用,为true开始计算有效期
     *
     * @var
     */
    const DBKey_isUsed = "isUsed";

	/**
	 * 获取 是否已经使用,为true开始计算有效期
	 * @return bool
	 */
	public function get_isUsed()
	{
		return $this->getdata ( self::DBKey_isUsed );
	}

	/**
	 * 设置 是否已经使用,为true开始计算有效期
	 *
	 * @param bool $value
	 * @return $this
	 */
	protected function set_isUsed($value)
	{
		$this->setdata ( self::DBKey_isUsed, boolval($value) );
		return $this;
	}

	/**
     * 重置 是否已经使用,为true开始计算有效期
     * 设置为 false
     * @return $this
     */
    public function reset_isUsed()
    {
        return $this->reset_defaultValue(self::DBKey_isUsed);
    }

    /**
     * 设置 是否已经使用,为true开始计算有效期 默认值
     */
    protected function _set_defaultvalue_isUsed()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_isUsed, false );
    }
    /**
     * 是否穿着
     *
     * @var
     */
    const DBKey_isPutOn = "isPutOn";

	/**
	 * 获取 是否穿着
	 * @return bool
	 */
	public function get_isPutOn()
	{
		return $this->getdata ( self::DBKey_isPutOn );
	}

	/**
	 * 设置 是否穿着
	 *
	 * @param bool $value
	 * @return $this
	 */
	public function set_isPutOn($value)
	{
		$this->setdata ( self::DBKey_isPutOn, boolval($value) );
		return $this;
	}

	/**
     * 重置 是否穿着
     * 设置为 false
     * @return $this
     */
    public function reset_isPutOn()
    {
        return $this->reset_defaultValue(self::DBKey_isPutOn);
    }

    /**
     * 设置 是否穿着 默认值
     */
    protected function _set_defaultvalue_isPutOn()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_isPutOn, false );
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
        //设置 绑定厨师ID 默认值
        $this->_set_defaultvalue_bindChefId();
        //设置 过期时间 默认值
        $this->_set_defaultvalue_expiredTime();
        //设置 是否已经使用,为true开始计算有效期 默认值
        $this->_set_defaultvalue_isUsed();
        //设置 是否穿着 默认值
        $this->_set_defaultvalue_isPutOn();

    }
}