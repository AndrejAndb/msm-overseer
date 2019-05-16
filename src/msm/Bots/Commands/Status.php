<?php


namespace msm\Bots\Commands;


use CharlotteDunois\Yasmin\Models\Guild;
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

    public function dispatch($prefix, $params, Message $msg, Guild $guild) {
        $status = $this->getBot()->getStatus($guild);

        $text = "```diff
%s (%s)
Статус: %s
Хост: %s
Аптайм: %s
-----------------
%s
-----------------
Известных пользователей: %d
Привязанных пользователей:
  - teso: %d
```";

        $statusString = [];
        foreach($status['health'] as $key => $health) {
            if(empty($health)) {
                $health = 'Ok';
            } else {
                $health = implode('; ', $health);
            }
            $statusString[] = sprintf("%s: %s", $key, $health);
        }

        $msg->channel->send(sprintf($text,
            $this->getBot()->getName(),
            $this->getBot()->getVersion(),
            $status['status'] ? 'Ok' : 'Warning',
            $status['domain'],
            sprintf("%d дней, %d часов, %d минут", $status['uptime']->days, $status['uptime']->h, $status['uptime']->i),
            implode("\n", $statusString),
            $status['known_users'],
            $status['linked_users']['teso']
            ));
    }

}