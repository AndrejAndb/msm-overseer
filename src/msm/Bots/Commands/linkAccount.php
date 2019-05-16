<?php


namespace msm\Bots\Commands;


use CharlotteDunois\Yasmin\Models\Guild;
use CharlotteDunois\Yasmin\Models\Message;
use msm\Command;

class linkAccount extends Command
{
    protected $prefixes = [
        'link-account',
        'привязать-аккаунт',
    ];

    public function getInfo() {
        return 'Привязать игровой аккаунт к учетной записи дискорда';
    }

    public function dispatch($prefix, $params, Message $msg, Guild $guild) {
        $text = "Не сделал";

        $msg->channel->send(sprintf($text));
    }

}