<?php


namespace msm\Bots\Commands;


use CharlotteDunois\Yasmin\Models\Message;
use msm\Command;

class Config extends Command
{
    protected $prefixes = [
        'config',
        'конфигурация'
    ];

    public function getInfo() {
        return 'Конфигурация Бота';
    }

    public function dispatch($prefix, $params, Message $msg) {
        $text = "Не сделал";

        $msg->channel->send(sprintf($text));
    }

}