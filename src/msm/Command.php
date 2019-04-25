<?php


namespace msm;


use CharlotteDunois\Yasmin\Models\Message;

class Command
{
    protected $prefixes = [];

    protected $bot;

    public function register(Bot $bot)
    {
        $this->bot = $bot;
        $bot->addCommand($this);
    }

    /**
     * @return Bot
     */
    public function getBot() {
        return $this->bot;
    }

    public function getPrefixes() {
        return $this->prefixes;
    }

    public function getInfo() {
        return '';
    }

    public function isApplicable($prefix, Message $msg)
    {
        return in_array($prefix, $this->prefixes);
    }

    public function isPermissionAllowed() {

    }

    public function isInternal() {
        return false;
    }

    public function dispatch($prefix, $params, Message $msg) {

    }

}