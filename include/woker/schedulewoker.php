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

        $messageString = \Common\Util\Common_Util_Message::encodeMessage([$message->toArray()]);

        echo "success run >> call:" . time() . "\n";

        $gateway = new gateway();
        $output = $gateway->processMessage($messageString);

        $returnmessages = \Common\Util\Common_Util_Message::decodeMessage($output);

        // _dump ( $returnmessages );
        foreach ($returnmessages as $value) {
            // _dump ( $value );
            $command = \Common\Util\Common_Util_Message::Message_getCommand($value);
            // _dump ( $command );
            var_dump($command);
        }

    }
}


$ins = new schedulewoker();
$ins->call();



