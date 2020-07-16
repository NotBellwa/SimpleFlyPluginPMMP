<?php
declare(strict_types=1);
namespace NotBellwa\SimpleFly;

use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\utils\TextFormat as C;

class main extends PluginBase implements Listener {

    public $PlayerFly = [];

    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        if($command->getName() == "fly"){
            if($sender instanceof Player){
                if($sender->hasPermission("fly.command")) {
                    if(!isset($this->PlayerFly[$sender->getName()])) {
                        $this->PlayerFly[$sender->getName()] = true;
                        $sender->setFlying(true);
                        $sender->setAllowFlight(true);
                        $sender->sendMessage(C::AQUA . "Fly has been enabled");
                    }else{
                        unset($this->PlayerFly[$sender->getName()]);
                        $sender->setFlying(false);
                        $sender->setAllowFlight(false);
                        $sender->sendMessage(C::AQUA . "Fly has been disabled");
                    }
                }
            }
        }
        return true;
    }
}
