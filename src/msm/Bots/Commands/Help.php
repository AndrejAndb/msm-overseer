<?php


namespace msm\Bots\Commands;


use CharlotteDunois\Yasmin\Models\Guild;
use CharlotteDunois\Yasmin\Models\Message;
use msm\Command;

class Help extends Command
{
    protected $prefixes = [
        'help',
        'помощь'
    ];

    public function getInfo() {
        return 'Информация по доступным коммандам';
    }

    public function dispatch($prefix, $params, Message $msg, Guild $guild) {
        $text = "```diff
%s (%s)
%s
-----------------
%s
```";

        $commandsInfo = [];
        $commands = $this->getBot()->getCommands();
        /** @var Command $command */
        foreach($commands as $command) {
            if($command->isInternal()) {
                continue;
            }
            $prefixes = $command->getPrefixes();
            if(empty($prefixes)) {
                return;
            }
            $commandsInfo[] = sprintf("%s (%s) - %s", array_shift($prefixes), implode('|', $prefixes),
                $command->getInfo());
        }

        $msg->channel->send(sprintf($text,
            $this->getBot()->getName(),
            $this->getBot()->getVersion(),
            $this->getBot()->getInfo(),
            implode($commandsInfo, "\n")
        ));
    }

}