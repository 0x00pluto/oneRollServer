<?php

namespace dbs\templates\scene;

use dbs\dbs_base as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_scene_sceneData
 * @package dbs\templates\scene
 */
abstract class dbs_templates_scene_sceneData extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "scene_sceneDatas";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "scene.sceneData" );
    }
    /**
     * 场景唯一ID
     *
     * @var
     */
    const DBKey_sceneGUID = "sceneGUID";

	/**
	 * 获取 场景唯一ID
	 * @return string
	 */
	public function get_sceneGUID()
	{
		return $this->getdata ( self::DBKey_sceneGUID );
	}

	/**
	 * 设置 场景唯一ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_sceneGUID($value)
	{
		$this->setdata ( self::DBKey_sceneGUID, strval($value) );
		return $this;
	}

	/**
     * 重置 场景唯一ID
     * 设置为 ""
     * @return $this
     */
    public function reset_sceneGUID()
    {
        return $this->reset_defaultValue(self::DBKey_sceneGUID);
    }

    /**
     * 设置 场景唯一ID 默认值
     */
    protected function _set_defaultvalue_sceneGUID()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_sceneGUID, "" );
    }
    /**
     * 用户ID
     *
     * @var
     */
    const DBKey_userid = "userid";

	/**
	 * 获取 用户ID
	 * @return string
	 */
	public function get_userid()
	{
		return $this->getdata ( self::DBKey_userid );
	}

	/**
	 * 设置 用户ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_userid($value)
	{
		$this->setdata ( self::DBKey_userid, strval($value) );
		return $this;
	}

	/**
     * 重置 用户ID
     * 设置为 ""
     * @return $this
     */
    public function reset_userid()
    {
        return $this->reset_defaultValue(self::DBKey_userid);
    }

    /**
     * 设置 用户ID 默认值
     */
    protected function _set_defaultvalue_userid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_userid, "" );
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
     * 场景层级数据
     *
     * @var
     */
    const DBKey_layerDatas = "layerDatas";

	/**
	 * 获取 场景层级数据
	 * @return array
	 */
	public function get_layerDatas()
	{
		return $this->getdata ( self::DBKey_layerDatas );
	}

	/**
	 * 设置 场景层级数据
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_layerDatas($value)
	{
		$this->setdata ( self::DBKey_layerDatas, $value );
		return $this;
	}

	/**
     * 重置 场景层级数据
     * 设置为 []
     * @return $this
     */
    public function reset_layerDatas()
    {
        return $this->reset_defaultValue(self::DBKey_layerDatas);
    }

    /**
     * 设置 场景层级数据 默认值
     */
    protected function _set_defaultvalue_layerDatas()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_layerDatas, [] );
    }
    /**
     * 场景建筑
     *
     * @var
     */
    const DBKey_buildings = "buildings";

	/**
	 * 获取 场景建筑
	 * @return array
	 */
	public function get_buildings()
	{
		return $this->getdata ( self::DBKey_buildings );
	}

	/**
	 * 设置 场景建筑
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_buildings($value)
	{
		$this->setdata ( self::DBKey_buildings, $value );
		return $this;
	}

	/**
     * 重置 场景建筑
     * 设置为 []
     * @return $this
     */
    public function reset_buildings()
    {
        return $this->reset_defaultValue(self::DBKey_buildings);
    }

    /**
     * 设置 场景建筑 默认值
     */
    protected function _set_defaultvalue_buildings()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_buildings, [] );
    }
    /**
     * 扩地信息
     *
     * @var
     */
    const DBKey_expandInfo = "expandInfo";

	/**
	 * 获取 扩地信息
	 * @return array
	 */
	public function get_expandInfo()
	{
		return $this->getdata ( self::DBKey_expandInfo );
	}

	/**
	 * 设置 扩地信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_expandInfo($value)
	{
		$this->setdata ( self::DBKey_expandInfo, $value );
		return $this;
	}

	/**
     * 重置 扩地信息
     * 设置为 []
     * @return $this
     */
    public function reset_expandInfo()
    {
        return $this->reset_defaultValue(self::DBKey_expandInfo);
    }

    /**
     * 设置 扩地信息 默认值
     */
    protected function _set_defaultvalue_expandInfo()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_expandInfo, [] );
    }
    /**
     * 有效的桌椅数量
     *
     * @var
     */
    const DBKey_validChairCount = "validChairCount";

	/**
	 * 获取 有效的桌椅数量
	 * @return int
	 */
	public function get_validChairCount()
	{
		return $this->getdata ( self::DBKey_validChairCount );
	}

	/**
	 * 设置 有效的桌椅数量
	 *
	 * @param int $value
	 * @return $this
	 */
	protected function set_validChairCount($value)
	{
		$this->setdata ( self::DBKey_validChairCount, intval($value) );
		return $this;
	}

	/**
     * 重置 有效的桌椅数量
     * 设置为 0
     * @return $this
     */
    public function reset_validChairCount()
    {
        return $this->reset_defaultValue(self::DBKey_validChairCount);
    }

    /**
     * 设置 有效的桌椅数量 默认值
     */
    protected function _set_defaultvalue_validChairCount()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_validChairCount, 0 );
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
        //设置 场景唯一ID 默认值
        $this->_set_defaultvalue_sceneGUID();
        //设置 用户ID 默认值
        $this->_set_defaultvalue_userid();
        //设置 主题餐厅ID 默认值
        $this->_set_defaultvalue_themeRestaurantId();
        //设置 场景层级数据 默认值
        $this->_set_defaultvalue_layerDatas();
        //设置 场景建筑 默认值
        $this->_set_defaultvalue_buildings();
        //设置 扩地信息 默认值
        $this->_set_defaultvalue_expandInfo();
        //设置 有效的桌椅数量 默认值
        $this->_set_defaultvalue_validChairCount();

    }
}