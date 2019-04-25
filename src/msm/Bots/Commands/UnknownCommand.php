<?php


namespace msm\Bots\Commands;


use msm\Command;
use CharlotteDunois\Yasmin\Models\Message;

class UnknownCommand extends Command
{

    public function isApplicable($prefix, Message $msg)
    {
        return true;
    }

    public function dispatch($prefix, $params, Message $msg) {
        $msg->channel->send(sprintf("Неизвестная комманда '%s'", $prefix));
    }

    public function isInternal() {
        return true;
    }
}