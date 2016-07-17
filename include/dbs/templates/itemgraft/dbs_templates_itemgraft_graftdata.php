<?php

namespace dbs\templates\itemgraft;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_itemgraft_graftdata
 * @package dbs\templates\itemgraft
 */
class dbs_templates_itemgraft_graftdata extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "itemgraft.graftdata" );
    }
    /**
     * 槽位位置
     *
     * @var
     */
    const DBKey_slotid = "slotid";

	/**
	 * 获取 槽位位置
	 * @return string
	 */
	public function get_slotid()
	{
		return $this->getdata ( self::DBKey_slotid );
	}

	/**
	 * 设置 槽位位置
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_slotid($value)
	{
		$this->setdata ( self::DBKey_slotid, strval($value) );
		return $this;
	}

	/**
     * 重置 槽位位置
     * 设置为 ""
     * @return $this
     */
    public function reset_slotid()
    {
        return $this->reset_defaultValue(self::DBKey_slotid);
    }

    /**
     * 设置 槽位位置 默认值
     */
    protected function _set_defaultvalue_slotid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_slotid, "" );
    }
    /**
     * 槽位状态,0:空闲,1:等待另一半,2:合成中,3:合成完成
     *
     * @var
     */
    const DBKey_slotStatus = "slotStatus";

	/**
	 * 获取 槽位状态,0:空闲,1:等待另一半,2:合成中,3:合成完成
	 * @return int
	 */
	public function get_slotStatus()
	{
		return $this->getdata ( self::DBKey_slotStatus );
	}

	/**
	 * 设置 槽位状态,0:空闲,1:等待另一半,2:合成中,3:合成完成
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_slotStatus($value)
	{
		$this->setdata ( self::DBKey_slotStatus, intval($value) );
		return $this;
	}

	/**
     * 重置 槽位状态,0:空闲,1:等待另一半,2:合成中,3:合成完成
     * 设置为 0
     * @return $this
     */
    public function reset_slotStatus()
    {
        return $this->reset_defaultValue(self::DBKey_slotStatus);
    }

    /**
     * 设置 槽位状态,0:空闲,1:等待另一半,2:合成中,3:合成完成 默认值
     */
    protected function _set_defaultvalue_slotStatus()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_slotStatus, 0 );
    }
    /**
     * 道具ID1
     *
     * @var
     */
    const DBKey_itemid1 = "itemid1";

	/**
	 * 获取 道具ID1
	 * @return string
	 */
	public function get_itemid1()
	{
		return $this->getdata ( self::DBKey_itemid1 );
	}

	/**
	 * 设置 道具ID1
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_itemid1($value)
	{
		$this->setdata ( self::DBKey_itemid1, strval($value) );
		return $this;
	}

	/**
     * 重置 道具ID1
     * 设置为 ""
     * @return $this
     */
    public function reset_itemid1()
    {
        return $this->reset_defaultValue(self::DBKey_itemid1);
    }

    /**
     * 设置 道具ID1 默认值
     */
    protected function _set_defaultvalue_itemid1()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_itemid1, "" );
    }
    /**
     * 道具数量1
     *
     * @var
     */
    const DBKey_itemcount1 = "itemcount1";

	/**
	 * 获取 道具数量1
	 * @return int
	 */
	public function get_itemcount1()
	{
		return $this->getdata ( self::DBKey_itemcount1 );
	}

	/**
	 * 设置 道具数量1
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_itemcount1($value)
	{
		$this->setdata ( self::DBKey_itemcount1, intval($value) );
		return $this;
	}

	/**
     * 重置 道具数量1
     * 设置为 0
     * @return $this
     */
    public function reset_itemcount1()
    {
        return $this->reset_defaultValue(self::DBKey_itemcount1);
    }

    /**
     * 设置 道具数量1 默认值
     */
    protected function _set_defaultvalue_itemcount1()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_itemcount1, 0 );
    }
    /**
     * 道具ID2
     *
     * @var
     */
    const DBKey_itemid2 = "itemid2";

	/**
	 * 获取 道具ID2
	 * @return string
	 */
	public function get_itemid2()
	{
		return $this->getdata ( self::DBKey_itemid2 );
	}

	/**
	 * 设置 道具ID2
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_itemid2($value)
	{
		$this->setdata ( self::DBKey_itemid2, strval($value) );
		return $this;
	}

	/**
     * 重置 道具ID2
     * 设置为 ""
     * @return $this
     */
    public function reset_itemid2()
    {
        return $this->reset_defaultValue(self::DBKey_itemid2);
    }

    /**
     * 设置 道具ID2 默认值
     */
    protected function _set_defaultvalue_itemid2()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_itemid2, "" );
    }
    /**
     * 道具数量2
     *
     * @var
     */
    const DBKey_itemcount2 = "itemcount2";

	/**
	 * 获取 道具数量2
	 * @return int
	 */
	public function get_itemcount2()
	{
		return $this->getdata ( self::DBKey_itemcount2 );
	}

	/**
	 * 设置 道具数量2
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_itemcount2($value)
	{
		$this->setdata ( self::DBKey_itemcount2, intval($value) );
		return $this;
	}

	/**
     * 重置 道具数量2
     * 设置为 0
     * @return $this
     */
    public function reset_itemcount2()
    {
        return $this->reset_defaultValue(self::DBKey_itemcount2);
    }

    /**
     * 设置 道具数量2 默认值
     */
    protected function _set_defaultvalue_itemcount2()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_itemcount2, 0 );
    }
    /**
     * 应答嫁接请求的人群信息
     *
     * @var
     */
    const DBKey_answerPlayerInfos = "answerPlayerInfos";

	/**
	 * 获取 应答嫁接请求的人群信息
	 * @return array
	 */
	public function get_answerPlayerInfos()
	{
		return $this->getdata ( self::DBKey_answerPlayerInfos );
	}

	/**
	 * 设置 应答嫁接请求的人群信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_answerPlayerInfos($value)
	{
		$this->setdata ( self::DBKey_answerPlayerInfos, $value );
		return $this;
	}

	/**
     * 重置 应答嫁接请求的人群信息
     * 设置为 []
     * @return $this
     */
    public function reset_answerPlayerInfos()
    {
        return $this->reset_defaultValue(self::DBKey_answerPlayerInfos);
    }

    /**
     * 设置 应答嫁接请求的人群信息 默认值
     */
    protected function _set_defaultvalue_answerPlayerInfos()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_answerPlayerInfos, [] );
    }
    /**
     * 帮忙的人得信息
     *
     * @var
     */
    const DBKey_helpPlayerInfo = "helpPlayerInfo";

	/**
	 * 获取 帮忙的人得信息
	 * @return array
	 */
	public function get_helpPlayerInfo()
	{
		return $this->getdata ( self::DBKey_helpPlayerInfo );
	}

	/**
	 * 设置 帮忙的人得信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_helpPlayerInfo($value)
	{
		$this->setdata ( self::DBKey_helpPlayerInfo, $value );
		return $this;
	}

	/**
     * 重置 帮忙的人得信息
     * 设置为 []
     * @return $this
     */
    public function reset_helpPlayerInfo()
    {
        return $this->reset_defaultValue(self::DBKey_helpPlayerInfo);
    }

    /**
     * 设置 帮忙的人得信息 默认值
     */
    protected function _set_defaultvalue_helpPlayerInfo()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_helpPlayerInfo, [] );
    }
    /**
     * 配方id
     *
     * @var
     */
    const DBKey_formulaid = "formulaid";

	/**
	 * 获取 配方id
	 * @return int
	 */
	public function get_formulaid()
	{
		return $this->getdata ( self::DBKey_formulaid );
	}

	/**
	 * 设置 配方id
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_formulaid($value)
	{
		$this->setdata ( self::DBKey_formulaid, intval($value) );
		return $this;
	}

	/**
     * 重置 配方id
     * 设置为 -1
     * @return $this
     */
    public function reset_formulaid()
    {
        return $this->reset_defaultValue(self::DBKey_formulaid);
    }

    /**
     * 设置 配方id 默认值
     */
    protected function _set_defaultvalue_formulaid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_formulaid, -1 );
    }
    /**
     * 准备时间
     *
     * @var
     */
    const DBKey_preparetime = "preparetime";

	/**
	 * 获取 准备时间
	 * @return int
	 */
	public function get_preparetime()
	{
		return $this->getdata ( self::DBKey_preparetime );
	}

	/**
	 * 设置 准备时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_preparetime($value)
	{
		$this->setdata ( self::DBKey_preparetime, intval($value) );
		return $this;
	}

	/**
     * 重置 准备时间
     * 设置为 0
     * @return $this
     */
    public function reset_preparetime()
    {
        return $this->reset_defaultValue(self::DBKey_preparetime);
    }

    /**
     * 设置 准备时间 默认值
     */
    protected function _set_defaultvalue_preparetime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_preparetime, 0 );
    }
    /**
     * 冷却时间
     *
     * @var
     */
    const DBKey_finishtime = "finishtime";

	/**
	 * 获取 冷却时间
	 * @return int
	 */
	public function get_finishtime()
	{
		return $this->getdata ( self::DBKey_finishtime );
	}

	/**
	 * 设置 冷却时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_finishtime($value)
	{
		$this->setdata ( self::DBKey_finishtime, intval($value) );
		return $this;
	}

	/**
     * 重置 冷却时间
     * 设置为 0
     * @return $this
     */
    public function reset_finishtime()
    {
        return $this->reset_defaultValue(self::DBKey_finishtime);
    }

    /**
     * 设置 冷却时间 默认值
     */
    protected function _set_defaultvalue_finishtime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_finishtime, 0 );
    }
    /**
     * 结果1加成详细信息
     *
     * @var
     */
    const DBKey_resultaddweightinfo0 = "resultaddweightinfo0";

	/**
	 * 获取 结果1加成详细信息
	 * @return array
	 */
	public function get_resultaddweightinfo0()
	{
		return $this->getdata ( self::DBKey_resultaddweightinfo0 );
	}

	/**
	 * 设置 结果1加成详细信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_resultaddweightinfo0($value)
	{
		$this->setdata ( self::DBKey_resultaddweightinfo0, $value );
		return $this;
	}

	/**
     * 重置 结果1加成详细信息
     * 设置为 []
     * @return $this
     */
    public function reset_resultaddweightinfo0()
    {
        return $this->reset_defaultValue(self::DBKey_resultaddweightinfo0);
    }

    /**
     * 设置 结果1加成详细信息 默认值
     */
    protected function _set_defaultvalue_resultaddweightinfo0()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_resultaddweightinfo0, [] );
    }
    /**
     * 结果2加成详细信息
     *
     * @var
     */
    const DBKey_resultaddweightinfo1 = "resultaddweightinfo1";

	/**
	 * 获取 结果2加成详细信息
	 * @return array
	 */
	public function get_resultaddweightinfo1()
	{
		return $this->getdata ( self::DBKey_resultaddweightinfo1 );
	}

	/**
	 * 设置 结果2加成详细信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_resultaddweightinfo1($value)
	{
		$this->setdata ( self::DBKey_resultaddweightinfo1, $value );
		return $this;
	}

	/**
     * 重置 结果2加成详细信息
     * 设置为 []
     * @return $this
     */
    public function reset_resultaddweightinfo1()
    {
        return $this->reset_defaultValue(self::DBKey_resultaddweightinfo1);
    }

    /**
     * 设置 结果2加成详细信息 默认值
     */
    protected function _set_defaultvalue_resultaddweightinfo1()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_resultaddweightinfo1, [] );
    }
    /**
     * 结果3加成详细信息
     *
     * @var
     */
    const DBKey_resultaddweightinfo2 = "resultaddweightinfo2";

	/**
	 * 获取 结果3加成详细信息
	 * @return array
	 */
	public function get_resultaddweightinfo2()
	{
		return $this->getdata ( self::DBKey_resultaddweightinfo2 );
	}

	/**
	 * 设置 结果3加成详细信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_resultaddweightinfo2($value)
	{
		$this->setdata ( self::DBKey_resultaddweightinfo2, $value );
		return $this;
	}

	/**
     * 重置 结果3加成详细信息
     * 设置为 []
     * @return $this
     */
    public function reset_resultaddweightinfo2()
    {
        return $this->reset_defaultValue(self::DBKey_resultaddweightinfo2);
    }

    /**
     * 设置 结果3加成详细信息 默认值
     */
    protected function _set_defaultvalue_resultaddweightinfo2()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_resultaddweightinfo2, [] );
    }
    /**
     * 结果3加成详细信息
     *
     * @var
     */
    const DBKey_resultaddweightinfo3 = "resultaddweightinfo3";

	/**
	 * 获取 结果3加成详细信息
	 * @return array
	 */
	public function get_resultaddweightinfo3()
	{
		return $this->getdata ( self::DBKey_resultaddweightinfo3 );
	}

	/**
	 * 设置 结果3加成详细信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_resultaddweightinfo3($value)
	{
		$this->setdata ( self::DBKey_resultaddweightinfo3, $value );
		return $this;
	}

	/**
     * 重置 结果3加成详细信息
     * 设置为 []
     * @return $this
     */
    public function reset_resultaddweightinfo3()
    {
        return $this->reset_defaultValue(self::DBKey_resultaddweightinfo3);
    }

    /**
     * 设置 结果3加成详细信息 默认值
     */
    protected function _set_defaultvalue_resultaddweightinfo3()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_resultaddweightinfo3, [] );
    }
    /**
     * 是否发布了广告
     *
     * @var
     */
    const DBKey_publishAdvertisement = "publishAdvertisement";

	/**
	 * 获取 是否发布了广告
	 * @return bool
	 */
	public function get_publishAdvertisement()
	{
		return $this->getdata ( self::DBKey_publishAdvertisement );
	}

	/**
	 * 设置 是否发布了广告
	 *
	 * @param bool $value
	 * @return $this
	 */
	public function set_publishAdvertisement($value)
	{
		$this->setdata ( self::DBKey_publishAdvertisement, boolval($value) );
		return $this;
	}

	/**
     * 重置 是否发布了广告
     * 设置为 false
     * @return $this
     */
    public function reset_publishAdvertisement()
    {
        return $this->reset_defaultValue(self::DBKey_publishAdvertisement);
    }

    /**
     * 设置 是否发布了广告 默认值
     */
    protected function _set_defaultvalue_publishAdvertisement()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_publishAdvertisement, false );
    }
    /**
     * 广告ID
     *
     * @var
     */
    const DBKey_AdvertisementId = "AdvertisementId";

	/**
	 * 获取 广告ID
	 * @return string
	 */
	public function get_AdvertisementId()
	{
		return $this->getdata ( self::DBKey_AdvertisementId );
	}

	/**
	 * 设置 广告ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_AdvertisementId($value)
	{
		$this->setdata ( self::DBKey_AdvertisementId, strval($value) );
		return $this;
	}

	/**
     * 重置 广告ID
     * 设置为 ""
     * @return $this
     */
    public function reset_AdvertisementId()
    {
        return $this->reset_defaultValue(self::DBKey_AdvertisementId);
    }

    /**
     * 设置 广告ID 默认值
     */
    protected function _set_defaultvalue_AdvertisementId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_AdvertisementId, "" );
    }
    /**
     * 广告过期时间
     *
     * @var
     */
    const DBKey_AdvertisementExpiredTime = "AdvertisementExpiredTime";

	/**
	 * 获取 广告过期时间
	 * @return int
	 */
	public function get_AdvertisementExpiredTime()
	{
		return $this->getdata ( self::DBKey_AdvertisementExpiredTime );
	}

	/**
	 * 设置 广告过期时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_AdvertisementExpiredTime($value)
	{
		$this->setdata ( self::DBKey_AdvertisementExpiredTime, intval($value) );
		return $this;
	}

	/**
     * 重置 广告过期时间
     * 设置为 0
     * @return $this
     */
    public function reset_AdvertisementExpiredTime()
    {
        return $this->reset_defaultValue(self::DBKey_AdvertisementExpiredTime);
    }

    /**
     * 设置 广告过期时间 默认值
     */
    protected function _set_defaultvalue_AdvertisementExpiredTime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_AdvertisementExpiredTime, 0 );
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
        //设置 槽位位置 默认值
        $this->_set_defaultvalue_slotid();
        //设置 槽位状态,0:空闲,1:等待另一半,2:合成中,3:合成完成 默认值
        $this->_set_defaultvalue_slotStatus();
        //设置 道具ID1 默认值
        $this->_set_defaultvalue_itemid1();
        //设置 道具数量1 默认值
        $this->_set_defaultvalue_itemcount1();
        //设置 道具ID2 默认值
        $this->_set_defaultvalue_itemid2();
        //设置 道具数量2 默认值
        $this->_set_defaultvalue_itemcount2();
        //设置 应答嫁接请求的人群信息 默认值
        $this->_set_defaultvalue_answerPlayerInfos();
        //设置 帮忙的人得信息 默认值
        $this->_set_defaultvalue_helpPlayerInfo();
        //设置 配方id 默认值
        $this->_set_defaultvalue_formulaid();
        //设置 准备时间 默认值
        $this->_set_defaultvalue_preparetime();
        //设置 冷却时间 默认值
        $this->_set_defaultvalue_finishtime();
        //设置 结果1加成详细信息 默认值
        $this->_set_defaultvalue_resultaddweightinfo0();
        //设置 结果2加成详细信息 默认值
        $this->_set_defaultvalue_resultaddweightinfo1();
        //设置 结果3加成详细信息 默认值
        $this->_set_defaultvalue_resultaddweightinfo2();
        //设置 结果3加成详细信息 默认值
        $this->_set_defaultvalue_resultaddweightinfo3();
        //设置 是否发布了广告 默认值
        $this->_set_defaultvalue_publishAdvertisement();
        //设置 广告ID 默认值
        $this->_set_defaultvalue_AdvertisementId();
        //设置 广告过期时间 默认值
        $this->_set_defaultvalue_AdvertisementExpiredTime();

    }
}