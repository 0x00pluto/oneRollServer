<?php

namespace dbs\templates\records;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_records_recordData
 * @package dbs\templates\records
 */
class dbs_templates_records_recordData extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "records.recordData" );
    }
    /**
     * 商品ID
     *
     * @var
     */
    const DBKey_GoodsId = "GoodsId";

	/**
	 * 获取 商品ID
	 * @return string
	 */
	public function get_GoodsId()
	{
		return $this->getdata ( self::DBKey_GoodsId );
	}

	/**
	 * 设置 商品ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_GoodsId($value)
	{
		$this->setdata ( self::DBKey_GoodsId, strval($value) );
		return $this;
	}

	/**
     * 重置 商品ID
     * 设置为 ""
     * @return $this
     */
    public function reset_GoodsId()
    {
        return $this->reset_defaultValue(self::DBKey_GoodsId);
    }

    /**
     * 设置 商品ID 默认值
     */
    protected function _set_defaultvalue_GoodsId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_GoodsId, "" );
    }
    /**
     * 中奖号
     *
     * @var
     */
    const DBKey_Codes = "Codes";

	/**
	 * 获取 中奖号
	 * @return array
	 */
	public function get_Codes()
	{
		return $this->getdata ( self::DBKey_Codes );
	}

	/**
	 * 设置 中奖号
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_Codes($value)
	{
		$this->setdata ( self::DBKey_Codes, $value );
		return $this;
	}

	/**
     * 重置 中奖号
     * 设置为 []
     * @return $this
     */
    public function reset_Codes()
    {
        return $this->reset_defaultValue(self::DBKey_Codes);
    }

    /**
     * 设置 中奖号 默认值
     */
    protected function _set_defaultvalue_Codes()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_Codes, [] );
    }
    /**
     * 是否中奖
     *
     * @var
     */
    const DBKey_isWin = "isWin";

	/**
	 * 获取 是否中奖
	 * @return bool
	 */
	public function get_isWin()
	{
		return $this->getdata ( self::DBKey_isWin );
	}

	/**
	 * 设置 是否中奖
	 *
	 * @param bool $value
	 * @return $this
	 */
	public function set_isWin($value)
	{
		$this->setdata ( self::DBKey_isWin, boolval($value) );
		return $this;
	}

	/**
     * 重置 是否中奖
     * 设置为 false
     * @return $this
     */
    public function reset_isWin()
    {
        return $this->reset_defaultValue(self::DBKey_isWin);
    }

    /**
     * 设置 是否中奖 默认值
     */
    protected function _set_defaultvalue_isWin()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_isWin, false );
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
        //设置 商品ID 默认值
        $this->_set_defaultvalue_GoodsId();
        //设置 中奖号 默认值
        $this->_set_defaultvalue_Codes();
        //设置 是否中奖 默认值
        $this->_set_defaultvalue_isWin();

    }
}