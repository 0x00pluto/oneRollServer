<?php

namespace dbs\templates\scene\BuildingData;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_scene_BuildingData_cookingTable
 * @package dbs\templates\scene\BuildingData
 */
class dbs_templates_scene_BuildingData_cookingTable extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "scene.BuildingData.cookingTable" );
    }
    /**
     * 烹饪台的等级
     *
     * @var
     */
    const DBKey_level = "level";

	/**
	 * 获取 烹饪台的等级
	 * @return int
	 */
	public function get_level()
	{
		return $this->getdata ( self::DBKey_level );
	}

	/**
	 * 设置 烹饪台的等级
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
     * 重置 烹饪台的等级
     * 设置为 1
     * @return $this
     */
    public function reset_level()
    {
        return $this->reset_defaultValue(self::DBKey_level);
    }

    /**
     * 设置 烹饪台的等级 默认值
     */
    protected function _set_defaultvalue_level()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_level, 1 );
    }
    /**
     * 烹饪台状态
     *
     * @var
     */
    const DBKey_status = "status";

	/**
	 * 获取 烹饪台状态
	 * @return int
	 */
	public function get_status()
	{
		return $this->getdata ( self::DBKey_status );
	}

	/**
	 * 设置 烹饪台状态
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_status($value)
	{
		$this->setdata ( self::DBKey_status, intval($value) );
		return $this;
	}

	/**
     * 重置 烹饪台状态
     * 设置为 0
     * @return $this
     */
    public function reset_status()
    {
        return $this->reset_defaultValue(self::DBKey_status);
    }

    /**
     * 设置 烹饪台状态 默认值
     */
    protected function _set_defaultvalue_status()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_status, 0 );
    }
    /**
     * 烹饪菜品ID
     *
     * @var
     */
    const DBKey_cookDishesId = "cookDishesId";

	/**
	 * 获取 烹饪菜品ID
	 * @return int
	 */
	public function get_cookDishesId()
	{
		return $this->getdata ( self::DBKey_cookDishesId );
	}

	/**
	 * 设置 烹饪菜品ID
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_cookDishesId($value)
	{
		$this->setdata ( self::DBKey_cookDishesId, intval($value) );
		return $this;
	}

	/**
     * 重置 烹饪菜品ID
     * 设置为 0
     * @return $this
     */
    public function reset_cookDishesId()
    {
        return $this->reset_defaultValue(self::DBKey_cookDishesId);
    }

    /**
     * 设置 烹饪菜品ID 默认值
     */
    protected function _set_defaultvalue_cookDishesId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_cookDishesId, 0 );
    }
    /**
     * 烹饪中的菜谱ID
     *
     * @var
     */
    const DBKey_cookDishesCookbookId = "cookDishesCookbookId";

	/**
	 * 获取 烹饪中的菜谱ID
	 * @return int
	 */
	public function get_cookDishesCookbookId()
	{
		return $this->getdata ( self::DBKey_cookDishesCookbookId );
	}

	/**
	 * 设置 烹饪中的菜谱ID
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_cookDishesCookbookId($value)
	{
		$this->setdata ( self::DBKey_cookDishesCookbookId, intval($value) );
		return $this;
	}

	/**
     * 重置 烹饪中的菜谱ID
     * 设置为 0
     * @return $this
     */
    public function reset_cookDishesCookbookId()
    {
        return $this->reset_defaultValue(self::DBKey_cookDishesCookbookId);
    }

    /**
     * 设置 烹饪中的菜谱ID 默认值
     */
    protected function _set_defaultvalue_cookDishesCookbookId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_cookDishesCookbookId, 0 );
    }
    /**
     * 烹饪出的份数
     *
     * @var
     */
    const DBKey_cookDishesPiece = "cookDishesPiece";

	/**
	 * 获取 烹饪出的份数
	 * @return int
	 */
	public function get_cookDishesPiece()
	{
		return $this->getdata ( self::DBKey_cookDishesPiece );
	}

	/**
	 * 设置 烹饪出的份数
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_cookDishesPiece($value)
	{
		$this->setdata ( self::DBKey_cookDishesPiece, intval($value) );
		return $this;
	}

	/**
     * 重置 烹饪出的份数
     * 设置为 0
     * @return $this
     */
    public function reset_cookDishesPiece()
    {
        return $this->reset_defaultValue(self::DBKey_cookDishesPiece);
    }

    /**
     * 设置 烹饪出的份数 默认值
     */
    protected function _set_defaultvalue_cookDishesPiece()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_cookDishesPiece, 0 );
    }
    /**
     * 烹饪当前步骤数
     *
     * @var
     */
    const DBKey_cookDishesCurrentStep = "cookDishesCurrentStep";

	/**
	 * 获取 烹饪当前步骤数
	 * @return int
	 */
	public function get_cookDishesCurrentStep()
	{
		return $this->getdata ( self::DBKey_cookDishesCurrentStep );
	}

	/**
	 * 设置 烹饪当前步骤数
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_cookDishesCurrentStep($value)
	{
		$this->setdata ( self::DBKey_cookDishesCurrentStep, intval($value) );
		return $this;
	}

	/**
     * 重置 烹饪当前步骤数
     * 设置为 0
     * @return $this
     */
    public function reset_cookDishesCurrentStep()
    {
        return $this->reset_defaultValue(self::DBKey_cookDishesCurrentStep);
    }

    /**
     * 设置 烹饪当前步骤数 默认值
     */
    protected function _set_defaultvalue_cookDishesCurrentStep()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_cookDishesCurrentStep, 0 );
    }
    /**
     * 投入食材的详情
     *
     * @var
     */
    const DBKey_cookDishesMaterialDetails = "cookDishesMaterialDetails";

	/**
	 * 获取 投入食材的详情
	 * @return array
	 */
	public function get_cookDishesMaterialDetails()
	{
		return $this->getdata ( self::DBKey_cookDishesMaterialDetails );
	}

	/**
	 * 设置 投入食材的详情
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_cookDishesMaterialDetails($value)
	{
		$this->setdata ( self::DBKey_cookDishesMaterialDetails, $value );
		return $this;
	}

	/**
     * 重置 投入食材的详情
     * 设置为 []
     * @return $this
     */
    public function reset_cookDishesMaterialDetails()
    {
        return $this->reset_defaultValue(self::DBKey_cookDishesMaterialDetails);
    }

    /**
     * 设置 投入食材的详情 默认值
     */
    protected function _set_defaultvalue_cookDishesMaterialDetails()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_cookDishesMaterialDetails, [] );
    }
    /**
     * 烹饪投入的材料价值(最终值)
     *
     * @var
     */
    const DBKey_cookDishesMaterialValue = "cookDishesMaterialValue";

	/**
	 * 获取 烹饪投入的材料价值(最终值)
	 * @return int
	 */
	public function get_cookDishesMaterialValue()
	{
		return $this->getdata ( self::DBKey_cookDishesMaterialValue );
	}

	/**
	 * 设置 烹饪投入的材料价值(最终值)
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_cookDishesMaterialValue($value)
	{
		$this->setdata ( self::DBKey_cookDishesMaterialValue, intval($value) );
		return $this;
	}

	/**
     * 重置 烹饪投入的材料价值(最终值)
     * 设置为 0
     * @return $this
     */
    public function reset_cookDishesMaterialValue()
    {
        return $this->reset_defaultValue(self::DBKey_cookDishesMaterialValue);
    }

    /**
     * 设置 烹饪投入的材料价值(最终值) 默认值
     */
    protected function _set_defaultvalue_cookDishesMaterialValue()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_cookDishesMaterialValue, 0 );
    }
    /**
     * 厨师增加的效果值
     *
     * @var
     */
    const DBKey_cookDishesChefAddValue = "cookDishesChefAddValue";

	/**
	 * 获取 厨师增加的效果值
	 * @return int
	 */
	public function get_cookDishesChefAddValue()
	{
		return $this->getdata ( self::DBKey_cookDishesChefAddValue );
	}

	/**
	 * 设置 厨师增加的效果值
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_cookDishesChefAddValue($value)
	{
		$this->setdata ( self::DBKey_cookDishesChefAddValue, intval($value) );
		return $this;
	}

	/**
     * 重置 厨师增加的效果值
     * 设置为 0
     * @return $this
     */
    public function reset_cookDishesChefAddValue()
    {
        return $this->reset_defaultValue(self::DBKey_cookDishesChefAddValue);
    }

    /**
     * 设置 厨师增加的效果值 默认值
     */
    protected function _set_defaultvalue_cookDishesChefAddValue()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_cookDishesChefAddValue, 0 );
    }
    /**
     * 烹饪中的菜谱开始时间
     *
     * @var
     */
    const DBKey_cookDishesStartTime = "cookDishesStartTime";

	/**
	 * 获取 烹饪中的菜谱开始时间
	 * @return int
	 */
	public function get_cookDishesStartTime()
	{
		return $this->getdata ( self::DBKey_cookDishesStartTime );
	}

	/**
	 * 设置 烹饪中的菜谱开始时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_cookDishesStartTime($value)
	{
		$this->setdata ( self::DBKey_cookDishesStartTime, intval($value) );
		return $this;
	}

	/**
     * 重置 烹饪中的菜谱开始时间
     * 设置为 0
     * @return $this
     */
    public function reset_cookDishesStartTime()
    {
        return $this->reset_defaultValue(self::DBKey_cookDishesStartTime);
    }

    /**
     * 设置 烹饪中的菜谱开始时间 默认值
     */
    protected function _set_defaultvalue_cookDishesStartTime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_cookDishesStartTime, 0 );
    }
    /**
     * 烹饪中的菜谱结束时间
     *
     * @var
     */
    const DBKey_cookDishesEndTime = "cookDishesEndTime";

	/**
	 * 获取 烹饪中的菜谱结束时间
	 * @return int
	 */
	public function get_cookDishesEndTime()
	{
		return $this->getdata ( self::DBKey_cookDishesEndTime );
	}

	/**
	 * 设置 烹饪中的菜谱结束时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_cookDishesEndTime($value)
	{
		$this->setdata ( self::DBKey_cookDishesEndTime, intval($value) );
		return $this;
	}

	/**
     * 重置 烹饪中的菜谱结束时间
     * 设置为 0
     * @return $this
     */
    public function reset_cookDishesEndTime()
    {
        return $this->reset_defaultValue(self::DBKey_cookDishesEndTime);
    }

    /**
     * 设置 烹饪中的菜谱结束时间 默认值
     */
    protected function _set_defaultvalue_cookDishesEndTime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_cookDishesEndTime, 0 );
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
        //设置 烹饪台的等级 默认值
        $this->_set_defaultvalue_level();
        //设置 烹饪台状态 默认值
        $this->_set_defaultvalue_status();
        //设置 烹饪菜品ID 默认值
        $this->_set_defaultvalue_cookDishesId();
        //设置 烹饪中的菜谱ID 默认值
        $this->_set_defaultvalue_cookDishesCookbookId();
        //设置 烹饪出的份数 默认值
        $this->_set_defaultvalue_cookDishesPiece();
        //设置 烹饪当前步骤数 默认值
        $this->_set_defaultvalue_cookDishesCurrentStep();
        //设置 投入食材的详情 默认值
        $this->_set_defaultvalue_cookDishesMaterialDetails();
        //设置 烹饪投入的材料价值(最终值) 默认值
        $this->_set_defaultvalue_cookDishesMaterialValue();
        //设置 厨师增加的效果值 默认值
        $this->_set_defaultvalue_cookDishesChefAddValue();
        //设置 烹饪中的菜谱开始时间 默认值
        $this->_set_defaultvalue_cookDishesStartTime();
        //设置 烹饪中的菜谱结束时间 默认值
        $this->_set_defaultvalue_cookDishesEndTime();

    }
}