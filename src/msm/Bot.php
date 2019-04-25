<?php


namespace msm;


use CharlotteDunois\Yasmin\Client;
use CharlotteDunois\Yasmin\Models\Message;

class Bot
{
    protected $prefixes = [];

    /**
     * @var Client
     */
    protected $client;

    protected $commandList = [];

    public function __construct($client)
    {
        $this->client = $client;
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
        $data = explode(' ', $params, 2);
        if(empty($data) || count($data) < 1) {
            return;
        }

        $prefix = $data[0];
        $params = isset($data[1]) ? $data[1] : null;
        /** @var $command Command */
        foreach($this->commandList as $command) {
            if($command->isApplicable($prefix, $msg)) {
                $command->dispatch($prefix, $params, $msg);
                return;
            }
        }
    }

    public function checkPrefix($prefix)
    {
        return in_array($prefix, $this->prefixes);
    }

}