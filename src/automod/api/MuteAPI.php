<?php

namespace automod\api;

use automod\Main;
use JsonException;
use pocketmine\utils\Config;

class MuteAPI {
    private Main $plugin;

    public function __construct(Main $plugin) {
        $this->plugin = $plugin;
    }

    /**
     * @throws JsonException
     */
    public function insertMute($name, $value) : void {
        $name = mb_strtolower($name);
        $config = new Config($this->plugin->getDataFolder() . "Mute.json", Config::JSON);
        $config->set($name, $value);
        $config->save();
    }

    public function isMuted($name) : bool {
        $name = mb_strtolower($name);
        $config = new Config($this->plugin->getDataFolder() . "Mute.json", Config::JSON);

        return $config->exists($name);
    }

    /**
     * @throws JsonException
     */
    public function deleteMute($name) : void {
        $name = mb_strtolower($name);
        $config = new Config($this->plugin->getDataFolder() . "Mute.json", Config::JSON);
        $config->remove($name);
        $config->save();
    }

    public function getMute($name) {
        $name = mb_strtolower($name);
        $config = new Config($this->plugin->getDataFolder() . "Mute.json", Config::JSON);

        return $config->get($name);
    }
}