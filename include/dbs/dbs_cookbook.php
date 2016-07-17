<?php

namespace dbs;

use Common\Util\Common_Util_Configdata;
use Common\Util\Common_Util_ReturnVar;
use configdata\configdata_cook_book_setting;
use dbs\templates\cookbook\dbs_templates_cookbook_cookbook;
use err\err_dbs_cookbook_learncookbook;

/**
 * 菜谱数据类
 *
 * @author zhipeng
 *
 */
class dbs_cookbook extends dbs_templates_cookbook_cookbook
{
    /**
     * 获取菜谱配置
     *
     * @param string $cookbookId
     * @return Ambigous <multitype:, string>
     */
    static function getCookbookConf($cookbookId)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_cook_book_setting::class,
            configdata_cook_book_setting::k_id, $cookbookId);
    }


    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);
    }

    /**
     * 学习菜谱
     * @param string $cookbookid 菜谱ID
     * 是否是自动开启的
     * @return Common_Util_ReturnVar
     */
    public function learncookbook($cookbookid)
    {
        $data = [];
        typeCheckString($cookbookid);

        $config = self::getCookbookConf($cookbookid);
        logicErrorCondition(!is_null($config),
            err_dbs_cookbook_learncookbook::CONFIG_ERROR,
            "CONFIG_ERROR");

        // 已经学会了
        logicErrorCondition(!$this->enabled($cookbookid),
            err_dbs_cookbook_learncookbook::COOKBOOK_EXIST,
            "COOKBOOK_EXIST");

        // 等级不够
        $needlevel = intval($config [configdata_cook_book_setting::k_openlevel]);

        logicErrorCondition($this->db_owner->db_restaurantinfo()->get_restaurantlevel() >= $needlevel,
            err_dbs_cookbook_learncookbook::LEVEL_NOT_ENOUGH,
            "LEVEL_NOT_ENOUGH");


        // 前置菜谱没有开启
        $precookid = null;
        if (isset ($config [configdata_cook_book_setting::k_opencookbook])) {
            $precookid = $config [configdata_cook_book_setting::k_opencookbook];
        }
        if (!is_null($precookid)) {
            logicErrorCondition($this->enabled($cookbookid),
                err_dbs_cookbook_learncookbook::PRE_COOKBOOK_NOT_EXIST,
                "PRE_COOKBOOK_NOT_EXIST");
        }

        // 是否需要变异开启
        $needvariation = $config [configdata_cook_book_setting::k_openvariation];
        logicErrorCondition($needvariation !== '1',
            err_dbs_cookbook_learncookbook::NEED_VARIATION,
            "NEED_VARIATION");

        // 配方开启

        $formulas = [];
        if (isset ($config [configdata_cook_book_setting::k_openformulaid])) {
            $formula = $config [configdata_cook_book_setting::k_openformulaid];
            $formulacount = $config [configdata_cook_book_setting::k_openformulavalue];
            $formulacount = intval($formulacount);

            $formulas[$formula] = $formulacount;

            logicErrorCondition($this->db_owner->db_warehousenormal()->hasItem($formula, $formulacount),
                err_dbs_cookbook_learncookbook::FORMULA_NOT_ENOUGH,
                "FORMULA_NOT_ENOUGH");
        }


        //删除配方
        if (!empty($formulas)) {
            foreach ($formulas as $itemId => $itemCount) {
                dbs_warehouse::warehouseRemoveItem($this->db_owner, $itemId, $itemCount);
            }
        }


        $books = $this->get_books();
        $cookbook = dbs_cookbookinfo::createWithBookId($cookbookid);
        $books [$cookbookid] = $cookbook->toArray();
        $this->set_books($books);
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }




    /**
     *
     *
     * @param string $cookbookid
     */
    /**
     *  烹饪书是否有效
     * @param $cookbookId
     * @return bool
     */
    function enabled($cookbookId)
    {
        $cookbookId = strval($cookbookId);
        $books = $this->get_books();
        return isset($books[$cookbookId]);
    }

    /**
     * 获取烹饪信息
     *
     * @param string $cookbookId
     * @return dbs_cookbookinfo|NULL
     */
    function getCookbookInfo($cookbookId)
    {
        $cookbookId = strval($cookbookId);
        if (!$this->enabled($cookbookId)) {
            return NULL;
        }
        $books = $this->get_books();
        $booksinfo = $books [$cookbookId];

        $book = new dbs_cookbookinfo ($cookbookId);
        $book->fromArray($booksinfo);
        return $book;
    }

    /**
     * 增加烹饪次数
     * @param $cookbookId
     * @param int $num
     * @return null
     */
    function addCookTimes($cookbookId, $num = 1)
    {
        $cookbookId = strval($cookbookId);
        if (!$this->enabled($cookbookId)) {
            return NULL;
        }
        $books = $this->get_books();
        $bookinfo = $books [$cookbookId];

        $book = new dbs_cookbookinfo ($cookbookId);
        $book->fromArray($bookinfo);

        $book->addCookingTimes($num);
        $books [$cookbookId] = $book->toArray();
        $this->set_books($books);
    }


    /**
     * 自动学习开启菜谱
     */
    private function autoLearnCookBook()
    {
        $level = dbs_restaurantinfo::createWithPlayer($this->db_owner)->get_restaurantlevel();
        $books = $this->get_books();

        $dataChange = false;
        foreach (configdata_cook_book_setting::data() as $data) {
            if ($data[configdata_cook_book_setting::k_autoopen] !== "1") {
                continue;
            }
            if (isset($books[$data[configdata_cook_book_setting::k_id]])) {
                continue;
            }
            if ($level < intval($data[configdata_cook_book_setting::k_openlevel])) {
                continue;
            }
            if (isset ($data [configdata_cook_book_setting::k_openformulaid])) {
                continue;
            }

            $bookData = dbs_cookbookinfo::createWithBookId($data[configdata_cook_book_setting::k_id]);
            $books[$bookData->get_bookid()] = $bookData->toArray();

            $dataChange = true;
        }

        if ($dataChange) {
            $this->set_books($books);
        }
    }

    /**
     * @inheritDoc
     */
    function masterbeforecall()
    {
        $this->autoLearnCookBook();
    }


}