<?php

namespace Yookou\AutoMod\api;

use function automod\api\mb_strtolower;
use JsonException;
use pocketmine\utils\Config;
use Yookou\Main;

class MuteAPI {
	private Main $plugin;

	public function __construct(Main $plugin) {
		$this->plugin = $plugin;
	}

	/**
	 * @throws JsonException
	 */
	public function insertMute(string $name, $value) : void {
		$name = mb_strtolower($name);
		$config = new Config($this->plugin->getDataFolder() . "Mute.json", Config::JSON);
		$config->set($name, $value);
		$config->save();
	}

	public function isMuted(string $name) : bool {
		$name = mb_strtolower($name);
		$config = new Config($this->plugin->getDataFolder() . "Mute.json", Config::JSON);

		return $config->exists($name);
	}

	/**
	 * @throws JsonException
	 */
	public function deleteMute(string $name) : void {
		$name = mb_strtolower($name);
		$config = new Config($this->plugin->getDataFolder() . "Mute.json", Config::JSON);
		$config->remove($name);
		$config->save();
	}

	public function getMute(string $name) {
		$name = mb_strtolower($name);
		$config = new Config($this->plugin->getDataFolder() . "Mute.json", Config::JSON);

		return $config->get($name);
	}
}
