<?php
namespace BasePlugin\Common;

use pocketmine\command\CommandSender;

interface CommandInterface
{
    /**
     * @param CommandSender $sender
     * @param array $args
     */
    public function exec(CommandSender $sender, array $args);
}
