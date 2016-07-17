<?php

namespace dbs\templates\scene;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_scene_sceneExpandData
 * @package dbs\templates\scene
 */
class dbs_templates_scene_sceneExpandData extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "scene.sceneExpandData" );
    }
    /**
     * 扩地等级
     *
     * @var
     */
    const DBKey_level = "level";

	/**
	 * 获取 扩地等级
	 * @return int
	 */
	public function get_level()
	{
		return $this->getdata ( self::DBKey_level );
	}

	/**
	 * 设置 扩地等级
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_level($value)
	{
		$this->setdata ( self::DBKey_level, intval($value) );
		return $this;
	}

	/**
     * 重置 扩地等级
     * 设置为 1
     * @return $this
     */
    public function reset_level()
    {
        return $this->reset_defaultValue(self::DBKey_level);
    }

    /**
     * 设置 扩地等级 默认值
     */
    protected function _set_defaultvalue_level()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_level, 1 );
    }
    /**
     * 冷却时间
     *
     * @var
     */
    const DBKey_cooldown = "cooldown";

	/**
	 * 获取 冷却时间
	 * @return int
	 */
	public function get_cooldown()
	{
		return $this->getdata ( self::DBKey_cooldown );
	}

	/**
	 * 设置 冷却时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_cooldown($value)
	{
		$this->setdata ( self::DBKey_cooldown, intval($value) );
		return $this;
	}

	/**
     * 重置 冷却时间
     * 设置为 0
     * @return $this
     */
    public function reset_cooldown()
    {
        return $this->reset_defaultValue(self::DBKey_cooldown);
    }

    /**
     * 设置 冷却时间 默认值
     */
    protected function _set_defaultvalue_cooldown()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_cooldown, 0 );
    }
    /**
     * 是否正在扩建中
     *
     * @var
     */
    const DBKey_expanding = "expanding";

	/**
	 * 获取 是否正在扩建中
	 * @return bool
	 */
	public function get_expanding()
	{
		return $this->getdata ( self::DBKey_expanding );
	}

	/**
	 * 设置 是否正在扩建中
	 *
	 * @param bool $value
	 * @return $this
	 */
	public function set_expanding($value)
	{
		$this->setdata ( self::DBKey_expanding, boolval($value) );
		return $this;
	}

	/**
     * 重置 是否正在扩建中
     * 设置为 false
     * @return $this
     */
    public function reset_expanding()
    {
        return $this->reset_defaultValue(self::DBKey_expanding);
    }

    /**
     * 设置 是否正在扩建中 默认值
     */
    protected function _set_defaultvalue_expanding()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_expanding, false );
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
        //设置 扩地等级 默认值
        $this->_set_defaultvalue_level();
        //设置 冷却时间 默认值
        $this->_set_defaultvalue_cooldown();
        //设置 是否正在扩建中 默认值
        $this->_set_defaultvalue_expanding();

    }
}