<?php
namespace BasePlugin;

use BasePlugin\Common\CommandInterface;
use BasePlugin\Common\DatabaseBridge;
use BasePlugin\Exception\WrongCommandClassException;
use BasePlugin\Exception\WrongListenerClassException;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

class Plugin extends PluginBase
{
    /** @var Plugin */
    public static $instance;
    /** @var DatabaseBridge */
    public $db;
    /** @var string */
    private $namespace;
    /** @var array */
    private $pluginConfig = [];

    /**
     * Plugin constructor.
     */
    public function __construct()
    {
        self::$instance = $this;
        $this->db = new DatabaseBridge();
        $this->pluginConfig = \PluginConfig::getConfiguration();
        $this->namespace = $this->pluginConfig['namespace'];
    }

    /**
     * @return Plugin
     */
    public static function getInstance()
    {
        return self::$instance;
    }

    /**
     * On enable plugin method
     */
    public function onEnable()
    {
        $pluginManager = $this->getServer()->getPluginManager();
        if (!$this->getConfig()->get('enabled', true)) {
            $pluginManager->disablePlugin($this);
            return;
        }
        $this->saveDefaultConfig();

        if ($this->getConfig()->getNested('database')['enabled']) {
            $this->db->connect();
        }

        foreach ($this->getListeners() as $listener) {
            $listener = $this->namespace . "\\Listener\\" . ucfirst($listener) . "Listener";
            $listenerClass = new $listener();
            if (!$listenerClass instanceof Listener) {
                throw new WrongListenerClassException();
            }

            // register listener
            $pluginManager->registerEvents($listenerClass, $this);
        }
    }

    /**
     * @inheritdoc
     * @throws WrongCommandClassException
     */
    public function onCommand(CommandSender $sender, Command $command, $commandLabel, array $args)
    {
        if (in_array($command->getName(), $this->getCommands())) {
            $name = $this->namespace . "\\Command\\" . ucfirst($command->getName()) . "Command";

            $commandClass = new $name();
            if (!$commandClass instanceof CommandInterface) {
                throw new WrongCommandClassException();
            }

            call_user_func_array([$commandClass, 'exec'], [
                'sender'    => $sender,
                'args'      => $args
            ]);

            return true;
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    public function onDisable()
    {
        $this->db->disconnect();
    }

    /**
     * @return array
     */
    private function getCommands()
    {
        return $this->pluginConfig['commands'];
    }

    /**
     * @return array
     */
    private function getListeners()
    {
        return $this->pluginConfig['listeners'];
    }
}
