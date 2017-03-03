<?php
namespace BasePlugin\Common;

use BasePlugin\Plugin;

abstract class CustomCommand implements CommandInterface
{
    /** @var Plugin */
    protected $plugin;

    /**
     * CartCommand constructor.
     */
    public function __construct()
    {
        $this->plugin = Plugin::getInstance();
    }
}
