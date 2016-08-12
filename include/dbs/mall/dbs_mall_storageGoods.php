<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/8/12
 * Time: 上午11:47
 */

namespace dbs\mall;


use Common\Util\Common_Util_Guid;
use dbs\templates\mall\dbs_templates_mall_storageGoods;
use hellaEngine\utils\runtime\utils_runtime_result;

class dbs_mall_storageGoods extends dbs_templates_mall_storageGoods
{


    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);
        $this->setAutoSave(false);

        $this->set_primary_key([self::DBKey_goodsId]);
    }

    protected function _set_defaultvalue_goodsNormalInfo()
    {
        $this->set_defaultkeyandvalue(self::DBKey_goodsNormalInfo,
            dbs_mall_goodsNormalInfo::dumpDefaultValue());
    }

    /**
     * 创建库存货物
     * @param $goodsName
     * @param $rollCount
     * @param $eachRollPrice
     * @param int $quantity
     * @return dbs_mall_storageGoods
     */
    static function create($goodsName, $rollCount, $eachRollPrice, $quantity = 1)
    {
        $ins = new self();
        $ins->set_goodsId(Common_Util_Guid::uuid("StorageGoodsId-"));
        $ins->set_goodsName($goodsName);
        $ins->set_rollCount($rollCount);
        $ins->set_eachRollPrice($eachRollPrice);
        $ins->set_quantity($quantity);

        return $ins;
    }

    /**
     * @param $goodsId
     * @return static
     */
    static function getGoods($goodsId)
    {
        return self::findOrNew([self::DBKey_goodsId => $goodsId]);
    }

    /**
     * 产生线上货物
     * @return utils_runtime_result
     */
    public function productOnlineGoods()
    {
        if (!$this->get_valid()) {
            return utils_runtime_result::createFail('Goods_Invalid');
        }

        if ($this->get_quantity() <= 0) {
            return utils_runtime_result::createFail('QUANTITY_NOT_ENOUGH');
        }

        //判断上次物品
        $lastProductGoodsId = $this->get_lastProductGoodsId();
        $onlineGoods = dbs_mall_onlineGoods::getGoods($lastProductGoodsId);
        if ($onlineGoods->exist() && !$onlineGoods->goodsIsFinishSell()) {
            return utils_runtime_result::createFail('LAST_PRODUCT_GOODS_IS_SELLING');
        }

        //生产货物
        $this->set_productGoodsPeriod($this->get_productGoodsPeriod() + 1);
        $currentOnlineGoods = dbs_mall_onlineGoods::newGoods($this);
        $this->set_isonline(true);
        $this->set_quantity($this->get_quantity() - 1);
        $this->set_lastProductGoodsId($currentOnlineGoods->get_id());
        $currentOnlineGoods->saveToDB();
        $this->saveToDB();

        return utils_runtime_result::createSucc(
            [
                'onlineGoods' => $currentOnlineGoods
            ]);

    }

}