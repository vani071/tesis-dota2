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

        $result = apriori(['A, B, C', 'C,D'], 'Z');
        $this->assertFalse($result);
    }

    public function testAllItemFrequencySmallerThanMinimum()
    {
        $result = apriori(['A, B, C', 'D,E'], '', 2);
        $this->assertFalse($result);
    }

    public function testAutoChosenHero()
    {
        $result = apriori(['A, B, C', 'C,D'], '');
        $this->assertEquals($result, [['C' => ['frequency' => 2, 'support' => 100]]]);

        $result = apriori(['A, B, C, D', 'C,D', 'D, E'], '');
        $this->assertEquals($result, [
            [
                'C' => ['frequency' => 2, 'support' => 66.66666666666666],
                'D' => ['frequency' => 3, 'support' => 100],
            ],
            [
                'C+D' => [
                    'pairs' => ['C'],
                    'frequency' => 2,
                    'support' => 66.66666666666666,
                    'confidence' => 66.66666666666666
                ],
            ],
        ]);
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
                'A' => ['frequency' => 2, 'support' => 50],
                'B' => ['frequency' => 3, 'support' => 75],
                'C' => ['frequency' => 2, 'support' => 50],
                'D' => ['frequency' => 3, 'support' => 75],
            ],
            [
                'A+C' => ['frequency' => 2, 'support' => 50],
                'B+D' => ['frequency' => 2, 'support' => 50],
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
                'A' => ['frequency' => 5, 'support' => 100],
                'B' => ['frequency' => 3, 'support' => 60],
                'C' => ['frequency' => 5, 'support' => 100],
                'D' => ['frequency' => 4, 'support' => 80],
                'E' => ['frequency' => 2, 'support' => 40],
            ],
            [
                'A+B' => ['frequency' => 3, 'support' => 60],
                'A+C' => ['frequency' => 5, 'support' => 100],
                'A+D' => ['frequency' => 4, 'support' => 80],
                'A+E' => ['frequency' => 2, 'support' => 40],
                'B+C' => ['frequency' => 3, 'support' => 60],
                'B+D' => ['frequency' => 2, 'support' => 40],
                'C+D' => ['frequency' => 4, 'support' => 80],
                'C+E' => ['frequency' => 2, 'support' => 40],
                'D+E' => ['frequency' => 2, 'support' => 40],
            ],
            [
                'A+B+C' => ['frequency' => 3, 'support' => 60],
                'A+B+D' => ['frequency' => 2, 'support' => 40],
                'A+C+D' => ['frequency' => 4, 'support' => 80],
                'A+C+E' => ['frequency' => 2, 'support' => 40],
                'A+D+E' => ['frequency' => 2, 'support' => 40],
                'B+C+D' => ['frequency' => 2, 'support' => 40],
                'C+D+E' => ['frequency' => 2, 'support' => 40],
            ],
            [
                'A+B+C+D' => ['frequency' => 2, 'support' => 40],
                'A+C+D+E' => ['frequency' => 2, 'support' => 40],
            ]
        ]);
    }

    // /**
    //  * Reference: http://nikhilvithlani.blogspot.com/2012/03/apriori-algorithm-for-data-mining-made.html
    //  * Note: items that repeat in one transaction are written once
    //  *       Modified because we sort the item 'M+K' => 'K+M'
    //  *       Minimum support: 60% ~ 3 frequency
    //  */
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
                'M' => ['frequency' => 3, 'support' => 60],
                'O' => ['frequency' => 3, 'support' => 60],
                'K' => ['frequency' => 5, 'support' => 100],
                'E' => ['frequency' => 4, 'support' => 80],
                'Y' => ['frequency' => 3, 'support' => 60],
            ],
            [
                'E+K' => ['frequency' => 4, 'support' => 80],
                'E+O' => ['frequency' => 3, 'support' => 60],
                'K+M' => ['frequency' => 3, 'support' => 60],
                'K+O' => ['frequency' => 3, 'support' => 60],
                'K+Y' => ['frequency' => 3, 'support' => 60],
            ],
            [
                'E+K+O' => ['frequency' => 3, 'support' => 60],
            ]
        ]);
    }

    public function testWithChoosenHero()
    {
        $lineups = [
            'OMNIKNIGHT, PUDGE, SPECTRE, LEGION COMMANDER, DISRUPTOR, MEDUSA, ABADDON, WRAITH KING, PUGNA, NECROPHOS',
            'BANE, ABADDON, NYX ASSASSIN, SHADOW FIEND, NATURES PROPHET, WINTER WYVERN, INVOKER, PUDGE, SLARK, SPIRIT BREAKER',
            'DEATH PROPHET, JUGGERNAUT, ABADDON, LION, FACELESS VOID, VIPER, NECROPHOS, BRISTLEBACK, MIRANA, WRAITH KING',
            'ABADDON, SNIPER, BANE, QUEEN OF PAIN, LEGION COMMANDER, PHANTOM ASSASSIN, JAKIRO, TIDEHUNTER, SHADOW FIEND, CLOCKWERK',
            'AXE, EARTHSHAKER, LEGION COMMANDER, KUNKKA, WINDRANGER, ABADDON, NAGA SIREN, DAZZLE, STORM SPIRIT, PHOENIX',
        ];

        $result = apriori($lineups, 'ABADDON', 2);

        $this->assertEquals($result, [
            [
                'ABADDON'           => ['frequency' => 5, 'support' => 100],
                'BANE'              => ['frequency' => 2, 'support' => 40],
                'LEGION COMMANDER'  => ['frequency' => 3, 'support' => 60],
                'NECROPHOS'         => ['frequency' => 2, 'support' => 40],
                'PUDGE'             => ['frequency' => 2, 'support' => 40],
                'SHADOW FIEND'      => ['frequency' => 2, 'support' => 40],
                'WRAITH KING'       => ['frequency' => 2, 'support' => 40],
            ],
            [
                'ABADDON+BANE' => [
                    'pairs' => ['BANE'], 'frequency' => 2, 'support' => 40, 'confidence' => 40
                ],
                'ABADDON+LEGION COMMANDER' => [
                    'pairs' => ['LEGION COMMANDER'], 'frequency' => 3, 'support' => 60, 'confidence' => 60
                ],
                'ABADDON+NECROPHOS' => [
                    'pairs' => ['NECROPHOS'], 'frequency' => 2, 'support' => 40, 'confidence' => 40
                ],
                'ABADDON+PUDGE' => [
                    'pairs' => ['PUDGE'], 'frequency' => 2, 'support' => 40, 'confidence' => 40
                ],
                'ABADDON+SHADOW FIEND' => [
                    'pairs' => ['SHADOW FIEND'], 'frequency' => 2, 'support' => 40, 'confidence' => 40
                ],
                'ABADDON+WRAITH KING' => [
                    'pairs' => ['WRAITH KING'], 'frequency' => 2, 'support' => 40, 'confidence' => 40
                ],
            ],
            [
                'ABADDON+BANE+SHADOW FIEND' => [
                    'pairs' => ['BANE', 'SHADOW FIEND'], 'frequency' => 2, 'support' => 40, 'confidence' => 40
                ],
                'ABADDON+NECROPHOS+WRAITH KING' => [
                    'pairs' => ['NECROPHOS', 'WRAITH KING'], 'frequency' => 2, 'support' => 40, 'confidence' => 40
                ],
            ]
        ]);
    }


    public function testWithChoosenHero2()
    {
        $lineups = [
            'OMNIKNIGHT, PUDGE, SPECTRE, LEGION COMMANDER, DISRUPTOR, MEDUSA, ABADDON, WRAITH KING, PUGNA, NECROPHOS',
            'BANE, ABADDON, NYX ASSASSIN, SHADOW FIEND, NATURES PROPHET, WINTER WYVERN, INVOKER, PUDGE, SLARK, SPIRIT BREAKER',
            'DEATH PROPHET, JUGGERNAUT, ABADDON, LION, FACELESS VOID, VIPER, NECROPHOS, BRISTLEBACK, MIRANA, WRAITH KING',
            'ABADDON, SNIPER, BANE, QUEEN OF PAIN, LEGION COMMANDER, PHANTOM ASSASSIN, JAKIRO, TIDEHUNTER, SHADOW FIEND, CLOCKWERK',
            'AXE, EARTHSHAKER, LEGION COMMANDER, KUNKKA, WINDRANGER, ABADDON, NAGA SIREN, DAZZLE, STORM SPIRIT, PHOENIX',
        ];

        $result = apriori($lineups, 'LEGION COMMANDER', 2);

        $this->assertEquals($result, [
            [
                'ABADDON'           => ['frequency' => 5, 'support' => 100],
                'BANE'              => ['frequency' => 2, 'support' => 40],
                'LEGION COMMANDER'  => ['frequency' => 3, 'support' => 60],
                'NECROPHOS'         => ['frequency' => 2, 'support' => 40],
                'PUDGE'             => ['frequency' => 2, 'support' => 40],
                'SHADOW FIEND'      => ['frequency' => 2, 'support' => 40],
                'WRAITH KING'       => ['frequency' => 2, 'support' => 40],
            ],
            [
                'ABADDON+LEGION COMMANDER' => [
                    'pairs' => ['ABADDON'], 'frequency' => 3, 'support' => 60, 'confidence' => 100
                ],
            ]
        ]);
    }
}
