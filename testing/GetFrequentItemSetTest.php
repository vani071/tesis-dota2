<?php
// phpcs:disable PSR1.Classes.ClassDeclaration

use PHPUnit\Framework\TestCase;

include_once __DIR__ . '/../apriori.php';

class GetFrequentItemSetTest extends TestCase
{
    public function testEmptyParams()
    {
        $result = getFrequentItemSet([], []);

        $this->assertEquals([], $result);

        // phpcs:disable Generic.Files.LineLength
        $result = getFrequentItemSet([], [
            'OMNIKNIGHT, PUDGE, SPECTRE, LEGION COMMANDER, DISRUPTOR, MEDUSA, ABADDON, WRAITH KING, PUGNA, NECROPHOS',
            'BANE, ABADDON, NYX ASSASSIN, SHADOW FIEND, NATURES PROPHET, WINTER WYVERN, INVOKER, PUDGE, SLARK, SPIRIT BREAKER',
            'DEATH PROPHET, JUGGERNAUT, ABADDON, LION, FACELESS VOID, VIPER, NECROPHOS, BRISTLEBACK, MIRANA, WRAITH KING',
            'ABADDON, SNIPER, BANE, QUEEN OF PAIN, LEGION COMMANDER, PHANTOM ASSASSIN, JAKIRO, TIDEHUNTER, SHADOW FIEND, CLOCKWERK',
            'AXE, EARTHSHAKER, LEGION COMMANDER, KUNKKA, WINDRANGER, ABADDON, NAGA SIREN, DAZZLE, STORM SPIRIT, PHOENIX',
        ]);
        // phpcs:enable Generic.Files.LineLength

        $this->assertEquals([], $result);

        $result = getFrequentItemSet([
            'A+B' => null,
            'A+C' => null,
            'A+D' => null,
            'A+E' => null,
            'B+C' => null,
        ], []);

        $this->assertEquals($result, [
            'A+B' => null,
            'A+C' => null,
            'A+D' => null,
            'A+E' => null,
            'B+C' => null,
        ]);
    }

    public function testTwoCombination()
    {
        // phpcs:disable Generic.Files.LineLength
        $result = getFrequentItemSet([
            'ABADDON+BANE' => null,
            'ABADDON+LEGION COMMANDER' => null,
            'BANE+LEGION COMMANDER' => null,
        ], [
            'OMNIKNIGHT, PUDGE, SPECTRE, LEGION COMMANDER, DISRUPTOR, MEDUSA, ABADDON, WRAITH KING, PUGNA, NECROPHOS',
            'BANE, ABADDON, NYX ASSASSIN, SHADOW FIEND, NATURES PROPHET, WINTER WYVERN, INVOKER, PUDGE, SLARK, SPIRIT BREAKER',
            'DEATH PROPHET, JUGGERNAUT, ABADDON, LION, FACELESS VOID, VIPER, NECROPHOS, BRISTLEBACK, MIRANA, WRAITH KING',
            'ABADDON, SNIPER, BANE, QUEEN OF PAIN, LEGION COMMANDER, PHANTOM ASSASSIN, JAKIRO, TIDEHUNTER, SHADOW FIEND, CLOCKWERK',
            'AXE, EARTHSHAKER, LEGION COMMANDER, KUNKKA, WINDRANGER, ABADDON, NAGA SIREN, DAZZLE, STORM SPIRIT, PHOENIX',
        ]);
        // phpcs:enable Generic.Files.LineLength

        $this->assertEquals($result, [
            'ABADDON+BANE' => 2,
            'ABADDON+LEGION COMMANDER' => 3,
            'BANE+LEGION COMMANDER' => 1,
        ]);
    }

    public function testThreeCombination()
    {
        // phpcs:disable Generic.Files.LineLength
        $result = getFrequentItemSet([
            'ABADDON+BANE+SHADOW FIEND' => null,
            'ABADDON+LEGION COMMANDER+SPECTRE' => null,
            'BANE+LEGION COMMANDER+JAKIRO' => null,
        ], [
            'OMNIKNIGHT, PUDGE, SPECTRE, LEGION COMMANDER, DISRUPTOR, MEDUSA, ABADDON, WRAITH KING, PUGNA, NECROPHOS',
            'BANE, ABADDON, NYX ASSASSIN, SHADOW FIEND, NATURES PROPHET, WINTER WYVERN, INVOKER, PUDGE, SLARK, SPIRIT BREAKER',
            'DEATH PROPHET, JUGGERNAUT, ABADDON, LION, FACELESS VOID, VIPER, NECROPHOS, BRISTLEBACK, MIRANA, WRAITH KING',
            'ABADDON, SNIPER, BANE, QUEEN OF PAIN, LEGION COMMANDER, PHANTOM ASSASSIN, JAKIRO, TIDEHUNTER, SHADOW FIEND, CLOCKWERK',
            'AXE, EARTHSHAKER, LEGION COMMANDER, KUNKKA, WINDRANGER, ABADDON, NAGA SIREN, DAZZLE, STORM SPIRIT, PHOENIX',
        ]);
        // phpcs:enable Generic.Files.LineLength

        $this->assertEquals($result, [
            'ABADDON+BANE+SHADOW FIEND' => 2,
            'ABADDON+LEGION COMMANDER+SPECTRE' => 1,
            'BANE+LEGION COMMANDER+JAKIRO' => 1,
        ]);
    }
}
