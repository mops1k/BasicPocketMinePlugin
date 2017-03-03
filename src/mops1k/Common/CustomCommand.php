<?php
namespace mops1k\Common;

use mops1k\Plugin;

abstract class CustomCommand implements CommandInterface
{
    /** @var Plugin */
    private $plugin;

    /**
     * CartCommand constructor.
     */
    public function __construct()
    {
        $this->plugin = Plugin::getInstance();
    }
}
