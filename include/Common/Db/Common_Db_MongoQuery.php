<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/8/2
 * Time: 下午3:21
 */

namespace Common\Db;


use MongoDB\Driver\Cursor;

class Common_Db_MongoQuery
{

    /**
     * @var Cursor
     */
    private $queryCursor = null;

    /**
     * Common_Db_MongoQuery constructor.
     * @param Cursor $queryCursor
     */
    private function __construct($queryCursor)
    {
        $this->queryCursor = $queryCursor;
    }

    /**
     * @return Common_Db_MongoQuery
     * @param Cursor $queryCursor
     */
    public static function create(Cursor $queryCursor)
    {
        $queryCursor->setTypeMap([
            'root' => 'array', 'document' => 'array'
        ]);
        $ins = new Common_Db_MongoQuery($queryCursor);
        return $ins;
    }

    /**
     * @return Cursor
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
        $result = $this->queryCursor->toArray();
//        var_dump($result);
        return $result;
    }
}