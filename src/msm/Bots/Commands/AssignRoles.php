<?php


namespace msm\Bots\Commands;


use CharlotteDunois\Yasmin\Models\Message;
use msm\Command;

class AssignRoles extends Command
{
    protected $prefixes = [
        'assign-roles',
        'назначить-роли'
    ];

    public function getInfo() {
        return 'Назначить Роли';
    }

    public function dispatch($prefix, $params, Message $msg) {
        $text = "Не сделал";

        $msg->channel->send(sprintf($text));
    }

}