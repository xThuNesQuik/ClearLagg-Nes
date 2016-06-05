<?php
namespace Nes\Clear\ClearLaggMain;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use Nes\Clear\Command\ClearLaggCommandExecutor;
use Nes\Clear\Entity\EntityManager;
use pocketmine\utils\TextFormat as F;
use Nes\Clear\Task\TaskCreator;

/**
 * Class ClearLaggMain
 * @package Nes\ClearLagg\ClearLaggMain
 */
class ClearLaggMain extends PluginBase
{
    /**
     * @var ClearLaggMain
     */
    private static $instance;
    public $config;
    /**
     * @var \Nes\ClearLagg\Entity\EntityManager
     */
    private $entityManager;

    function __construct()
    {
        self::$instance = $this;
        $this->entityManager = new EntityManager($this);
    }

    /**
     * @return ClearLaggMain
     */
    static function getInstance()
    {
        return self::$instance;
    }

    /**
     * @return EntityManager
     */
    function getEntityManager()
    {
        return $this->entityManager;
    }

    function onEnable()
    {
        @mkdir($this->getDataFolder());
        $this->config = new Config($this->getDataFolder() . "Config.yml", Config::YAML, array(
            "Clear-msg" => "§8[§l§4Goldens§aPE§r§8]§7 Clear Entities @count Succefully!",
            "PreClear-msg" => "§8[§l§4Goldens§aPE§r§8]§7 Warning ClearLagg in §630§s!",
            "Clear-time" => 440
        ));
        new TaskCreator();
    }

    /**
     * @param CommandSender $s
     * @param Command $cmd
     * @param string $label
     * @param array $args
     * @return bool|SClearLaggCommandExecutor
     */
    function onCommand(CommandSender $s, Command $cmd, $label, array $args)
    {
        return new ClearLaggCommandExecutor($s, $cmd, $args);
    }

    function onDisable()
    {
        $this->config->save();
    }
}
