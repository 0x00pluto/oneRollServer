<?php

namespace dbs\templates\scene;

use dbs\dbs_baseplayer as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_scene_scenePlayer
 * @package dbs\templates\scene
 */
abstract class dbs_templates_scene_scenePlayer extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "scene_scenePlayer";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "scene.scenePlayer" );
    }
    /**
     * 场景数据
     *
     * @var
     */
    const DBKey_scenes = "scenes";

	/**
	 * 获取 场景数据
	 * @return array
	 */
	public function get_scenes()
	{
		return $this->getdata ( self::DBKey_scenes );
	}

	/**
	 * 设置 场景数据
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_scenes($value)
	{
		$this->setdata ( self::DBKey_scenes, $value );
		return $this;
	}

	/**
     * 重置 场景数据
     * 设置为 []
     * @return $this
     */
    public function reset_scenes()
    {
        return $this->reset_defaultValue(self::DBKey_scenes);
    }

    /**
     * 设置 场景数据 默认值
     */
    protected function _set_defaultvalue_scenes()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_scenes, [] );
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
        //设置 场景数据 默认值
        $this->_set_defaultvalue_scenes();

    }
}