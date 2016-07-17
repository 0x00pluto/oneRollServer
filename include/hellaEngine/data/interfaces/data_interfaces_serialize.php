<?php

namespace hellaEngine\data\interfaces;

/**
 * 数据序列化接口
 *
 * @author zhipeng
 *
 */
interface data_interfaces_serialize
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
    public function toArray($filter = [], $excludefilter = []);

    /**
     * 反序列化
     *
     * @param array $arr
     * @param array $exclude
     *            不同步的字段
     *            ('key'=>1)
     */
    public function fromArray($arr, $exclude = NULL);
}