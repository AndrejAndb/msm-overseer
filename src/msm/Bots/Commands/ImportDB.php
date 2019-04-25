<?php


namespace msm\Bots\Commands;


use CharlotteDunois\Yasmin\Models\Message;
use msm\Command;

class ImportDB extends Command
{
    protected $prefixes = [
        'import-db',
        'импорт-базы'
    ];

    public function getInfo() {
        return 'Импорт базы Бота';
    }

    public function dispatch($prefix, $params, Message $msg) {
        $text = "Не сделал";

        $msg->channel->send(sprintf($text));
    }

}