<?php


namespace msm\Bots\Commands;


use CharlotteDunois\Yasmin\Models\Guild;
use msm\Command;
use CharlotteDunois\Yasmin\Models\Message;

class UnknownCommand extends Command
{

    public function isApplicable($prefix, Message $msg)
    {
        return true;
    }

    public function dispatch($prefix, $params, Message $msg, Guild $guild) {
        $msg->channel->send(sprintf("Неизвестная комманда '%s'", $prefix));
    }

    public function isInternal() {
        return true;
    }
}