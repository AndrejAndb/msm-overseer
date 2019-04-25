<?php


namespace msm;


use CharlotteDunois\Yasmin\Models\Message;
use CharlotteDunois\Yasmin\Models\TextChannel;

class CommandDispatcher
{
    /**
     * @var Bot
     */
    protected $bot;

    public function registerBot($bot)
    {
        $this->bot = $bot;
    }

    public function dispatch(Message $msg)
    {
        if($msg->author->tag == $this->bot->getClient()->user->tag) {
            return;
        }

        // TODO: DM
        if(!($msg->channel instanceof TextChannel)) {
            return;
        }

        $data = explode(' ', $msg->content, 2);
        if(empty($data) || count($data) != 2) {
            return;
        }

        $prefix = $data[0];
        if(!$this->bot->checkPrefix($prefix)) {
            return;
        }
        $params = $data[1];


        $this->bot->dispatchCommand($params, $msg);

    }

}