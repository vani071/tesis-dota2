<?php
// phpcs:disable PSR1.Classes.ClassDeclaration

use PHPUnit\Framework\TestCase;

include_once __DIR__ . '/../apriori.php';

class GetFirstFrequentItemSetTest extends TestCase
{
    public function testEmptyLineups()
    {
        $result = getFirstFrequentItemSet([]);

        $this->assertEquals([], $result);
    }

    public function testSimpleData()
    {
        // phpcs:disable Generic.Files.LineLength
        $result = getFirstFrequentItemSet([
            'OMNIKNIGHT, PUDGE, SPECTRE, LEGION COMMANDER, DISRUPTOR, MEDUSA, ABADDON, WRAITH KING, PUGNA, NECROPHOS',
            'BANE, ABADDON, NYX ASSASSIN, SHADOW FIEND, NATURES PROPHET, WINTER WYVERN, INVOKER, PUDGE, SLARK, SPIRIT BREAKER',
            'DEATH PROPHET, JUGGERNAUT, ABADDON, LION, FACELESS VOID, VIPER, NECROPHOS, BRISTLEBACK, MIRANA, WRAITH KING',
            'ABADDON, SNIPER, BANE, QUEEN OF PAIN, LEGION COMMANDER, PHANTOM ASSASSIN, JAKIRO, TIDEHUNTER, SHADOW FIEND, CLOCKWERK',
            'AXE, EARTHSHAKER, LEGION COMMANDER, KUNKKA, WINDRANGER, ABADDON, NAGA SIREN, DAZZLE, STORM SPIRIT, PHOENIX',
        ]);
        // phpcs:enable Generic.Files.LineLength

        $this->assertEquals($result, [
            'ABADDON'          => 5,
            'AXE'              => 1,
            'BANE'             => 2,
            'BRISTLEBACK'      => 1,
            'CLOCKWERK'        => 1,
            'DAZZLE'           => 1,
            'DEATH PROPHET'    => 1,
            'DISRUPTOR'        => 1,
            'EARTHSHAKER'      => 1,
            'FACELESS VOID'    => 1,
            'INVOKER'          => 1,
            'JAKIRO'           => 1,
            'JUGGERNAUT'       => 1,
            'KUNKKA'           => 1,
            'LEGION COMMANDER' => 3,
            'LION'             => 1,
            'MEDUSA'           => 1,
            'MIRANA'           => 1,
            'NAGA SIREN'       => 1,
            'NATURES PROPHET'  => 1,
            'NECROPHOS'        => 2,
            'NYX ASSASSIN'     => 1,
            'OMNIKNIGHT'       => 1,
            'PHANTOM ASSASSIN' => 1,
            'PHOENIX'          => 1,
            'PUDGE'            => 2,
            'PUGNA'            => 1,
            'QUEEN OF PAIN'    => 1,
            'SHADOW FIEND'     => 2,
            'SLARK'            => 1,
            'SNIPER'           => 1,
            'SPECTRE'          => 1,
            'SPIRIT BREAKER'   => 1,
            'STORM SPIRIT'     => 1,
            'TIDEHUNTER'       => 1,
            'VIPER'            => 1,
            'WINDRANGER'       => 1,
            'WINTER WYVERN'    => 1,
            'WRAITH KING'      => 2,
        ]);
    }

    public function testSameItemCountedAsOne()
    {
        // phpcs:disable Generic.Files.LineLength
        $result = getFirstFrequentItemSet([
            'PUDGE, PUDGE, PUDGE, PUDGE, OMNIKNIGHT, OMNIKNIGHT, OMNIKNIGHT, PUDGE, OMNIKNIGHT, DISRUPTOR',
        ]);
        // phpcs:enable Generic.Files.LineLength

        $this->assertEquals($result, [
            'PUDGE' => 1,
            'OMNIKNIGHT' => 1,
            'DISRUPTOR' => 1,
        ]);
    }

    public function testDelimiterWithoutSpace()
    {
        // phpcs:disable Generic.Files.LineLength
        $result = getFirstFrequentItemSet([
            'OMNIKNIGHT, PUDGE, SPECTRE, LEGION COMMANDER, DISRUPTOR,MEDUSA, ABADDON, WRAITH KING, PUGNA, NECROPHOS',
        ]);
        // phpcs:enable Generic.Files.LineLength

        $this->assertEquals($result, [
            'ABADDON'          => 1,
            'DISRUPTOR'        => 1,
            'LEGION COMMANDER' => 1,
            'MEDUSA'           => 1,
            'NECROPHOS'        => 1,
            'OMNIKNIGHT'       => 1,
            'PUDGE'            => 1,
            'PUGNA'            => 1,
            'SPECTRE'          => 1,
            'WRAITH KING'      => 1,
        ]);
    }
}
