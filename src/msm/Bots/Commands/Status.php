<?php


namespace msm\Bots\Commands;


use CharlotteDunois\Yasmin\Models\Message;
use msm\Command;

class Status extends Command
{
    protected $prefixes = [
        'status',
        'статус'
    ];

    public function getInfo() {
        return 'Статус Бота';
    }

    public function dispatch($prefix, $params, Message $msg) {
        $text = "Всё Ok";

        $msg->channel->send(sprintf($text));
    }

}