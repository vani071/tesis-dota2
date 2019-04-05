<?php
ini_set('max_execution_time', 0);
ini_set('memory_limit', -1);

include_once __DIR__ . '/apriori.php';

$lineups = file('data.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$lineups = array_slice($lineups, 0, 100);
echo 'The script is now using: ' . round(memory_get_usage() / 1024) . "KB of memory.\n";

$start_time = microtime(true);
$result = apriori($lineups, null, 5);
$end_time = microtime(true);

echo 'The script is now using: ' . round(memory_get_usage() / 1024) . "KB of memory.\n";
echo 'Peak usage: ' . round(memory_get_peak_usage() / 1024) . "KB of memory.\n";
echo 'Total time: ' . ($end_time - $start_time) . " seconds\n";

var_dump($result);
// foreach ($result[0] as $hero => $freq) {
//     echo "{$hero}\n";
// }
