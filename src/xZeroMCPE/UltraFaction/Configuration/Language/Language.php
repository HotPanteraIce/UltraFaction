<?php
/**
 * Created by PhpStorm.
 * User: xZero
 * Date: 8/9/2018
 * Time: 4:59 PM
 */

namespace xZeroMCPE\UltraFaction\Configuration\Language;


use xZeroMCPE\UltraFaction\UltraFaction;

/**
 * Class Language
 * @package xZeroMCPE\UltraFaction\Configuration\Language
 */
class Language
{

    public $language = [];
    public $workingLanguage = false;

    public function __construct()
    {
        $this->loadLanguage();
    }

    public function loadLanguage()
    {

        if (!file_exists(UltraFaction::getInstance()->getConfiguration()->getDataFolder() . "Languages/")) {
            @mkdir(UltraFaction::getInstance()->getConfiguration()->getDataFolder() . "Languages");
            foreach (glob(__DIR__ . "/Defaults/*") as $languages) {
                file_put_contents(UltraFaction::getInstance()->getConfiguration()->getDataFolder() . "Languages/" . basename($languages), file_get_contents(__DIR__ . "/Defaults/" . basename($languages)));
            }
        }


        $language = UltraFaction::getInstance()->getConfiguration()->getConfig()['Data']['Language'];

        if (!file_exists(UltraFaction::getInstance()->getConfiguration()->getDataFolder() . "Languages/" . $language . ".json")) {
            UltraFaction::getInstance()->getLogger()->error("[LANGUAGE] We couldn't find the language file corresponding to " . $language . ". Please make sure {$language}.json exists");
        } else {
            $this->language = json_decode(file_get_contents(UltraFaction::getInstance()->getConfiguration()->getDataFolder() . "Languages/" . $language . ".json"), true);
            $this->workingLanguage = true;
        }
    }

    /**
     * @param string $type
     * @return string
     */
    public function getLanguageValue(string $type): string
    {
        if (isset($this->language[$type])) {
            return $this->language[$type];
        } else {
            return "ERROR_LANGUAGE_NOT_FOUND [{$type}]";
        }
    }

    /**
     * @param string $type
     * @return array
     */
    public function getLanguageValueArray(string $type): array
    {
        if (isset($this->language[$type])) {
            return $this->language[$type];
        } else {
            return ["ERROR_LANGUAGE_NOT_FOUND [{$type}]_ARRAY"];
        }
    }
}