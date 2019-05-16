<?php

include __DIR__ . '/../vendor/autoload.php';

if (!defined('APP_PATH')) define('APP_PATH', realpath(dirname(__FILE__) . '/../'));

$loop = \React\EventLoop\Factory::create();
$client = new \CharlotteDunois\Yasmin\Client(array(), $loop);

$bot = new \msm\Bots\Overseer($client);
$dispatcher = new \msm\CommandDispatcher();
$dispatcher->registerBot($bot);


$client->on('error', function ($error) {
    echo $error . PHP_EOL;
});

$client->on('ready', function () use ($client) {
    echo 'Logged in as ' . $client->user->tag . ' created on ' . $client->user->createdAt->format('d.m.Y H:i:s') . PHP_EOL;
});

$client->on('debug', function ($str) use ($client) {
    echo 'Debug: '. $str . PHP_EOL;
});

$client->on('message', function ($message) use ($dispatcher) {
    /** @var \CharlotteDunois\Yasmin\Models\Message $message */
    $dispatcher->dispatch($message);
    //print_r($message->channel->getGuild()->id);
    //echo 'Received Message from ' . $message->author->tag . ' in ' . ($message->channel instanceof \CharlotteDunois\Yasmin\Models\TextChannel ? 'channel #' . $message->channel->name : 'DM') . ' with ' . $message->attachments->count() . ' attachment(s) and ' . \count($message->embeds) . ' embed(s)' . PHP_EOL;
    //$message->channel->send("Ты сказал '" . $message->content . "'?");
});

$client->login('NTcwNTgxMjA4NjIzNDgwODMy.XMBfXw.0yrGanbPV2DdUonafd3O1ouMK0k')->done();
$loop->run();
