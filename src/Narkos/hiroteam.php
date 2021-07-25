<?php

namespace Narkos;


use Narkos\Commands\Rtp;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

class hiroteam extends PluginBase implements Listener{
    private static $main;
    public function onEnable()
    {
        @mkdir($this->getDataFolder());
        if (!file_exists($this->getDataFolder() . "config.yml")){
            $this->saveResource("config.yml");
        }

        $this->getLogger()->info("CommandHiroteam RTP");
        self::$main = $this;
        $this->getServer()->getCommandMap()->register("rtp", new Rtp($this));
    }

    public function onDisable()
    {
        $this->getLogger()->info("CommandHiroteam RTP");
    }

    public function onCommand(CommandSender $player, Command $command, string $label, array $args): bool
    {
        switch ($command->getName()){
            case "reloadrtp":
                $this->getConfig()->reload();
                $player->sendMessage("La config a bien été reload !");
                break;
        }
        return true;
    }

    public static function getInstance(): hiroteam {
        return self::$main;
    }
}
