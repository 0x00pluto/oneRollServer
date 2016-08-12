<?php
require_once(__DIR__ . "/../global.php");
require_once(__DIR__ . "/../gateway.php");


/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/8/11
 * Time: 下午12:05
 */
class schedulewoker
{


    public function call()
    {

        $message = \hellaEngine\RPCMessage\RPCMessage::createWithRpc('schedule.schedule');
        $message->setMessageBodyProperty('clientVersion', '1.2.0');

        $messageString = \hellaEngine\RPCMessage\RPCMessageEncode::encodeMessages([$message]);;

        echo "success run >> call:" . time() . "\n";

        $gateway = new gateway();
        $output = $gateway->processMessage($messageString);

        $returnMessages = \hellaEngine\RPCMessage\RPCMessage::decode($output);

        foreach ($returnMessages as $value) {

            $command = $value->getCommand();
            var_dump($command);
        }

    }
}


$ins = new schedulewoker();
$ins->call();



