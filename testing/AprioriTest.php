<?php

use PHPUnit\Framework\TestCase;

include_once __DIR__ . '/../functions.php';

class AprioriTest extends TestCase
{
    public static $heroes;
    public static $lineups;
    public static $matchup_heroes;

    public static function setUpBeforeClass()
    {
        self::$heroes = [
            'ABADDON',
            'BANE',
            'BRISTLEBACK',
            'DEATH PROPHET',
            'DISRUPTOR',
            'FACELESS VOID',
            'INVOKER',
            'JUGGERNAUT',
            'LEGION COMMANDER',
            'LION',
            'MEDUSA',
            'MIRANA',
            'NATURES PROPHET',
            'NECROPHOS',
            'NYX ASSASSIN',
            'OMNIKNIGHT',
            'PUDGE',
            'PUGNA',
            'SHADOW FIEND',
            'SLARK',
            'SPECTRE',
            'SPIRIT BREAKER',
            'VIPER',
            'WINTER WYVERN',
            'WRAITH KING',
        ];
        self::$lineups =[
            'OMNIKNIGHT, PUDGE, SPECTRE, LEGION COMMANDER, DISRUPTOR, MEDUSA, ABADDON, WRAITH KING, PUGNA, NECROPHOS',
            'BANE, ABADDON, NYX ASSASSIN, SHADOW FIEND, NATURES PROPHET, WINTER WYVERN, INVOKER, PUDGE, SLARK, SPIRIT BREAKER',
            'DEATH PROPHET, JUGGERNAUT, ABADDON, LION, FACELESS VOID, VIPER, NECROPHOS, BRISTLEBACK, MIRANA, WRAITH KING',
        ];
        self::$matchup_heroes = [
            'str' => ['ABADDON','BRISTLEBACK','LEGION COMMANDER','OMNIKNIGHT','PUDGE','SPIRIT BREAKER','WRAITH KING'],
            'agi' => ['FACELESS VOID', 'JUGGERNAUT', 'MEDUSA', 'MIRANA', 'NYX ASSASSIN', 'SHADOW FIEND', 'SLARK', 'SPECTRE', 'VIPER'],
            'int' => ['BANE', 'DEATH PROPHET', 'DISRUPTOR', 'INVOKER', 'LION', 'NATURES PROPHET', 'NECROPHOS', 'PUGNA', 'WINTER WYVERN'],
        ];
    }

    public function test_empty_parameters_combinations()
    {
        $chosen_hero = '';
        $empty_heroes = [];
        $empty_lineups = [];
        $empty_matchup_heroes = [];

        // '', empty, empty, empty
        $result = apriori($chosen_hero, $empty_heroes, $empty_lineups, $empty_matchup_heroes);
        $this->assertFalse($result);

        // '', empty, empty, not empty
        $result = apriori($chosen_hero, self::$heroes, $empty_lineups, self::$matchup_heroes['str']);
        $this->assertFalse($result);

        // '', empty, not empty, empty
        $result = apriori($chosen_hero, $empty_heroes, self::$lineups, $empty_matchup_heroes);
        $this->assertFalse($result);

        // '', empty, not empty, not empty
        $result = apriori($chosen_hero, $empty_heroes, self::$lineups, self::$matchup_heroes['str']);
        $this->assertFalse($result);

        // '', not empty, empty, empty
        $result = apriori($chosen_hero, self::$heroes, $empty_lineups, $empty_matchup_heroes);
        $this->assertFalse($result);

        // '', not empty, empty, not empty
        $result = apriori($chosen_hero, self::$heroes, $empty_lineups, self::$matchup_heroes['str']);
        $this->assertFalse($result);

        // '', not empty, not empty, empty
        $result = apriori($chosen_hero, self::$heroes, self::$lineups, $empty_matchup_heroes);
        $this->assertFalse($result);
    }

    public function test_without_choosing_hero()
    {
        $str_result = apriori('', self::$heroes, self::$lineups, self::$matchup_heroes['str']);

        $this->assertEquals($str_result, [
            'name'        => 'PUDGE',
            'confidence'  => 66.67,
            'support'     => 66.67,
            'match_count' => 2,
        ]);


        $agi_result = apriori('', self::$heroes, self::$lineups, self::$matchup_heroes['agi']);

        $this->assertEquals($agi_result, [
            'name'        => 'FACELESS VOID',
            'confidence'  => 33.33,
            'support'     => 33.33,
            'match_count' => 1,
        ]);


        $int_result = apriori('', self::$heroes, self::$lineups, self::$matchup_heroes['int']);

        $this->assertEquals($int_result, [
            'name'        => 'NECROPHOS',
            'confidence'  => 66.67,
            'support'     => 66.67,
            'match_count' => 2,
        ]);
    }


    public function test_with_choosing_hero()
    {
        $str_result = apriori('NECROPHOS', self::$heroes, self::$lineups, self::$matchup_heroes['str']);

        $this->assertEquals($str_result, [
            'name'        => 'WRAITH KING',
            'confidence'  => 100,
            'support'     => 66.67,
            'match_count' => 2,
        ]);


        $agi_result = apriori('NECROPHOS', self::$heroes, self::$lineups, self::$matchup_heroes['agi']);

        $this->assertEquals($agi_result, [
            'name'        => 'SPECTRE',
            'confidence'  => 50,
            'support'     => 33.33,
            'match_count' => 1,
        ]);


        $int_result = apriori('NECROPHOS', self::$heroes, self::$lineups, self::$matchup_heroes['int']);

        $this->assertEquals($int_result, [
            'name'        => 'PUGNA',
            'confidence'  => 50,
            'support'     => 33.33,
            'match_count' => 1,
        ]);
    }
}
