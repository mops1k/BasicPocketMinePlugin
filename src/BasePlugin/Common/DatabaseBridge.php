<?php
namespace BasePlugin\Common;

use LessQL\Database;
use BasePlugin\Plugin;

class DatabaseBridge
{
    /** @var Database|null */
    private static $db = null;

    private function getConfigData()
    {
        return Plugin::getInstance()->getConfig()->getNested('database');
    }

    public function connect()
    {
        $pdo = new \PDO(
            $this->getConfigData()['type']
            . ':host=' . $this->getConfigData()['host']
            . ';port=' . $this->getConfigData()['port']
            . ';dbname=' . $this->getConfigData()['db'],
            $this->getConfigData()['user'],
            $this->getConfigData()['password']
        );
        self::$db = new Database($pdo);

        return $this;
    }

    /**
     * @return Database|null
     */
    public static function getORM()
    {
        return self::$db;
    }

    /**
     * @return self
     */
    public function disconnect()
    {
        self::$db = null;

        return $this;
    }
}
