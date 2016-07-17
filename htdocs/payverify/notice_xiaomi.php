<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/5/31
 * Time: 上午11:46
 */

function __call($post)
{
    if (!isset ($post ['command'])) {
        return 'f' . __LINE__;
    }
    if (strpos($post ['command'], "xiaomireceiptcenter") !== 0) {
        return 'f' . __LINE__;
    }
    $params = [];
    if (isset ($post ['params'])) {
        $params = json_decode($post ['params'], true);
    }
    require_once ("../../include/global.php");
    $message = \Common\Util\Common_Util_Message::create_with_rpccall($post ['command'], $params);
    $message->setMessageBodyContent('clientVersion', '2.0.0');
    $encodemessage = \Common\Util\Common_Util_Message::encodeMessage([
        $message->toArray()
    ]);

    $gateway = new gateway ();
    $messagereturn = $gateway->processMessage($encodemessage);
    $messagereturnarr = \Common\Util\Common_Util_Message::decodeMessage($messagereturn);
    return json_encode($messagereturnarr);
}

echo __call($_POST);