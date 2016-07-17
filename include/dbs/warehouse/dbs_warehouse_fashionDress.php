<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/12/23
 * Time: 上午11:28
 */

namespace dbs\warehouse;


use constants\constants_mailactiontype;
use constants\constants_mailTemplates;
use dbs\dbs_warehousebase;
use dbs\item\dbs_item_fashionDress;
use dbs\mailbox\dbs_mailbox_data;
use dbs\mailbox\dbs_mailbox_list;

/**
 * 时装仓库
 * Class dbs_warehouse_fashionDress
 * @package dbs\warehouse
 */
class dbs_warehouse_fashionDress extends dbs_warehousebase
{
    protected function configure()
    {
        $this->set_tablename("warehouse_fashionDress");
    }

    function masterbeforecall()
    {
        $items = $this->get_items();
        $dataChange = false;
        foreach ($items as $pos => $item) {
            $fashionDressItem = dbs_item_fashionDress::createByItemData($item);
            //已经过期
            if ($fashionDressItem->isExpired()) {
                if ($fashionDressItem->get_isPutOn()) {
                    //厨师身上的衣服
                    //留在访问厨师的时候删除
                    //
                    continue;
                }

                //发送过期邮件
//                $mailData = dbs_mailbox_data::create("时装过期",
//                    "时装已经过期了");
//                $mailData->addAttachAction(constants_mailactiontype::FASHION_DRESS_EXPIRED,
//                    $item);
//                dbs_mailbox_list::sendMailToUser($this->get_userid(), $mailData);

                dbs_mailbox_data::createWithStandardId(constants_mailTemplates::MAIL_FASHION_DRESS_OVERTIME,
                    ['fashionData' => $item])
                    ->send($this->get_userid());
                $dataChange = true;
                unset($items[$pos]);

            }
            
        }
        if ($dataChange) {
            $this->set_items($items);
        }

    }


}