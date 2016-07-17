<?php

namespace Common\Util;

use hellaEngine\data\interfaces\data_interfaces_serialize;

/**
 *
 * @author zhipeng
 *
 */
class Common_Util_Message implements data_interfaces_serialize
{

    /**
     * 命令字
     *
     * @var string
     */
    const DBKey_cmd = "cmd";

    /**
     * 命令序号
     *
     * @var string
     */
    const DBKey_cmdid = "cmdid";

    /**
     * 主版本号
     *
     * @var string
     */
    const DBKey_verMajor = "verMajor";

    /**
     * 小版本号
     *
     * @var string
     */
    const DBKey_verMin = "verMin";

    /**
     * 消息类型
     *
     * @var string
     */
    const DBKey_msgType = "msgType";

    /**
     * 消息头
     *
     * @var string
     */
    const DBKey_msghead = "header";

    /**
     * 消息体
     *
     * @var string
     */
    const DBKey_msgdata = "data";
    /**
     * 校验码
     *
     */
    const DBKey_verify = "verify";
    /**
     * 参数
     *
     */
    const DBKey_params = "params";

    /**
     * 普通消息,未压缩
     *
     */
    const MESSAGE_TYPE_DATA = 0;
    /**
     * 普通消息,压缩
     *
     */
    const MESSAGE_TYPE_GZIP = 1;

    /**
     * 消息类型错误
     *
     */
    const MESSAGE_TYPE_ERROR = 2;

    /**
     * 消息实体
     *
     * @var array
     */
    private $_messagedata = [
        self::DBKey_msghead => [],
        self::DBKey_msgdata => []
    ];

    /**
     * 设置消息大版本号
     *
     * @param integer $value
     */
    public function set_verMajor($value)
    {
        $header = $this->get_header();
        $header [self::DBKey_verMajor] = intval($value);
        $this->set_header($header);
    }

    /**
     * 设置消息小版本号
     *
     * @param integer $value
     */
    public function set_verMin($value)
    {
        $header = $this->get_header();
        $header [self::DBKey_verMin] = intval($value);
        $this->set_header($header);
    }

    /**
     * 设置消息类型
     *
     * @param integer $value
     */
    public function set_messagetype($value)
    {
        $header = $this->get_header();
        $header [self::DBKey_msgType] = intval($value);
        $this->set_header($header);
    }

    /**
     * 设置消息头
     *
     * @param array $value
     */
    private function set_header(array $value)
    {
        $this->_messagedata [self::DBKey_msghead] = $value;
    }

    /**
     * 获取消息头
     *
     * @return array
     */
    public function get_header()
    {
        if (isset ($this->_messagedata [self::DBKey_msghead])) {
            return $this->_messagedata [self::DBKey_msghead];
        }
        return [];
    }

    /**
     * 设置消息体
     *
     * @param array $message
     */
    public function setMessageBody(array $message)
    {
        $this->_messagedata [self::DBKey_msgdata] = $message;
    }

    /**
     * 设置消息体扩展信息
     *
     * @param string $key
     * @param mixed $value
     */
    public function setMessageBodyContent($key, $value)
    {
        $messageBody = [];
        if (isset ($this->_messagedata [self::DBKey_msgdata])) {
            $messageBody = $this->_messagedata [self::DBKey_msgdata];
        }

        $messageBody [$key] = $value;
        $this->setMessageBody($messageBody);
    }

    /**
     * 获取消息内容
     *
     * @param string $key
     *
     * @return null|mixed
     */
    public function getMessageBodyContent($key)
    {
        $messageBody = [];
        if (isset ($this->_messagedata [self::DBKey_msgdata])) {
            $messageBody = $this->_messagedata [self::DBKey_msgdata];
        }
        if (isset ($messageBody [$key])) {
            return $messageBody [$key];
        }
        return null;
    }

    /*
     * (non-PHPdoc)
     * @see \hellaEngine\data\interfaces\data_interfaces_serialize::toArray()
     */
    function toArray($filter = NULL, $excludefilter = NULL)
    {
        return $this->_messagedata;
    }

    /*
     * (non-PHPdoc)
     * @see \hellaEngine\data\data_interface_serialize::fromArray()
     */
    function fromArray($arr, $exclude = NULL)
    {
        $this->_messagedata = $arr;
    }

    /**
     * 创建消息
     *
     * @param array $messageBody
     * @param int $verMajor
     * @param int $verMin
     * @param int $messageType
     * @return \Common\Util\Common_Util_Message
     */
    static function create(array $messageBody, $verMajor = 1, $verMin = 1, $messageType = self::MESSAGE_TYPE_DATA)
    {
        $ins = new self ();
        $ins->set_verMajor($verMajor);
        $ins->set_verMin($verMin);
        $ins->set_messagetype($messageType);
        $ins->setMessageBody($messageBody);
        return $ins;
    }

    /**
     * 通过创建远程rpc函数生成消息
     *
     * @param string $functionName
     *            远程rpc名称 xxxx.yyyy
     * @param array $params
     *            参数 key=>value
     * @param string $verify
     *            verify
     *
     * @return \Common\Util\Common_Util_Message
     */
    static function create_with_rpccall($functionName, array $params = [], $verify = '')
    {
        $message = self::create([]);
        $message->setMessageBodyContent(self::DBKey_cmd, $functionName);
        $message->setMessageBodyContent(self::DBKey_cmdid, 1);
        $message->setMessageBodyContent(self::DBKey_verify, $verify);
        $message->setMessageBodyContent(self::DBKey_params, $params);
        return $message;
    }

    /**
     * 创建messagebody
     *
     * @param string $command
     *            命令关键字
     * @param int $commandid
     *            命令序号
     * @param boolean $retsucc
     *            是否成功
     * @param array $retdata
     *            返回值
     * @param number $retcode
     *            返回代码
     * @return array
     */
    static function createmessagebody_withreturnparam($command, $commandid, $retsucc = true, $retdata = array(), $retcode = 0, $retcode_str = 'SUCC')
    {
        $message = array(
            self::DBKey_cmd => $command,
            self::DBKey_cmdid => $commandid,
            Common_Util_ReturnVar::DBKey_retsucc => $retsucc,
            Common_Util_ReturnVar::DBKey_retcode => $retcode,
            Common_Util_ReturnVar::DBKey_retdata => $retdata,
            Common_Util_ReturnVar::DBKey_retcode_str => $retcode_str
        );
        return $message;
    }

    /**
     * 创建消息体
     *
     * @param string $command
     *            命令关键字
     * @param int $commandid
     *            命令序号
     * @param Common_Util_ReturnVar $retdata
     * @return array:
     */
    static function createmessagebody_withreturndata($command, $commandid, Common_Util_ReturnVar $retdata)
    {
        return self::createmessagebody_withreturnparam($command, $commandid, $retdata->get_retsucc(), $retdata->get_retdata(), $retdata->get_retcode(), $retdata->get_retcode_str());
    }

    /**
     * 获取命令
     *
     * @param $message
     * @return null
     */
    static function Message_getCommand(array $message)
    {

        if (empty($message)) {
            return null;
        }

        $header = $message [self::DBKey_msghead];
        if ($header == null) {
            return null;
        }

        $data = $message [self::DBKey_msgdata];
        if ($data == null) {
            return null;
        }

        return $data;
    }

    /**
     * 构建返回消息助手类
     *
     * @param string $command
     * @param array $retdata
     * @param number $commandid
     * @param string $retsucc
     * @param number $retcode
     * @param string $retcode_str
     */
    static function pushS2CMessageByCmdId($command, $retdata = [], $commandid = 0, $retsucc = true, $retcode = 0, $retcode_str = 'SUCC')
    {
        self::pushS2CMessageBody(self::createmessagebody_withreturnparam($command, $commandid, $retsucc, $retdata, $retcode, $retcode_str));
    }

    /**
     * 压入消息体
     *
     * @param array $messageBody
     */
    static function pushS2CMessageBody(array $messageBody)
    {
        Common_Util_MessagePool::returnmessagepool()->pushMessage(self::create($messageBody));
    }

    /**
     * 弹出消息队列
     *
     * @return Common_Util_Message
     */
    static function popS2CMessage()
    {
        return Common_Util_MessagePool::returnmessagepool()->popMessage();
    }

    /**
     * 加密秘钥长度
     *
     */
    const NOT_OR_KEY_LEN = 2;

    /**
     * 加密网络消息
     *
     * @param array $message_arr
     *
     * @return string
     */
    static function encodeMessage(array $message_arr)
    {
        $compressedData = gzcompress(json_encode($message_arr), 5);
        $orKey = "";
        for ($i = 0; $i < self::NOT_OR_KEY_LEN; $i++) {
            $orKey .= chr(mt_rand(1, 200));
        }
        $compressEncodeString = $orKey . $compressedData;
        for ($i = self::NOT_OR_KEY_LEN; $i < strlen($compressedData) + self::NOT_OR_KEY_LEN; $i++) {
            $compressEncodeString [$i] = $compressEncodeString [$i - self::NOT_OR_KEY_LEN] ^ $compressEncodeString [$i];
        }
        $compressMessage = base64_encode($compressEncodeString);
        return $compressMessage;
    }

    /**
     * 解密网络消息
     *
     * @param string $message_str
     * @return array|NULL
     */
    static function decodeMessage($message_str)
    {
        try {
            // 解压缩数据
            $unBase64 = base64_decode($message_str);
            if ($unBase64 === false) {
                return null;
            }
            $unBase64EncodeMessage = $unBase64;

            // 解密
            for ($i = strlen($unBase64) - 1; $i >= self::NOT_OR_KEY_LEN; $i--) {
                $unBase64 [$i] = $unBase64 [$i - self::NOT_OR_KEY_LEN] ^ $unBase64 [$i];
            }

            $unBase64 = substr($unBase64, self::NOT_OR_KEY_LEN);
            $messageDatas = gzuncompress($unBase64);
            if ($messageDatas === FALSE) {
                Common_Util_Log::record_error('decodeMessageError',
                    [
                        'unBase64DecodeMessage' => $unBase64,
//                        'unBase64EncodeMessage' => $unBase64EncodeMessage,
                        'originalMessage' => $message_str
                    ]);
                return null;
            }

            $messages = json_decode($messageDatas, true);
        } catch (\Exception $e) {
            return null;
        }

        return $messages;
    }
}