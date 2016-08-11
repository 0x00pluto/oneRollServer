<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/8/2
 * Time: 下午4:42
 */

namespace dbs\records;


use dbs\dbs_player;
use dbs\templates\records\dbs_templates_records_deactive;

class dbs_records_deactive extends dbs_templates_records_deactive
{

    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);
        $this->setAutoSave(false);

        $this->ensureIndex([
            self::DBKey_userid => 1,
            self::DBKey_goodsId => 1
        ]);

    }


    /**
     * @param dbs_player $player
     * @param dbs_records_recordData $data
     */
    public function setRecord(dbs_player $player, dbs_records_recordData $data)
    {

        $this->set_userid($player->get_userid());
        $this->set_goodsId($data->get_GoodsId());
        $this->set_recordData($data->toArray());
    }


    /**
     * @param dbs_player $player
     * @param dbs_records_recordData $data
     * @return static
     */
    public static function create(dbs_player $player, dbs_records_recordData $data)
    {
        $ins = self::findOrNew([
            self::DBKey_userid => $player->get_userid(),
            self::DBKey_goodsId => $data->get_GoodsId()
        ]);

        $ins->setRecord($player, $data);
        return $ins;
    }

    /**
     * @param dbs_player $player
     * @param int $start
     * @param int $limit
     * @return static[]
     */
    public static function getRecords(dbs_player $player, $start = 0, $limit = -1)
    {
        $records = self::all([self::DBKey_userid => $player->get_userid()], $start, $limit);

        return $records;
    }
}