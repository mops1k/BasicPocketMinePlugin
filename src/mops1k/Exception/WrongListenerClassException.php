<?php
namespace mops1k\Exception;

use Exception;

class WrongListenerClassException extends Exception
{
    protected $message = 'Listener have to implement pocketmine\event\Listener';
}
