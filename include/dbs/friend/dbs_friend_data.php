<?php

namespace dbs\friend;

use dbs\templates\friend\dbs_templates_friend_data;

/**
 * 好友数据
 *
 * @author zhipeng
 *
 */
class dbs_friend_data extends dbs_templates_friend_data
{

    /**
     * @return dbs_friend_goodwill
     */
    public function getGoodWillData()
    {
        return dbs_friend_goodwill::getGoodWillByGuid($this->get_goodwillGUID());
    }
}