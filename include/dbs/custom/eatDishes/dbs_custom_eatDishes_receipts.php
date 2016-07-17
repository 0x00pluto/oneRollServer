<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/1/27
 * Time: 下午3:24
 */

namespace dbs\custom\eatDishes;


use Common\Util\Common_Util_Guid;
use dbs\templates\custom\eatDishes\dbs_templates_custom_eatDishes_Receipts;

class dbs_custom_eatDishes_receipts extends dbs_templates_custom_eatDishes_Receipts
{

    /**
     * 创建票据
     * @param int $num
     * @return array
     */
    public function createNewReceipt($num = 1)
    {
        $num = intval($num);
        $receipts = $this->get_recepits();
        for ($i = 0; $i < $num; $i++) {
            $receipts [Common_Util_Guid::uuid('EatReceipt-')] = 1;
        }
        $this->set_recepits($receipts);
        return $receipts;
    }

    /**
     * 票据是否有效
     * @param $receipt
     * @return bool
     */
    public function receiptInvalid($receipt)
    {
        $receipts = $this->get_recepits();
        return isset($receipts[$receipt]);
    }

    /**
     * 删除票据
     * @param $receiptId
     */
    public function deleteReceipt($receiptId)
    {
        $receipts = $this->get_recepits();
        if (isset($receipts[$receiptId])) {
            unset($receipts[$receiptId]);
            $this->set_recepits($receipts);
        }
    }
}