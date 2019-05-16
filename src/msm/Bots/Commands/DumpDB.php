<?php


namespace msm\Bots\Commands;


use CharlotteDunois\Yasmin\Models\Guild;
use CharlotteDunois\Yasmin\Models\Message;
use msm\Command;

class DumpDB extends Command
{
    protected $prefixes = [
        'dump-db',
        'дамп-базы'
    ];

    public function getInfo() {
        return 'Экспорт базы Бота';
    }

    public function dispatch($prefix, $params, Message $msg, Guild $guild) {
        $text = "Не сделал";

        $msg->channel->send(sprintf($text));
    }

}