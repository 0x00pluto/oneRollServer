<?php

namespace dbs\friend;

use dbs\templates\friend\dbs_templates_friend_recommenddata;

/**
 * 好友推荐数据
 * 2015年11月25日 下午5:14:12
 *
 * @author zhipeng
 *
 */
class dbs_friend_recommenddata extends dbs_templates_friend_recommenddata
{
    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);
    }
}