<?php
/**
 * Created by PhpStorm.
 * User: xZero
 * Date: 8/9/2018
 * Time: 6:42 PM
 */

namespace xZeroMCPE\UltraFaction\Faction\Event;


use pocketmine\Player;
use pocketmine\plugin\Plugin;
use xZeroMCPE\UltraFaction\Faction\Faction;

/**
 * Class MemberLeaveFactionEvent
 * @package xZeroMCPE\UltraFaction\Faction\Event
 */
class MemberLeaveFactionEvent extends FactionEvent
{

    public static $handlerList;

    /**
     * MemberLeaveFactionEvent constructor.
     * @param Plugin $plugin
     * @param $player
     * @param $faction
     */
    public function __construct(Plugin $plugin, Player $player, Faction $faction)
    {
        parent::__construct($plugin, $player, $faction);
    }
}