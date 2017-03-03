<?php
namespace BasePlugin\Exception;

use Exception;

class WrongCommandClassException extends Exception
{
    protected $message = 'Command have to implement mops1k\Common\CommandInterface';
}
