<?php


namespace msm\Db;


use msm\GuildConfig;
use Redis;
use RedisException;

class RedisConnection
{
    /**
     * @var Redis
     */
    protected $redis = null;

    protected $isConnected = false;

    /**
     * @var GuildConfig
     */
    protected $config;

    public function __construct(GuildConfig $config)
    {
        $this->config = $config;
        if ($this->checkRequirement()) {
            $this->redis = new Redis();
        }
    }

    public function checkConnection() {
        if (!$this->checkRequirement()) {
            return ['php-redis not installed'];
        }
        $this->connect();
        if(!$this->isConnected) {
            return ['Connection to DB not established'];
        }
        if (!$this->checkPing()) {
            return ['DB not pinged'];
        }
        return [];
    }

    public function getRawConnection() {
        if(!$this->redis) {
            return null;
        }
        if(!$this->isConnected) {
            $this->connect();
        }
        if ($this->isConnected && !$this->checkPing()) {
            $this->isConnected = false;
            $this->connect();
        }
        if($this->isConnected){
            return $this->redis;
        }
        return null;
    }

    public function getConfig($key) {

    }

    public function setConfig($key, $value) {

    }

    protected function checkRequirement()
    {
        if (!class_exists('\Redis')) {
            return false;
        }
        return true;
    }

    protected function checkPing() {
        if(!$this->isConnected) {
            return false;
        }
        try {
            if($this->redis->ping() != '+PONG') {
                return false;
            }
        } catch(RedisException $ew) {
            return false;
        }
        return true;
    }

    protected function connect()
    {
        if($this->isConnected || !$this->redis || !$this->config->isConfigured()) {
            return;
        }
        $baseConfig = $this->config->getBaseConfig();
        try {
            $this->redis->connect($baseConfig['db_host'], $baseConfig['db_port'], $baseConfig['db_timeout']);
            $this->isConnected = true;
        } catch(RedisException $ew) {
            return null;
        }
    }

}