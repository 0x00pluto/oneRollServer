<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/12/17
 * Time: 下午5:36
 */

namespace dbs\neighbourhood;


use Common\Db\Common_Db_mongo;
use Common\Util\Common_Util_ReturnVar;
use dbs\bulletinboard\dbs_bulletinboard_bulletinboarddata;
use dbs\templates\neighbourhood\dbs_templates_neighbourhood_groupbulletinboard;

class dbs_neighbourhood_groupbulletinboard extends dbs_templates_neighbourhood_groupbulletinboard
{
    //TODO 这部分少了锁操作,有可能产生脏数据

    /**
     * dbs_neighbourhood_groupbulletinboard constructor.
     */
    public function __construct()
    {
        parent::__construct(self::DBKey_tablename, [],
            [self::DBKey_guid]);
    }

    protected function loadFromDBAfter(Common_Db_mongo $db)
    {
        //处理过期数据
//        dump("loadFromDBAfter");

        $this->processExpiredDatas();
    }

    /**
     * 处理过期公告
     */
    private function processExpiredDatas()
    {
        $dataChange = false;
        $bulletinBoards = $this->get_bulletinDatas();
        foreach ($bulletinBoards as $key => $bulletinBoard) {
            $bulletinBoardData = dbs_bulletinboard_bulletinboarddata::create_with_array($bulletinBoard);
            if ($bulletinBoardData->expired()) {
                unset($bulletinBoards[$key]);
                $dataChange = true;
            }

        }
        if ($dataChange) {
            $this->set_bulletinDatas($bulletinBoards);
        }
    }


    /**
     * 发布公告
     * @param dbs_bulletinboard_bulletinboarddata $bulletinBoardData
     * @return Common_Util_ReturnVar
     */
    public function publishBulletin(dbs_bulletinboard_bulletinboarddata $bulletinBoardData)
    {
        $data = [];

        $bulletinBoards = $this->get_bulletinDatas();
        $bulletinBoards[] = $bulletinBoardData->toArray();
        $this->set_bulletinDatas($bulletinBoards);

        $this->saveToDB(true);
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 删除广告
     * @param string $guid 广告id
     * @return bool
     */
    public function deleteBulletin($guid)
    {
        $bulletinBoards = $this->get_bulletinDatas();
        foreach ($bulletinBoards as $key => $bulletinBoard) {
            if ($bulletinBoard[dbs_bulletinboard_bulletinboarddata::DBKey_guid] === $guid) {
                unset($bulletinBoards[$key]);
                break;
            }
        }
        $this->set_bulletinDatas($bulletinBoards);
        $this->saveToDB(true);
        return true;
    }


}