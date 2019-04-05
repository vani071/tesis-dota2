<?php

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
    foreach ($lineups as $lineup) {
        foreach (array_keys($candidate_set) as $key) {
            $heroes = explode('+', $key);
            $is_found = true;

            foreach ($heroes as $hero) {
                $is_found &= (strpos($lineup, $hero) !== false);
            }

            if ($is_found) {
                $candidate_set[$key]++;
            }
        }
    }

    return $candidate_set;
}

function getCandidateSet(array $prev_freq_itemset)
{
    $total_previous_items = count($prev_freq_itemset);
    $candidate_set = [];

    if ($total_previous_items > 0) {
        $keys = array_keys($prev_freq_itemset);
        $moreThanOneItem = strrpos($keys[0], '+', -1) !== false;

        if (!$moreThanOneItem) {
            for ($i = 0; $i < $total_previous_items; $i++) {
                for ($j = $i + 1; $j < $total_previous_items; $j++) {
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

function apriori(array $lineups, string $chosen_hero = null, $min_frequency = 1, int $max_counter = 5)
{
    $counter = 0;
    $freq_itemsets = [];
    $freq_itemsets_filt = []; // frequent_item_filtered
    $total_lineups = count($lineups);

    if ($total_lineups == 0 || $min_frequency > $total_lineups) {
        return false;
    }

    $freq_itemsets[$counter] = getFirstFrequentItemSet($lineups);
    $freq_itemsets_filt[$counter] = filterFrequentItemSet($freq_itemsets[$counter], $min_frequency);

    if (!is_null($chosen_hero) && !isset($freq_itemsets[$chosen_hero])) {
        return false;
    }

    while ($counter < $max_counter) {
        if (empty($freq_itemsets_filt[$counter])) {
            unset($freq_itemsets_filt[$counter]);
            $counter--;
            break;
        }

        echo "Counter: {$counter}\n";
        $counter++;

        $candidate_set = getCandidateSet($freq_itemsets_filt[$counter - 1]);
        $candidate_set = pruneLastCandidateSet($candidate_set, $freq_itemsets[$counter - 1], $min_frequency);
        $freq_itemsets[$counter] = getFrequentItemSet($candidate_set, $lineups);
        $freq_itemsets_filt[$counter] = filterFrequentItemSet($freq_itemsets[$counter], $min_frequency);
    }

    return $freq_itemsets_filt;
    // return array_map(function ($freq_itemset) use ($total_lineups) {
    //     return array_map(function ($value) use ($total_lineups) {
    //         return $value / $total_lineups * 100;
    //     }, $freq_itemset);
    // }, $freq_itemsets_filt);
}
