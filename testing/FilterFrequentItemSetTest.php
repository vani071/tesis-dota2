<?php
// phpcs:disable PSR1.Classes.ClassDeclaration

use PHPUnit\Framework\TestCase;

include_once __DIR__ . '/../apriori.php';

class FilterFrequentItemSetTest extends TestCase
{
    public function testEmptyLineups()
    {
        $result = filterFrequentItemSet([], 1);

        $this->assertEquals([], $result);
    }

    public function testSimpleData()
    {
        $candidate_set = [
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
        ];

        $result = filterFrequentItemSet($candidate_set, 2);

        $this->assertEquals($result, [
            'ABADDON'          => 5,
            'BANE'             => 2,
            'LEGION COMMANDER' => 3,
            'NECROPHOS'        => 2,
            'PUDGE'            => 2,
            'SHADOW FIEND'     => 2,
            'WRAITH KING'      => 2,
        ]);


        $result = filterFrequentItemSet($candidate_set, 3);

        $this->assertEquals($result, [
            'ABADDON'          => 5,
            'LEGION COMMANDER' => 3,
        ]);
    }
}
