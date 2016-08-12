<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/8/11
 * Time: 下午6:43
 */

namespace dbs\records;


use constants\constants_recordsAccept;
use dbs\templates\records\dbs_templates_records_acceptRecords;

class dbs_records_acceptRecord extends dbs_templates_records_acceptRecords
{
    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);

        $this->ensureIndex([
            self::DBKey_userid => 1,
            self::DBKey_goodsId => 1
        ]);
        $this->setAutoSave(false);
    }

    protected function _set_defaultvalue_acceptRecordSignIn()
    {
        $this->set_defaultkeyandvalue(self::DBKey_acceptRecordSignIn, dbs_records_acceptRecordSignInData::dumpDefaultValue());
    }

    protected function _set_defaultvalue_acceptRecordTransferData()
    {
        $this->set_defaultkeyandvalue(self::DBKey_acceptRecordTransferData, dbs_records_acceptRecordTransferData::dumpDefaultValue());
    }

    protected function _set_defaultvalue_acceptRecordUserData()
    {
        $this->set_defaultkeyandvalue(self::DBKey_acceptRecordUserData, dbs_records_acceptRecordUserData::dumpDefaultValue());
    }


    /**
     *
     * @param dbs_records_deactive $record
     * @return static
     */
    static function create(dbs_records_deactive $record)
    {
        $ins = self::findOrNew([
            self::DBKey_userid => $record->get_userid(),
            self::DBKey_goodsId => $record->get_goodsId()
        ]);

        if ($ins->exist()) {
            return $ins;
        }

        $ins->set_goodsId($record->get_goodsId());
        $ins->set_userid($record->get_userid());

        $ins->set_status(constants_recordsAccept::STATUS_WAIT_CONFIRM_ADDRESS);

        return $ins;
    }

    /**
     * 获取用户的获奖订单
     * @param $userid
     * @param int $start
     * @param int $count
     * @return static[]
     */
    static function getAll($userid, $start = -1, $count = 2)
    {
        $records = self::all([
            self::DBKey_userid => $userid
        ], $start, $count);

        return $records;
    }
}

