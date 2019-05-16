<?php


namespace msm\Bots\Commands;


use CharlotteDunois\Yasmin\Models\Guild;
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

    public function dispatch($prefix, $params, Message $msg, Guild $guild) {
        $config = $this->getBot()->getConfig($guild);

        if(!$config->isConfigured()){
            $msg->channel->send(sprintf('Для Сервера "%s" #%s отсутствует конфигурация.',
                $guild->name, $guild->id
            ));
            return;
        }

        $text = "```diff
%s (%s)
Конфигурация:
-----------------
[read only]
%s
-----------------
%s
```";

        $msg->channel->send(sprintf($text,
            $this->getBot()->getName(),
            $this->getBot()->getVersion(),
            json_encode($config->getBaseConfig(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES),
            json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
        ));
    }

}