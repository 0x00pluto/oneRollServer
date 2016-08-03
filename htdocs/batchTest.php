<?php
require "../include/gateway.php";

use hellaEngine\RPCMessage\RPCMessage;
use hellaEngine\RPCMessage\RPCMessageEncode;

$verify = null;
if (isset ($_GET ['verify'])) {
    $verify = $_GET ['verify'];
}

// $functionName = $_GET['functionName'];
// $params = $_GET['functionParams'];

$message = RPCMessage::createWithRpc('role.getroleinfo');
$message->setMessageBodyProperty('verify', $verify);

// var_dump($message);

$messageData = RPCMessageEncode::encodeMessages([
    $message
]);


$gateway = new gateway ();
$returndata = "f";
$returndata = $gateway->processMessage($messageData);

echo $returndata;