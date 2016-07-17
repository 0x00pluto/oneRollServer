<?php
use Common\Db\Common_Db_pools;
use Common\Util\Common_Util_Log;
use Common\Util\Common_Util_Message;

/**
 * do nothing
 *
 * @author lijiang
 */
require_once("global.php");

class gateway
{

    function __construct()
    {
        Common_Util_Log::getLogger();
        $this->stopWatch = new \Symfony\Component\Stopwatch\Stopwatch();
    }

    /**
     * 当前处理消息
     * @var string
     */
    private $currentMessage = "";

    /**
     *
     * @var service\service_gateway
     */
    private $_gateway = NULL;

    /**
     * @var \Symfony\Component\Stopwatch\Stopwatch
     */
    private $stopWatch;

    /**
     * 处理消息
     * @param array $messageData
     */
    private function __processMessage($messageData)
    {

        $command = Common_Util_Message::Message_getCommand($messageData);

        if (empty ($command)) {
            return;
        }
        $gatewayData = \service\service_gatewaydata::create_with_array($command);


        $commandTimeKey = 'commandCall.' . $gatewayData->get_command() . '[' . $gatewayData->get_commandid() . ']';
        $this->currentMessage = $commandTimeKey;
        $this->stopWatch->start($commandTimeKey);

        $ret = $this->_gateway->call($gatewayData);
        Common_Util_Message::pushS2CMessageBody($ret);
        $this->stopWatch->stop($commandTimeKey);
    }


    /**
     * 服务器错误消息
     * @param $retCode
     * @param $retString
     * @param array $retData
     * @return string
     */
    private function errorMessage($retCode, $retString, array $retData = [])
    {
        $message = Common_Util_Message::createmessagebody_withreturnparam('system.error',
            0,
            false,
            $retData,
            $retCode, $retString);
        return Common_Util_Message::encodeMessage([Common_Util_Message::create($message)->toArray()]);
    }

    private function __processMessages($messages)
    {
        if (!is_array($messages)) {
            return $this->errorMessage(\constants\constants_globalerrcode::SYSTEM_ERR_MESSAGE_TYPE_ERROR,
                "message type error");
        }
        $service_gateway_name = C(configure_constants::APP_NAMESPACE) . "\\service\\service_gateway";
        if (!class_exists($service_gateway_name)) {
            $service_gateway_name = "hellaEngine\\service" . "\\service_gateway";
            if (!class_exists($service_gateway_name)) {
                return $this->errorMessage(\constants\constants_globalerrcode::SYSTEM_ERR_MESSAGE_SERVICE_CLASS_NOT_FOUND
                    , "class not found!");
            }
        }
        $inMessageCount = count($messages);
        if ($inMessageCount > C(configure_constants::ONCE_PROCESS_MESSAGE_MAX_COUNT)) {
            return $this->errorMessage(\constants\constants_globalerrcode::SYSTEM_ERR_PROCESS_MESSAGES_COUNT_REACH_MAX
                , "process message count max!");
        }

        // 数据池
        $this->_gateway = new $service_gateway_name ();

        $this->stopWatch->start('commandCall');
        foreach ($messages as $value) {

            $this->_gateway->call_before();
            Common_Db_pools::default_Db_pools()->begin();
            $this->__processMessage($value);
            Common_Db_pools::default_Db_pools()->save();
            Common_Db_pools::default_Db_pools()->end();
            $this->_gateway->call_after();
        }
        $this->_gateway->call_end();
        $this->stopWatch->stop('commandCall');

        // 处理消息返回
        $returnMessages = array();
        while (NULL != ($returnMessage = Common_Util_Message::popS2CMessage())) {
            $returnMessages [] = $returnMessage->toArray();
        }
        $outMessageCount = count($returnMessages);
        if ($outMessageCount < $inMessageCount) {
            return $this->errorMessage(\constants\constants_globalerrcode::SYSTEM_ERR_IN_OUT_MESSAGE_NOT_BALANCE,
                "in and out message count not balance!");
        }

        // 没有消息返回
        if (count($returnMessages) == 0) {
            return $this->errorMessage(\constants\constants_globalerrcode::SYSTEM_ERR_NOT_RETURN_MESSAGE
                , "not return message!");
        }

        $compressMessage = Common_Util_Message::encodeMessage($returnMessages);
        return $compressMessage;
    }

    /**
     * 处理消息
     *
     * @param string $postData
     *            客户端传上了的 经过压缩和Base64 编码的数据
     * @return string 返回客户端的数据
     */
    public function processMessage($postData)
    {
        $this->stopWatch->start('totalTime');
        // $profile_enable = C ( configure_constants::PHP_PROFILE );
        $profile_enable = false;
        if (C(configure_constants::PHP_PROFILE) && function_exists("xhprof_enable")) {
            $profile_enable = true;
        }
        if ($profile_enable) {
            xhprof_enable(XHPROF_FLAGS_CPU + XHPROF_FLAGS_MEMORY);
        }

        if (empty ($postData)) {
            return $this->errorMessage(\constants\constants_globalerrcode::SYSTEM_ERR_INVALID_MESSAGE,
                'invalid message!');
        }


        // 解压缩数据
        $messageDatas = Common_Util_Message::decodeMessage($postData);
        if (is_null($messageDatas)) {
            Common_Util_Log::record(Common_Util_Log::ERROR, 'processMessage', [
                $postData
            ]);
            return $this->errorMessage(\constants\constants_globalerrcode::SYSTEM_ERR_DECODE_MESSAGE_ERROR
                , 'decode error!');
        }
        try {
            $returnData = $this->__processMessages($messageDatas);
        } catch (\hellaEngine\exception\exception_datasaveerror $e) {
            $details = $e->getErrorDetail();
            $details['currentMessage'] = $this->currentMessage;
            Common_Util_Log::record_error('DataSaveError',
                $details);
            //数据库脏数据,直接退出程序
            die();
        }

        $this->stopWatch->stop('totalTime');

        //记录执行时间
        $runTimes = [];
        $Sections = $this->stopWatch->getSections();
        $Section = array_pop($Sections);
        foreach ($Section->getEvents() as $eventName => $event) {
            $runTimes[$eventName] = $event->getDuration() . "ms";
        }
        Common_Util_Log::record(Common_Util_Log::DEBUG, 'command_run_oncetime', $runTimes);

        if ($profile_enable) {
            $xhprof_data = xhprof_disable();
            include_once "./xhprof_lib/utils/xhprof_lib.php";
            include_once "./xhprof_lib/utils/xhprof_runs.php";
            $xhprof_runs = new XHProfRuns_Default ();
            $run_id = $xhprof_runs->save_run($xhprof_data, 'xhprof');
            if (C(configure_constants::DEBUG)) {
                echo '<a href="http://' . $_SERVER ['HTTP_HOST'] . '/xhprof_html/index.php?run=' . $run_id . '&source=xhprof" target="_blank">性能分析</a>' . "\n"; // source的值就是save_run的第二个参数的值。其中，网址就是上面保存xhprof_html的路径。
            } else {
            }
        }


        return $returnData;
    }
}


