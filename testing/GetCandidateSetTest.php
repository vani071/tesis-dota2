<?php
// phpcs:disable PSR1.Classes.ClassDeclaration

use PHPUnit\Framework\TestCase;

include_once __DIR__ . '/../apriori.php';

class GetCandidateSetTest extends TestCase
{
    public function testEmptyLineups()
    {
        $result = getCandidateSet([]);

        $this->assertEquals([], $result);
    }

    public function testOneItemCombination()
    {
        $result = getCandidateSet(['A' => 0, 'B' => 0, 'C' => 0, 'D' => 0, 'E' => 0]);

        $this->assertEquals($result, [
            'A+B' => null,
            'A+C' => null,
            'A+D' => null,
            'A+E' => null,
            'B+C' => null,
            'B+D' => null,
            'B+E' => null,
            'C+D' => null,
            'C+E' => null,
            'D+E' => null,
        ]);
    }

    public function testTwoItemCombination()
    {
        $result = getCandidateSet([
            'A+B' => 3,
            'A+C' => 5,
            'A+D' => 4,
            'A+E' => 2,
            'B+C' => 3,
            'B+D' => 2,
            'C+D' => 4,
            'C+E' => 2,
            'D+E' => 2,
        ]);

        $this->assertEquals($result, [
            'A+B+C' => null,
            'A+B+D' => null,
            'A+B+E' => null,
            'A+C+D' => null,
            'A+C+E' => null,
            'A+D+E' => null,
            'B+C+D' => null,
            'C+D+E' => null,
        ]);
    }

    public function testThreeItemCombination()
    {
        $result = getCandidateSet([
            'A+B+C' => 3,
            'A+B+D' => 2,
            'A+C+D' => 4,
            'A+C+E' => 2,
            'A+D+E' => 2,
            'B+C+D' => 2,
            'C+D+E' => 2,
        ]);

        $this->assertEquals($result, [
            'A+B+C+D' => null,
            'A+C+D+E' => null,
        ]);
    }
}
