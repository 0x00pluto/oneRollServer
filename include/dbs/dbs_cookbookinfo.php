<?php

namespace dbs;

use dbs\templates\cookbook\dbs_templates_cookbook_cookbookinfo;

/**
 * 菜谱信息
 *
 * @author zhipeng
 *
 */
class dbs_cookbookinfo extends dbs_templates_cookbook_cookbookinfo
{

    /**
     * 增加烹饪次数
     * @param int $num
     */
    public function addCookingTimes($num = 1)
    {
        $count = $this->get_cookingtimes();
        $count += $num;
        $this->set_cookingtimes($count);
    }

    /**
     * @param $bookId
     * @return dbs_cookbookinfo
     */
    public static function createWithBookId($bookId)
    {
        $ins = new self();
        $ins->set_bookid($bookId);
        return $ins;

    }

}