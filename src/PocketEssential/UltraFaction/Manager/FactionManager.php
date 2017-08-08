<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 8/7/2017
 * Time: 6:56 PM
 */

namespace PocketEssential\UltraFaction\Manager;


use PocketEssential\UltraFaction\UltraFaction;
use pocketmine\Player;

/**
 * Class FactionManager
 * @package PocketEssential\UltraFaction\Manager
 */
class FactionManager {

	/**
	 * @var UltraFaction
	 */
	public $plugin;
	/**
	 * @var FactionManager
	 */
	public static $instance;

	/**
	 * FactionManager constructor.
	 * @param UltraFaction $plugin
	 */
	public function __construct(UltraFaction $plugin){
		$this->plugin = $plugin;
		self::$instance = $this;
	}

	/**
	 * @return FactionManager
	 */
	public static function getInstance(){
		return self::$instance;
	}

	/**
	 * @param Player $player
	 * @return bool
	 */
	public function isInFaction(Player $player){

		$file = file_get_contents($this->plugin->getDataFolder() . "Factions/Data.json");

		$deject = json_decode($file, true);

		if(!isset($deject[$player->getName()])){
			return false;
		}else{
			return true;
		}
	}

	/**
	 * @param Player $player
	 * @return bool
	 */
	public function isLeader(Player $player){

		$file = file_get_contents($this->plugin->getDataFolder() . "Factions/Factions.json");

		$deject = json_decode($file, true);

		if($deject[$this->getFactionLeader($player)]['Leader'] == $player->getName()){
			return true;
		}else{
			return false;
		}
	}

	/**
	 * @param Player $player
	 * @return mixed
	 */
	public function getFactionLeader(Player $player){

		$file = file_get_contents($this->plugin->getDataFolder() . "Factions/Factions.json");

		$deject = json_decode($file, true);

		return $deject[$this->getFactionLeader($player)]['Leader'];
	}

	/**
	 * @param Player $player
	 */
	public function deleteFaction(Player $player){

		$file = file_get_contents($this->plugin->getDataFolder() . "Factions/Factions.json");

		$deject = json_decode($file, true);

		unset($deject[$this->getFaction($player)]);

		file_put_contents($this->plugin->getDataFolder() . "Factions/Factions.json", json_encode($deject, JSON_PRETTY_PRINT));
	}

	/**
	 * @param Player $player
	 * @return mixed
	 */
	public function getFaction(Player $player){

		$file = file_get_contents($this->plugin->getDataFolder() . "Factions/Data.json");

		$deject = json_decode($file, true);

		return $deject[$player->getName()]['Faction'];
	}

	/**
	 * @param Player $player
	 * @param $name
	 */
	public function createFaction(Player $player, $name){

		$file = file_get_contents($this->plugin->getDataFolder() . "Factions/Factions.json");

		$deject = json_decode($file, true);

		$data = [
			"Member" => [],
			"Leader" => $player->getName(),
			"Home" => null,
			"Claimed" => null,
			"Name" => $name,
		];

		$deject[$name] = $data;

		file_put_contents($this->plugin->getDataFolder() . "Factions/Factions.json", json_encode($deject, JSON_PRETTY_PRINT));
	}

	/**
	 * @param $name
	 * @return bool
	 */
	public function isNameTaken($name){

		$file = file_get_contents($this->plugin->getDataFolder() . "Factions/Factions.json");

		$deject = json_decode($file, true);

		if(isset($deject[$name])){
			return true;
		}else{
			return false;
		}
	}
}