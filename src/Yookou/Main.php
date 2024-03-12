<?php

namespace Yookou;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;
use Yookou\AutoMod\api\MuteAPI;
use Yookou\AutoMod\events\AutoModerationListener;

class Main extends PluginBase {
	use SingletonTrait;

	protected function onLoad() : void {
		self::setInstance($this);
		$this->saveResource("Mute.json");
		$this->saveDefaultConfig();
	}

	protected function onEnable() : void {
		$this->getServer()->getPluginManager()->registerEvents(new AutoModerationListener($this), $this);
	}

	protected function onDisable() : void {
		$this->saveDefaultConfig();
		$this->saveResource("Mute.json");
	}

	public function getMuteAPI() : MuteAPI {
		return new MuteAPI($this);
	}
}
