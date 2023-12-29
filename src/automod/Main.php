<?php

namespace automod;

use automod\api\MuteAPI;
use automod\events\AutoModeration;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;

class Main extends PluginBase {

    use SingletonTrait;

    public function onLoad(): void {
        $this->saveResource("Mute.json");
        $this->saveDefaultConfig();
    }

    public function onEnable(): void {
        self::setInstance($this);
        $this->getServer()->getPluginManager()->registerEvents(new AutoModeration($this), $this);
    }

    public function onDisable(): void {
        $this->saveDefaultConfig();
        $this->saveResource("Mute.json");
    }

    public function getMuteAPI() : MuteAPI {
        return new MuteAPI($this);
    }
}