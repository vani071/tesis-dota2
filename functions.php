<?php

function calculateHeroFrequency($heroes, $lineups)
{
    $total_per_hero = [];

    foreach ($heroes as $hero) {
        $total_per_hero[$hero] = 0;
        foreach ($lineups as $lineup) {
            if (strpos($lineup, $hero) !== false){
                $total_per_hero[$hero]++;
            }
        }
    }

    return $total_per_hero;
}

function countHeroCombination($hero, $lineups)
{
    $total_hero = count($hero);
    $hero_combinations = [];

    if ($total_hero == 0 || count($lineups) == 0 ) {
        return [];
    }

    for($i = 0; $i < $total_hero; $i++) {
        for($j = $i + 1; $j < $total_hero; $j++) {
            $hero_combinations["{$hero[$i]}+{$hero[$j]}"] = 0;

            foreach ($lineups as $lineup) {
                if ((strpos($lineup, $hero[$i]) !== false) && (strpos($lineup, $hero[$j])) !== false) {
                    $hero_combinations["{$hero[$i]}+{$hero[$j]}"]++;
                }
            }
        }
    }

    return $hero_combinations;
}

///// Association
function apriori($chosen_hero, $heroes, $lineups, $matchup_heroes) {
    if (count($heroes) == 0 || count($lineups) == 0 || count($matchup_heroes) == 0) {
        return false;
    }


    $linecount = count($lineups);

    $total_per_hero = calculateHeroFrequency($heroes, $lineups);
    $most_used_hero = array_search(max($total_per_hero), $total_per_hero);
    $chosen_hero = empty($chosen_hero) ? $most_used_hero : $chosen_hero;

    //hilangin keempat baris tanda garis miring dibawah ini untuk menampilkan Jumlah hero

    // echo "<pre>";
    // echo "\r\nStep 1: Jumlah hero\r\n";
    // print_r($total_per_hero);
    // echo '<br>';
    // echo $most_used_used;
    // echo '<br>';
    // echo max($total_per_hero);
    // echo "</pre>";
    // die();

    $hero_array = countHeroCombination($heroes, $lineups);


    // echo "<pre>";
    // echo "\r\nStep 2: Jumlah Gabungan hero\r\n";
    // print_r($hero_array);
    // echo "</pre>";

    $check_gabunganhero_terbesar = 0;
    $check_gabunganhero_terbesar_a = 0;
    $check_gabunganhero_terbesar_b = 0;
    $nama_final = "";
    $nama_hero_b = "";
    $check_value_a = 0;
    $check_value_b = 0;

    foreach ($hero_array as $ia_key => $ia_value) {
        foreach ($total_per_hero as $tpi_key => $tpi_value) {

            if (strpos($ia_key, $tpi_key) !== false) {
                // echo "<pre>";
                // echo "[+] $ia_key($ia_value) --> $tpi_key($tpi_value) =>". $ia_value / $tpi_value."\r\n";

                // echo "</pre>";

                //mencari gabungan terbesar hero
                list($a,$b) = explode('+', $ia_key);

                foreach ($matchup_heroes as $name) {
                    //mengecek gabungan terbesar
                    if ($b == $chosen_hero && $a == $name) {
                        // echo "nama b : ".$b." = ".$ia_value."<br>";
                        // echo "nama a : ".$a." = ".$ia_value."<br>\n";

                        $check_value_a = $ia_value;
                        if ($check_gabunganhero_terbesar_a < $check_value_a ) {
                            $check_gabunganhero_terbesar_a = $check_value_a;
                            // echo $check_gabunganhero_terbesar."<br>";
                            $nama_hero_a = $a;
                        }
                    }

                    if ($a == $chosen_hero && $b == $name) {
                        // echo "nama b : ".$b." = ".$ia_value."<br>\n";
                        // echo "nama a : ".$a." = ".$ia_value."<br>";

                        $check_value_b = $ia_value;
                        if ($check_gabunganhero_terbesar_b < $check_value_b ) {
                            $check_gabunganhero_terbesar_b = $check_value_b;
                            // echo $check_gabunganhero_terbesar."<br>";
                            $nama_hero_b = $b;
                        }

                    }

                    if ($check_gabunganhero_terbesar_a > $check_gabunganhero_terbesar_b) {
                        $check_gabunganhero_terbesar = $check_gabunganhero_terbesar_a;
                        $nama_final = $nama_hero_a;
                    } else {
                        $check_gabunganhero_terbesar = $check_gabunganhero_terbesar_b;
                        $nama_final = $nama_hero_b;
                    }
                }
            }
        }
    }

    // echo "Jumlah gabungan terbanyak hero $chosen_hero :  ".$check_gabunganhero_terbesar." dengan $nama_final";
    // echo "<br>";
    // echo "jumlah data = ".$linecount;
    // echo "<br>";

    //menghitung support
    $confidence = round((($check_gabunganhero_terbesar/$total_per_hero[$chosen_hero])*100),2);
    $support = round((($check_gabunganhero_terbesar/$linecount)*100),2);

    return [
        'name' => $nama_final,
        'confidence' => $confidence,
        'support' => $support,
        'match_count' => $check_gabunganhero_terbesar
    ];
};
