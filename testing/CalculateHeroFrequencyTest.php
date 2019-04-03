<?php

use PHPUnit\Framework\TestCase;

include_once __DIR__ . '/../functions.php';

class CalculateHeroFrequencyTest extends TestCase
{
    public function test_empty_heroes_and_lineups()
    {
        $result = calculateHeroFrequency([], []);

        $this->assertEquals([], $result);
    }

    public function test_empty_heroes()
    {
        $result = calculateHeroFrequency([], [
            'OMNIKNIGHT, PUDGE, SPECTRE, LEGION COMMANDER, DISRUPTOR, MEDUSA, ABADDON, WRAITH KING, PUGNA, NECROPHOS',
            'BANE, ABADDON, NYX ASSASSIN, SHADOW FIEND, NATURES PROPHET, WINTER WYVERN, INVOKER, PUDGE, SLARK, SPIRIT BREAKER',
            'DEATH PROPHET, JUGGERNAUT, ABADDON, LION, FACELESS VOID, VIPER, NECROPHOS, BRISTLEBACK, MIRANA, WRAITH KING',
        ]);

        $this->assertEquals([], $result);
    }

    public function test_empty_lineups()
    {
        $result = calculateHeroFrequency([
            'ABADDON',
            'ALCHEMIST',
            'ANCIENT APPARITION',
        ], []);

        $this->assertEquals($result, [
            'ABADDON' => 0,
            'ALCHEMIST' => 0,
            'ANCIENT APPARITION' => 0,
        ]);
    }

    public function test_simple_data()
    {
        $result = calculateHeroFrequency([
            'ABADDON',
            'ALCHEMIST',
            'ANCIENT APPARITION',
        ], [
            'OMNIKNIGHT, PUDGE, SPECTRE, LEGION COMMANDER, DISRUPTOR, MEDUSA, ABADDON, WRAITH KING, PUGNA, NECROPHOS',
            'BANE, ABADDON, NYX ASSASSIN, SHADOW FIEND, NATURES PROPHET, WINTER WYVERN, INVOKER, PUDGE, SLARK, SPIRIT BREAKER',
            'DEATH PROPHET, JUGGERNAUT, ABADDON, LION, FACELESS VOID, VIPER, NECROPHOS, BRISTLEBACK, MIRANA, WRAITH KING',
            'ABADDON, SNIPER, BANE, QUEEN OF PAIN, LEGION COMMANDER, PHANTOM ASSASSIN, JAKIRO, TIDEHUNTER, SHADOW FIEND, CLOCKWERK',
            'AXE, EARTHSHAKER, LEGION COMMANDER, KUNKKA, WINDRANGER, ABADDON, NAGA SIREN, DAZZLE, STORM SPIRIT, PHOENIX',
            'WRAITH KING, TIDEHUNTER, ANCIENT APPARITION, IO, SNIPER, DOOM, SPIRIT BREAKER, ABADDON, ELDER TITAN, WEAVER',
            'EMBER SPIRIT, RIKI, BOUNTY HUNTER, VENGEFUL SPIRIT, WINDRANGER, LION, SPECTRE, ABADDON, SKYWRATH MAGE, STORM SPIRIT',
        ]);

        $this->assertEquals($result, [
            'ABADDON' => 7,
            'ALCHEMIST' => 0,
            'ANCIENT APPARITION' => 1,
        ]);
    }
}
