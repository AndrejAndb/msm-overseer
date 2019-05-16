<?php


namespace msm;


use CharlotteDunois\Yasmin\Client;
use CharlotteDunois\Yasmin\Models\Guild;
use CharlotteDunois\Yasmin\Models\Message;
use CharlotteDunois\Yasmin\Models\TextChannel;
use DateTime;

class Bot
{
    protected $prefixes = [];

    /**
     * @var DateTime
     */
    protected $startedTime;

    /**
     * @var Client
     */
    protected $client;

    protected $commandList = [];

    protected $configs =[];

    public function __construct($client)
    {
        $this->client = $client;
        $this->startedTime = new DateTime();
        $this->registerCommands();
    }

    public function registerCommands()
    {

    }

    public function getCommands()
    {
        return $this->commandList;
    }

    public function getName() {
        return 'Bot';
    }

    public function getVersion() {
        return '1';
    }

    public function getInfo() {
        return 'Бот';
    }

    public function addCommand(Command $command)
    {
        $this->commandList[] = $command;
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    public function dispatchCommand($params, Message $msg)
    {
        if(!($msg->channel instanceof TextChannel)) {
            return;
        }

        $data = explode(' ', $params, 2);
        if(empty($data) || count($data) < 1) {
            return;
        }

        $prefix = $data[0];
        $params = isset($data[1]) ? $data[1] : null;
        /** @var $command Command */
        foreach($this->commandList as $command) {
            if($command->isApplicable($prefix, $msg)) {
                $command->dispatch($prefix, $params, $msg, $msg->channel->getGuild());
                return;
            }
        }
    }

    /**
     * @param Guild $guild
     * @return GuildConfig
     */
    public function getConfig(Guild $guild) {
        if(!isset($this->configs[$guild->id])) {
            $this->configs[$guild->id] = new GuildConfig($guild);
        }
        return $this->configs[$guild->id];
    }

    public function isConfigured(Guild $guild) {
        return $this->getConfig($guild)->isConfigured();
    }

    public function getStatus(Guild $guild) {
        $status = true;

        // Bot Checks
        $botCheck = [];
        $botCheck[] = 'альфа тест';
        if(!class_exists('\Redis')) {
            $botCheck[] = 'php-redis не установлен';
            $status = false;
        }

        // Guild Checks
        $guildCheck = [];
        if(!$this->isConfigured($guild)) {
            $guildCheck[] = sprintf('Для Сервера "%s" #%s отсутствует конфигурация. Обратитесь к администратору Бота <andrey@andb.name>',
                $guild->name, $guild->id);
            $status = false;
        }

        // DB check
        $databaseCheck = $this->getConfig($guild)->getDbConnection()->checkConnection();



        return [
            'status' => $status,
            'known_users'=> 0,
            'linked_users'=> [
                'teso' => 0,
            ],
            'domain' => gethostname(),
            'uptime' => $this->startedTime->diff((new DateTime())),
            'health' => [
                'guild' => $guildCheck,
                'bot' => $botCheck,
                'server' => [],
                'connection' => [],
                'database' => $databaseCheck,
            ],
        ];
    }

    public function checkPrefix($prefix)
    {
        return in_array($prefix, $this->prefixes);
    }

}