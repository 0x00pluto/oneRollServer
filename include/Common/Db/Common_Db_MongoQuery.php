<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/8/2
 * Time: 下午3:21
 */

namespace Common\Db;


class Common_Db_MongoQuery
{

    /**
     * @var \MongoCursor
     */
    private $queryCursor = null;

    /**
     * Common_Db_MongoQuery constructor.
     * @param \MongoCursor $queryCursor
     */
    private function __construct($queryCursor)
    {
        $this->queryCursor = $queryCursor;
    }

    /**
     * @param \MongoCursor $queryCursor
     * @return Common_Db_MongoQuery
     */
    public static function create(\MongoCursor $queryCursor)
    {
        $ins = new Common_Db_MongoQuery($queryCursor);
        return $ins;
    }

    /**
     * @return \MongoCursor
     */
    public function getCursor()
    {
        return $this->queryCursor;
    }

    /**
     * 获取数据结果
     * @return array
     */
    public function getResults()
    {
        $result = [];
        foreach ($this->queryCursor as $id => $value) {
            $result [] = $value;
        }
        return $result;
    }
}