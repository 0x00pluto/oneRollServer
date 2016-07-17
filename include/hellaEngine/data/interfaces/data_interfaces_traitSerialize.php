<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/1/14
 * Time: 上午11:37
 */

namespace hellaEngine\data\interfaces;


trait data_interfaces_traitSerialize
{
    /**
     * 获取原始数据
     *
     * @param array $filter
     *            数据模板,返回指定的字段,如果为NULL 则返回全部字段,格式为 array('key1','key2');
     * @param array $excludefilter
     *            排除的关键字,格式为 array('key3','key4);
     *            如果包含和排除同时存在,则先执行包含,再执行排除
     * @return array
     */
    abstract public function toArray($filter = NULL, $excludefilter = NULL);

    /**
     * 反序列化
     *
     * @param array $arr
     * @param array $exclude
     *            不同步的字段
     *            ('key'=>1)
     */
    abstract public function fromArray($arr, $exclude = NULL);
}