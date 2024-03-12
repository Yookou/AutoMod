<?php

namespace Yookou\AutoMod\events;

use JsonException;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use Yookou\AutoMod\Main;

class AutoModerationListener implements Listener {

	public function __construct(private Main $plugin) {
	}

	/**
	 * @throws JsonException
	 */
	public function onChat(PlayerChatEvent $event) : void {
		$player = $event->getPlayer();
		$pname = $player->getName();
		if ($this->plugin->getMuteAPI()->isMuted(mb_strtolower($pname))) {
			$event->cancel();
			$mute = $this->plugin->getMuteAPI()->getMute(mb_strtolower($pname));
			$mute = explode(":", $mute);
			$time = $mute[0];
			$reason = $mute[1];
			if ($time - time() <= 0) {
				$this->plugin->getMuteAPI()->deleteMute(mb_strtolower($pname));
			} else {
				$timee = $time - time();
				$player->sendMessage(str_replace(["{time}", "{reason}"], [$timee, $reason], Main::getInstance()->getConfig()->get("always-mute")));
			}

			return;
		}

		$message = $event->getMessage();
		if (Main::getInstance()->getConfig()->getNested("insult.on", true)) {
			$insult = Main::getInstance()->getConfig()->getNested("insult.words");
			$time = Main::getInstance()->getConfig()->getNested("insult.mute-time");
			$time2 = time() + ((int) $time);
			foreach ($insult as $value) {
				foreach (explode(" ", $message) as $args) {
					if (strtolower($args) === strtolower($value)) {
						$event->cancel();
						$this->plugin->getServer()->broadcastMessage(str_replace(["{time}", "{player}"], [$time, $pname], Main::getInstance()->getConfig()->getNested("insult.mute-broadcastmessage")));
						$player->sendMessage(str_replace("{time}", $time, Main::getInstance()->getConfig()->getNested("insult.mute-message")));
						$value = "{$time2}:insult";
						$this->plugin->getMuteAPI()->insertMute(mb_strtolower($pname), $value);
					}
				}
			}

			return;
		}

		if (Main::getInstance()->getConfig()->getNested("provoc.on", true)) {
			$provoc = Main::getInstance()->getConfig()->getNested("provoc.words");
			$time = Main::getInstance()->getConfig()->getNested("provoc.mute-time");
			$time2 = time() + ((int) $time);
			foreach ($provoc as $value) {
				foreach (explode(" ", $message) as $args) {
					if (strtolower($args) === strtolower($value)) {
						$event->cancel();
						$this->plugin->getServer()->broadcastMessage(str_replace(["{time}", "{player}"], [$time, $pname], Main::getInstance()->getConfig()->getNested("provoc.mute-broadcastmessage")));
						$player->sendMessage(str_replace("{time}", $time, Main::getInstance()->getConfig()->getNested("provoc.mute-message")));
						$value = "{$time2}:provoc";
						$this->plugin->getMuteAPI()->insertMute(mb_strtolower($pname), $value);
					}
				}
			}
		}
	}
}
