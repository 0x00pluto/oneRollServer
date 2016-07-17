<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/1/14
 * Time: 上午11:26
 */

namespace dbs\scene\buildingExtend;

use dbs\scene\dbs_scene_buildingData;
use hellaEngine\data\interfaces\data_interfaces_traitSerialize;

/**
 * 建中通用扩展信息操作
 * Class dbs_scene_buildingExtend_operate
 * @package dbs\scene\buildingExtend
 */
trait dbs_scene_buildingExtend_operate
{
    use data_interfaces_traitSerialize;
    /**
     * @var dbs_scene_buildingData
     */
    private $buildData;

    /**
     * 属性关键字
     * @return string
     */
    abstract public function getExtendKey();

    /**
     * @return dbs_scene_buildingData
     */
    public function getBuildingData()
    {
        return $this->buildData;
    }

    /**
     * @param dbs_scene_buildingData $buildData
     * @return null
     */
    public function setBuildingData(dbs_scene_buildingData $buildData)
    {
        $this->buildData = $buildData;
        $this->load();
    }

    /**
     * 加载数据
     */
    protected function load()
    {
        $buildingData = $this->getBuildingData();
        assert($buildingData instanceof dbs_scene_buildingData);
        $extendInfos = $buildingData->get_extendInfo();
        if (isset($extendInfos[$this->getExtendKey()])) {
            $this->fromArray($extendInfos[$this->getExtendKey()]);
        } else {
            //如果没有数据,则保存默认数据上去
            $this->save();
        }

    }

    /**
     * 保存数据
     */
    public function save()
    {

        $buildingData = $this->getBuildingData();
        assert($buildingData instanceof dbs_scene_buildingData);
        $extendInfos = $buildingData->get_extendInfo();
        $extendInfos[$this->getExtendKey()] = $this->toArray();
        $buildingData->set_extendInfo($extendInfos);
    }


    /**
     * 创建实例
     * @param dbs_scene_buildingData $buildData
     * @return static
     */
    static public function create(dbs_scene_buildingData $buildData)
    {
        $ins = new static();
        $ins->setBuildingData($buildData);
        return $ins;
    }

}