<?php

use PHPUnit\Framework\TestCase;

include_once __DIR__ . '/../apriori.php';

class Apriori2Test extends TestCase
{
    public function testEmptyParams()
    {
        $result = apriori([]);
        $this->assertFalse($result);

        $result = apriori([], '', 199);
        $this->assertFalse($result);

        $result = apriori(['A, B, C'], 'Z');
        $this->assertFalse($result);
    }

    /**
     * From Example 1 at http://www2.cs.uregina.ca/~dbd/cs831/notes/itemsets/itemset_apriori.html
     * Minimum Support: 50% ~ Minimum Frequency: 50% of 4 = 2
     * @return [type] [description]
     */
    public function testRegina1()
    {
        $transactions = [
            'A,C,D',
            'B,D',
            'A,B,C,E',
            'B,D,F',
        ];

        $result = apriori($transactions, null, 2);

        $this->assertEquals($result, [
            [
                'A' => 2,
                'B' => 3,
                'C' => 2,
                'D' => 3,
            ],
            [
                'A+C' => 2,
                'B+D' => 2,
            ]
        ]);
    }

    /**
     * From Example 2 at http://www2.cs.uregina.ca/~dbd/cs831/notes/itemsets/itemset_apriori.html
     * Minimum Support: 40% ~ Minimum Frequency: 40% of 4 = 2
     * @return [type] [description]
     */
    public function testRegina2()
    {
        $transactions = [
            'A,B,C',
            'A,B,C,D,E',
            'A,C,D',
            'A,C,D,E',
            'A,B,C,D',
        ];

        $result = apriori($transactions, null, 2);

        $this->assertEquals($result, [
            [
                'A' => 5,
                'B' => 3,
                'C' => 5,
                'D' => 4,
                'E' => 2,
            ],
            [
                'A+B' => 3,
                'A+C' => 5,
                'A+D' => 4,
                'A+E' => 2,
                'B+C' => 3,
                'B+D' => 2,
                'C+D' => 4,
                'C+E' => 2,
                'D+E' => 2,
            ],
            [
                'A+B+C' => 3,
                'A+B+D' => 2,
                'A+C+D' => 4,
                'A+C+E' => 2,
                'A+D+E' => 2,
                'B+C+D' => 2,
                'C+D+E' => 2,
            ],
            [
                'A+B+C+D' => 2,
                'A+C+D+E' => 2,
            ]
        ]);
    }

    /**
     * Reference: http://nikhilvithlani.blogspot.com/2012/03/apriori-algorithm-for-data-mining-made.html
     * Note: items that repeat in one transaction are written once
     *       Modified because we sort the item 'M+K' => 'K+M'
     *       Minimum support: 60% ~ 3 frequency
     */
    public function testNikhilVithlani()
    {
        $transactions = [
            'M, O, N, K, E, Y',
            'D, O, N, K, E, Y',
            'M, A, K, E',
            'M, U, C, K, Y',
            'C, O, K, I, E',
        ];

        $result = apriori($transactions, null, 3);

        $this->assertEquals($result, [
            [
                'M' => 3,
                'O' => 3,
                'K' => 5,
                'E' => 4,
                'Y' => 3,
            ],
            [
                'E+K' => 4,
                'E+O' => 3,
                'K+M' => 3,
                'K+O' => 3,
                'K+Y' => 3,
            ],
            [
                'E+K+O' => 3,
            ]
        ]);
    }
}
