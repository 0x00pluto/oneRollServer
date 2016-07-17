<?php

namespace dbs\templates\scene;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_scene_sceneLayerData
 * @package dbs\templates\scene
 */
class dbs_templates_scene_sceneLayerData extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "scene.sceneLayerData" );
    }
    /**
     * 层级标示
     *
     * @var
     */
    const DBKey_layerId = "layerId";

	/**
	 * 获取 层级标示
	 * @return string
	 */
	public function get_layerId()
	{
		return $this->getdata ( self::DBKey_layerId );
	}

	/**
	 * 设置 层级标示
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_layerId($value)
	{
		$this->setdata ( self::DBKey_layerId, strval($value) );
		return $this;
	}

	/**
     * 重置 层级标示
     * 设置为 ""
     * @return $this
     */
    public function reset_layerId()
    {
        return $this->reset_defaultValue(self::DBKey_layerId);
    }

    /**
     * 设置 层级标示 默认值
     */
    protected function _set_defaultvalue_layerId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_layerId, "" );
    }
    /**
     * 碰撞信息
     *
     * @var
     */
    const DBKey_collision = "collision";

	/**
	 * 获取 碰撞信息
	 * @return array
	 */
	public function get_collision()
	{
		return $this->getdata ( self::DBKey_collision );
	}

	/**
	 * 设置 碰撞信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_collision($value)
	{
		$this->setdata ( self::DBKey_collision, $value );
		return $this;
	}

	/**
     * 重置 碰撞信息
     * 设置为 []
     * @return $this
     */
    public function reset_collision()
    {
        return $this->reset_defaultValue(self::DBKey_collision);
    }

    /**
     * 设置 碰撞信息 默认值
     */
    protected function _set_defaultvalue_collision()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_collision, [] );
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
        //设置 层级标示 默认值
        $this->_set_defaultvalue_layerId();
        //设置 碰撞信息 默认值
        $this->_set_defaultvalue_collision();

    }
}