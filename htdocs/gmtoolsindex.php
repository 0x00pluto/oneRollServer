<?php
use Common\Util\Common_Util_Message;

function __call($post)
{
    if (!isset ($post ['command'])) {
        return 'f' . __LINE__;
    }
    if (strpos($post ['command'], "gmtools") !== 0) {
        return 'f' . __LINE__;
    }
    $params = [];
    if (isset ($post ['params'])) {
        $params = json_decode($post ['params'], true);
    }
    require "../include/gateway.php";
    $message = Common_Util_Message::create_with_rpccall($post ['command'], $params);
    $message->setMessageBodyContent('clientVersion', '2.0.0');
    $encodeMessage = Common_Util_Message::encodeMessage([
        $message->toArray()
    ]);

    $gateway = new gateway ();
    $messagereturn = $gateway->processMessage($encodeMessage);

    $messagereturnarr = Common_Util_Message::decodeMessage($messagereturn);

    // echo json_encode ( $messagereturnarr );
    return json_encode($messagereturnarr);
}

echo __call($_POST);
// echo "ok";