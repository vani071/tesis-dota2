<?php

use PHPUnit\Framework\TestCase;

include_once __DIR__ . '/../apriori.php';

class CountCombinationInLineupsTest extends TestCase
{
    public function testEmptyParams()
    {
        $lineups = file('data.txt',FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        $result = countCombinationInLineups('', []);

        $this->assertEquals($result, 0);

        $result = countCombinationInLineups('', $lineups);

        $this->assertEquals($result, 0);

        $result = countCombinationInLineups('IO', []);

        $this->assertEquals($result, 0);
    }

    public function testOneHero()
    {
        $lineups = file('data.txt',FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $result = countCombinationInLineups('IO', $lineups);

        $this->assertEquals($result, 6);
    }

    public function testTwoPairs()
    {
        $lineups = file('data.txt',FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $result = countCombinationInLineups('IO+LEGION COMMANDER', $lineups);

        $this->assertEquals($result, 1);
    }
}
