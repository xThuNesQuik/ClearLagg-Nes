<?php
namespace Nes\Clear\Task;

use pocketmine\Server;
use Nes\Clear\ClearLaggMain\ClearLaggMain;

/**
 * Class TaskCreator
 * @package Sergey_Dertan\SClearLagg\Task
 */
class TaskCreator
{
    function __construct()
    {
        $this->main = SClearLaggMain::getInstance();
        $this->createTasks($this->main);
    }

    /**
     * @param SClearLaggMain $main
     */
    private function createTasks(SClearLaggMain $main)
    {
        Server::getInstance()->getScheduler()->scheduleRepeatingTask(new ClearTask($main), $main->config->getAll()["Clear-time"] * 20);
        Server::getInstance()->getScheduler()->scheduleRepeatingTask(new MsgTask($main), ($main->config->getAll()["Clear-time"] - 60) * 20);
    }
}