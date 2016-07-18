<?php

namespace dbs;

use Common\Db\Common_Db_memcached;
use Common\Db\Common_Db_memcacheObject;
use Common\Util\Common_Util_Message;
use constants\constants_memcachekey;
use constants\constants_messagecmd;
use constants\constants_synctype;
use dbs\sync\dbs_sync_data;
use dbs\templates\sync\dbs_templates_sync_player;

class dbs_sync extends dbs_templates_sync_player
{

    /**
     * 获取服务器时间
     */
    function getservertime()
    {
        return time2();
    }

    /**
     * 本次产生的同步消息,需要本次携带下去
     *
     * @var array
     */
    private $hot_sync_messages = [];

    function update_aftercall()
    {
        $this->process_sync_hot_messages();
        $this->notice_new_sync_message();
    }

    /**
     * 处理本次操作中产生的回调消息
     *
     * @return boolean
     */
    private function process_sync_hot_messages()
    {
        if (!$this->db_owner->isMasterPlayer()) {
            return false;
        }
//        if ($this->db_owner->dbs_robot_player()->get_isrobot()) {
//            return false;
//        }
        if (empty ($this->hot_sync_messages)) {
            return false;
        }
        // 下发本次携带消息
        foreach ($this->hot_sync_messages as $syncdata) {
            $this->_process_sync_data($syncdata);
        }
        return true;
    }

    /**
     * 通知有新的同步消息需要客户端来取
     */
    private function notice_new_sync_message()
    {
        // 通知来取历史数据
        if ($this->is_need_sync()) {
            Common_Util_Message::pushS2CMessageByCmdId(constants_messagecmd::S2C_NEED_SYNC);
        }
    }

    /**
     * 处理同步消息
     */
    private function process_sync_messages()
    {
        if ($this->is_need_sync()) {
            $memcacheObj = Common_Db_memcacheObject::create($this->_sync_key());
            $sync_datas = $memcacheObj->get_value(array());

            foreach ($sync_datas as $value) {
                $syncdata = new dbs_sync_data ();
                $syncdata->fromArray($value);
                $this->_process_sync_data($syncdata);
            }

            $this->clear_sync_mark();
        }
    }

    /**
     * 处理具体的同步消息
     *
     * @param dbs_sync_data $data
     */
    private function _process_sync_data(dbs_sync_data $data)
    {
        switch ($data->get_type()) {
            case constants_synctype::TYPE_MESSAGE :
                if (is_array($data->get_message())) {
                    Common_Util_Message::pushS2CMessageBody($data->get_message());
                }
                break;

            case constants_synctype::TYPE_CALLBACK :
                $dbins = $this->db_owner->getDbModule($data->get_classname());
                if (!is_null($dbins)) {
                    $functionname = $data->get_functionname();
                    $dbins->$functionname ();
                }
                break;
            default :
                break;
        }
    }

    function sync()
    {
        Common_Util_Message::pushS2CMessageByCmdId(constants_messagecmd::S2C_SYNC_SERVERTIME, $this->getservertime());
        $this->process_sync_messages();
    }

    /**
     * 同步关键字
     *
     * @return string
     */
    private function _sync_key()
    {
        return constants_memcachekey::DBKey_Need_Sync . $this->get_userid();
    }

    /**
     * 标记需要同步
     *
     * @param string $keyword
     * @param array $dataarr
     *            发送消息 如果为null,则为空消息体
     */
    function mark_sync($keyword, array $dataarr = [])
    {
        $keyword = strval($keyword);
        $message = null;
        if (is_array($dataarr)) {
            $message = Common_Util_Message::createmessagebody_withreturnparam($keyword, 0, true, $dataarr);
        } else {
            $message = Common_Util_Message::createmessagebody_withreturnparam($keyword, 0);
        }
        $data = new dbs_sync_data ();
        $data->set_key($keyword);
        $data->set_type(constants_synctype::TYPE_MESSAGE);
        $data->set_message($message);
        $this->_mark_sync($data);
    }

    /**
     * 标记需要同步的类,
     * 主要是那些需要及时计算的类,或是延时运算的类,
     *
     * @param dbs_player $classname
     *            正向调用sync用 调用函数名
     *            需要为 dbs_player身上集成的数据类
     * @param string $functionname
     *            函数名称.为 void function(),默认为sync函数
     */
    function mark_sync_class(dbs_baseplayer $classobj, $functionname = "sync")
    {
        $data = new dbs_sync_data ();
        $classname = get_class($classobj);

        $data->set_key($classname);
        $data->set_type(constants_synctype::TYPE_CALLBACK);
        $data->set_classname($classname);
        $data->set_functionname($functionname);
        $this->_mark_sync($data);
    }

    /**
     * 标记同步
     *
     * @param dbs_sync_data $data
     */
    private function _mark_sync(dbs_sync_data $data)
    {
        // 机器人不需要同步消息
        if ($this->db_owner->dbs_robot_player()->get_isrobot()) {
            return;
        }
        // if ($this->db_owner->is_master_user ()) {
        // $this->hot_sync_messages [$data->get_key ()] = $data;
        // } else {
        $memcacheobj = Common_Db_memcacheObject::create($this->_sync_key());
        $synclist = $memcacheobj->get_value([]);

        $synclist [md5(serialize($data))] = $data->toArray();
        $memcacheobj->set_value($synclist);

// 		dump ( $synclist );
        // }
    }

    /**
     * 是否需要同步
     *
     * @return boolean
     */
    private function is_need_sync()
    {
        if (!$this->db_owner->isMasterPlayer()) {
            return FALSE;
        }
//        if ($this->db_owner->dbs_robot_player()->get_isrobot()) {
//            return FALSE;
//        }
        $need = Common_Db_memcached::getInstance()->get($this->_sync_key());
        if ($need) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * 清除需要通知的消息
     */
    private function clear_sync_mark()
    {
        // $this->hot_sync_messages = [ ];
        Common_Db_memcached::getInstance()->delete($this->_sync_key());
    }


}