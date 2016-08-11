<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/8/5
 * Time: 下午6:38
 */

namespace dbs\mall;


use constants\constants_time;
use dbs\templates\mall\dbs_templates_mall_remoteRollNum;
use utilphp\util;

class dbs_mall_remoteRollNum extends dbs_templates_mall_remoteRollNum
{
    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);
        $this->set_primary_key(self::DBKey_id);
        $this->setAutoSave(false);
    }


    /**
     * 获取时时彩数据
     * @param $sscId
     * @return static
     */
    static function getCqsscData($sscId)
    {
        if (!util::starts_with($sscId, "cqssc_")) {
            $sscId = "cqssc_" . $sscId;
        }

//        dump($sscId);

        $ins = self::findOrNew([self::DBKey_id => $sscId]);
        return $ins;
    }

    static function saveCqsscData(array $data)
    {
        /**
         *
         * array(4)
         * [
         * "rows" => int(1)
         * "code" => string(5) "cqssc"
         * "info" => string(101) "免费接口随机延迟3-5分钟，实时接口请访问opencai.net或QQ:9564384(注明彩票或API)"
         * "data" =>  array(1)
         * [
         * 0 =>  array(4)
         * [
         * "expect"        => string(11) "20160805076"
         * "opencode"      => string(9) "8,7,6,4,4"
         * "opentime"      => string(19) "2016-08-05 18:40:40"
         * "opentimestamp" => int(1470393640)
         * ]
         * ]
         * ]
         */
        $caipaiData = $data["data"][0];
        $key = "cqssc_" . $caipaiData['expect'];
        $ins = self::findOrNew([self::DBKey_id => $key]);
        if ($ins->exist()) {
            return;
        }
        $ins->set_id("cqssc_" . $caipaiData['expect']);
        $ins->set_expect($caipaiData['expect']);
        $openCodes = explode(',', $caipaiData['opencode']);

        $code = "";
        foreach ($openCodes as $openCode) {

            $code .= $openCode;
        }
        $ins->set_opencode(intval($code));
        $ins->set_opentime($caipaiData['opentime']);
        $ins->set_opentimestamp($caipaiData['opentimestamp']);
        $ins->set_originData($data);

        $ins->saveToDB();
    }


    static function getRemoteRollNum()
    {
        $ins = new static();

        return $ins;
    }

    /**
     * 获取开奖期数
     * @param $timeSpan
     * @return float|int
     */
    static function getRemoteRollId($timeSpan)
    {
        $seconds = $timeSpan % constants_time::SECONDS_ONE_DAY;

        $sequenceId = 0;
        if ($seconds == 0) {
            $seconds = constants_time::SECONDS_ONE_DAY;
        }
//        dump($seconds);
        //00:00~02:00 每五分钟一期
        if ($seconds > 0 && $seconds < 2 * 60 * 60) {
            $sequenceId = ceil($seconds / 300);
        } elseif ($seconds <= 10 * 60 * 60) {
            $sequenceId = 24;
        } elseif ($seconds <= 22 * 60 * 60) {
            //10:00~22:00 每10分钟一期
            $sequenceId = 24 + ceil(($seconds - 10 * 60 * 60) / (10 * 60));
        } else {
            //22:00~00:00 每5分钟一期
            $sequenceId = 24 + 72;
            $sequenceId = $sequenceId + ceil(($seconds - 22 * 60 * 60) / (5 * 60));
        }

        self::getRemoteNumOpenTime($sequenceId);
        return $sequenceId;
    }

    /**
     * 获取下次开启时间
     * @param $sequenceId
     * @return int
     */
    static function getRemoteNumOpenTime($sequenceId)
    {
        $offsetSeconds = 0;
        if ($sequenceId < 24) {
            $offsetSeconds = $sequenceId * 5 * 60;
        } elseif ($sequenceId == 24) {
            $offsetSeconds = 10 * 60 * 60;
        } elseif ($sequenceId <= 96) {
            $offsetSeconds = 10 * 60 * 60 + ($sequenceId - 24) * 10 * 60;
        } else {
            $offsetSeconds = 22 * 60 * 60 + ($sequenceId - 96) * 5 * 60;
        }
        return $offsetSeconds;

    }


}