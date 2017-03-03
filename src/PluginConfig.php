<?php

class PluginConfig
{
    public static function getConfiguration()
    {
        return [
            'namespace' => null,
            'commands'  => [],
            'listeners' => [],
        ];
    }
}