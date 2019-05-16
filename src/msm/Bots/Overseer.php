<?php


namespace msm\Bots;


use msm\Bot;
use msm\Bots\Commands\AssignRoles;
use msm\Bots\Commands\Config;
use msm\Bots\Commands\DumpDB;
use msm\Bots\Commands\Help;
use msm\Bots\Commands\ImportDB;
use msm\Bots\Commands\ImportGuildMembers;
use msm\Bots\Commands\linkAccount;
use msm\Bots\Commands\Status;
use msm\Bots\Commands\UnknownCommand;

class Overseer extends Bot
{
    protected $prefixes = [
        '!overseer',
        '!msm',
        '!надсмотрщик',
    ];

    public function registerCommands()
    {
        (new Status())->register($this);
        (new Config())->register($this);
        (new DumpDB())->register($this);
        (new ImportDB())->register($this);
        (new ImportGuildMembers())->register($this);
        (new AssignRoles())->register($this);
        (new linkAccount())->register($this);
        (new Help())->register($this);
        (new UnknownCommand())->register($this);

    }

    public function getName() {
        return 'MSM-Overseer';
    }

    public function getVersion() {
        return '0.1a';
    }

    public function getInfo() {
        return 'Бот надсмоторщик за котятками';
    }
}