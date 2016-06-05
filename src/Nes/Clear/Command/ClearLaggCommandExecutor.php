<?php
namespace Nes\Clear\Command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat as F;
use Sergey_Dertan\SClearLagg\SClearLaggMainFolder\SClearLaggMain;

/**
 * Class SClearLaggCommandExecutor
 * @package Sergey_Dertan\SClearLagg\Command
 */
class SClearLaggCommandExecutor
{
    /**
     * @param CommandSender $s
     * @param Command $cmd
     * @param array $args
     */
    function __construct(CommandSender $s, Command $cmd, array $args)
    {
        $this->executeCommand($s, $cmd, $args);
    }

    /**
     * @param CommandSender $s
     * @param Command $cmd
     * @param array $args
     * @return bool
     */
    private function executeCommand(CommandSender $s, Command $cmd, array $args)
    {
        $main = SClearLaggMain::getInstance();
        $entitiesManager = $main->getEntityManager();
        switch ($cmd->getName()) {
            case"clear":
                if (!isset($args[0])) {
                    $s->sendMessage(F::RED . "[GoldensPE] Clear V_" . $main->getDescription()->getVersion() . "\n /clear lagg - clear lagg server work 100%");
                    return true;
                }
                if (!in_array(strtolower($args[0]), array("clear", "mobkill"))) {
                    $s->sendMessage(F::RED . "[GoldensPE] use ' $args[0] ' command /clear");
                    return true;
                }
                switch (array_shift($args)) {
                    case"lagg":
                        $s->sendMessage(F::YELLOW . "[GoldensPE] clear ram ++ players " . $entitiesManager->removeEntities() . " of things");
                        return true;
                        break;
                    case"mobkill":
                        $s->sendMessage(F::YELLOW . "[GoldensPE] clear entities " . $entitiesManager->removeMobs() . " remove lagg !");
                        return true;
                        break;
                }
                break;
        }
        return true;
    }
}
