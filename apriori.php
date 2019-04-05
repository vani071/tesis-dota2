<?php

function countCombinationInLineups(string $combination, array $lineups) {
    $count = 0;

    foreach ($lineups as $lineup) {
        $heroes = explode('+', $combination);
        $is_found = true;

        foreach ($heroes as $hero) {
            $is_found &= (strpos($lineup, $hero) !== false);
        }

        if ($is_found) {
            $count++;
        }
    }

    return $count;
}

function getFirstFrequentItemSet(array $lineups)
{
    $frequent_itemset = [];

    foreach ($lineups as $lineup) {
        $heroes = array_unique(array_map('trim', explode(',', $lineup)));

        foreach ($heroes as $hero) {
            if (!isset($frequent_itemset[$hero])) {
                $frequent_itemset[$hero] = 0;
            }

            $frequent_itemset[$hero]++;
        }
    }

    ksort($frequent_itemset);

    return $frequent_itemset;
}

function getFrequentItemSet(array $candidate_set, array $lineups)
{
    foreach (array_keys($candidate_set) as $key) {
        $candidate_set[$key] = countCombinationInLineups($key, $lineups);
    }

    return $candidate_set;
}

function getCandidateSet(array $prev_freq_itemset, string $chosen_hero = null)
{
    $total_previous_items = count($prev_freq_itemset);
    $candidate_set = [];

    if ($total_previous_items > 0) {
        $keys = array_keys($prev_freq_itemset);
        $moreThanOneItem = strrpos($keys[0], '+', -1) !== false;

        if (!$moreThanOneItem) {
            for ($i = 0; $i < $total_previous_items; $i++) {
                for ($j = $i + 1; $j < $total_previous_items; $j++) {
                    if (!empty($chosen_hero) && $keys[$i] != $chosen_hero && $keys[$j] != $chosen_hero) {
                        continue;
                    }

                    $candidate_set["{$keys[$i]}+{$keys[$j]}"] = null;
                }
            }
        } else {
            $first_pairs = null;

            for ($i = 0; $i < $total_previous_items; $i++) {
                $first_pairs = substr($keys[$i], 0, strrpos($keys[$i], '+', -1));

                for ($j = $i + 1; $j < $total_previous_items; $j++) {
                    if (substr($keys[$j], 0, strlen($first_pairs)) !== $first_pairs) {
                        break;
                    }

                    $last_item = substr($keys[$j], strlen($first_pairs) + 1);
                    $candidate_set["{$keys[$i]}+{$last_item}"] = null;
                }
            }
        }
    }

    return $candidate_set;
}

function filterFrequentItemSet(array $candidate_set, $min_frequency)
{
    return array_filter($candidate_set, function ($value) use ($min_frequency) {
        return $value >= $min_frequency;
    });
}

function pruneLastCandidateSet(array $candidate_set, array $prev_freq_itemset, $min_frequency)
{
    $unfrequent_itemset = array_filter($prev_freq_itemset, function ($value) use ($min_frequency) {
        return $value < $min_frequency;
    });

    return array_filter($candidate_set, function ($key) use ($unfrequent_itemset) {
        foreach (array_keys($unfrequent_itemset) as $heroes) {
            $heroes = explode('+', $heroes);
            $is_found = true;

            foreach ($heroes as $hero) {
                $is_found &= (strpos($key, $hero) !== false);
            }

            if ($is_found) {
                return false;
            }
        }

        return true;
    }, ARRAY_FILTER_USE_KEY);
}

function calculateDetail($freq_itemsets, $total_lineups, $chosen_hero)
{
    $new_freq_itemsets = $freq_itemsets;

    foreach ($freq_itemsets as $freq_itemset_key => $freq_itemset) {
        foreach ($freq_itemset as $heroes => $value) {
            $new_freq_itemsets[$freq_itemset_key][$heroes] = [
                'frequency' => $value,
                'support' => $value / $total_lineups * 100,
            ];

            if ($freq_itemset_key > 0) {
                if (!empty($chosen_hero)) {
                    $pairs = array_values(array_diff(explode('+', $heroes), [$chosen_hero]));
                    $confidence = $value / $freq_itemsets[0][$chosen_hero] * 100;

                    $new_freq_itemsets[$freq_itemset_key][$heroes]['pairs'] = $pairs;
                    $new_freq_itemsets[$freq_itemset_key][$heroes]['confidence'] = $confidence;
                }
            }
        }
    }

    return $new_freq_itemsets;
}

/**
 * Apriori Algorithm
 * References:
 *      http://nikhilvithlani.blogspot.com/2012/03/apriori-algorithm-for-data-mining-made.html
 *      http://nikhilvithlani.blogspot.com/2013/07/apriori-algorithm-for-data-mining-made.html
 *      http://www2.cs.uregina.ca/~dbd/cs831/notes/itemsets/itemset_apriori.html
 *
 * @param mixed $chosen_hero Optional
 *                           If null, then find most frequent combination.
 *                           If empty string, then use most used hero.
 *
 * @param int   $min_frequency Optional
 *                             Min Frequency ~ Min Support * Total lineups (transactions)
 *
 * @param int   $max_counter Optional. Maximum Iteration of the algorithm
 */
function apriori(array $lineups, $chosen_hero = null, int $min_frequency = 2, $max_counter = INF)
{
    $counter = 0;
    $freq_itemsets = [];
    $freq_itemsets_filt = []; // frequent_item_filtered
    $total_lineups = count($lineups);
    $chosen_hero_param = $chosen_hero;

    if ($total_lineups == 0 || $min_frequency < 2 || $min_frequency > $total_lineups) {
        return false;
    }

    $freq_itemsets[$counter] = getFirstFrequentItemSet($lineups);
    $freq_itemsets_filt[$counter] = filterFrequentItemSet($freq_itemsets[$counter], $min_frequency);

    $is_chosen_hero_not_exist = !empty($chosen_hero) && !isset($freq_itemsets_filt[$counter][$chosen_hero]);
    if (empty($freq_itemsets_filt[$counter]) || $is_chosen_hero_not_exist) {
        return false;
    }

    if ($chosen_hero === '') {
        $chosen_hero = array_search(max($freq_itemsets_filt[$counter]), $freq_itemsets_filt[$counter]);
    }

    while ($counter < $max_counter && !empty($freq_itemsets_filt[$counter])) {
        $counter++;

        $candidate_set = getCandidateSet($freq_itemsets_filt[$counter - 1], $chosen_hero);
        $candidate_set = pruneLastCandidateSet($candidate_set, $freq_itemsets[$counter - 1], $min_frequency);
        $freq_itemsets[$counter] = getFrequentItemSet($candidate_set, $lineups);
        $freq_itemsets_filt[$counter] = filterFrequentItemSet($freq_itemsets[$counter], $min_frequency);
    }

    for ($i = $counter; $i >= 0; $i--) {
        if (empty($freq_itemsets_filt[$i])) {
            unset($freq_itemsets_filt[$i]);
        } else {
            break;
        }
    }

    $freq_itemsets_filt = calculateDetail($freq_itemsets_filt, $total_lineups, $chosen_hero);

    if (is_null($chosen_hero_param) || !empty($chosen_hero_param)) {
        return $freq_itemsets_filt;
    } else {
        return ['chosen_hero' => $chosen_hero, 'frequent_itemsets' => $freq_itemsets_filt];
    }
}
