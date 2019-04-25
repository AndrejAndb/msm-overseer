<?php


namespace msm\Bots\Commands;


use CharlotteDunois\Yasmin\Models\Message;
use msm\Command;

class ImportGuildMembers extends Command
{
    protected $prefixes = [
        'import-guild-members',
        'импорт-согильдийцев'
    ];

    public function getInfo() {
        return 'Импорт базы членов гильдий';
    }

    public function dispatch($prefix, $params, Message $msg) {
        $text = "Не сделал";

        $msg->channel->send(sprintf($text));
    }

}