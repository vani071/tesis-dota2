<?php
// phpcs:disable PSR1.Classes.ClassDeclaration

use PHPUnit\Framework\TestCase;

include_once __DIR__ . '/../apriori.php';

class PruneLastCandidateSetTest extends TestCase
{
    public function testEmptyArrayParams()
    {
        $result = pruneLastCandidateSet([], [], 3);

        $this->assertEquals($result, []);

        $prev_freq_itemset = ['A+E' => 2];
        $result = pruneLastCandidateSet([], $prev_freq_itemset, 3);

        $this->assertEquals($result, []);

        $candidate_set = ['A+B+D' => null, 'A+B+E' => null];
        $result = pruneLastCandidateSet($candidate_set, [], 3);

        $this->assertEquals($result, $candidate_set);
    }

    public function testThreeItemCombination()
    {
        $candidate_set = [
            'A+B+C' => null,
            'A+B+D' => null,
            'A+B+E' => null,
            'A+C+D' => null,
            'A+C+E' => null,
            'A+D+E' => null,
            'B+C+D' => null,
            'C+D+E' => null,
        ];
        $prev_freq_itemset = [
            'A+B' => 3,
            'A+C' => 5,
            'A+D' => 4,
            'A+E' => 2,
            'B+C' => 3,
            'B+D' => 2,
            'B+E' => 1,
            'C+D' => 4,
            'C+E' => 2,
            'D+E' => 2,
        ];
        $result = pruneLastCandidateSet($candidate_set, $prev_freq_itemset, 2);

        $this->assertEquals($result, [
            'A+B+C' => null,
            'A+B+D' => null,
            'A+C+D' => null,
            'A+C+E' => null,
            'A+D+E' => null,
            'B+C+D' => null,
            'C+D+E' => null,
        ]);
    }

    public function testFourItemCombination()
    {
        $candidate_set = [
            'A+B+C+D' => null,
            'A+C+D+E' => null,
        ];
        $prev_freq_itemset = [
            'A+B+C' => 3,
            'A+B+D' => 2,
            'A+C+D' => 4,
            'A+C+E' => 2,
            'A+D+E' => 2,
            'B+C+D' => 2,
            'C+D+E' => 2,
        ];
        $result = pruneLastCandidateSet($candidate_set, $prev_freq_itemset, 2);

        $this->assertEquals($result, [
            'A+B+C+D' => null,
            'A+C+D+E' => null,
        ]);
    }
}
