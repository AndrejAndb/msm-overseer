<?php


namespace msm;


use CharlotteDunois\Yasmin\Models\Guild;
use msm\Db\RedisConnection;

class GuildConfig
{
    protected $guildId;
    protected $baseConfig = null;
    protected $dbConnection = null;

    public function __construct(Guild $guild)
    {
        $this->guildId = $guild->id;
        $this->retrieveBaseConfig();
    }

    protected function retrieveBaseConfig()
    {
        $file = APP_PATH . '/config/' . $this->guildId . '.ini';
        if(is_readable($file)) {
            $conf = parse_ini_file($file, false, INI_SCANNER_TYPED);
            if(!empty($conf)) {
                $this->baseConfig = $conf;
            }
        }
    }

    public function isConfigured()
    {
        return !empty($this->baseConfig);
    }

    /**
     * @return null
     */
    public function getBaseConfig()
    {
        return $this->baseConfig;
    }

    public function getDbConnection() {
        if(!$this->dbConnection) {
            $this->dbConnection = new RedisConnection($this);
        }
        return $this->dbConnection;
    }
}