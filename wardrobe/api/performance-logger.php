<?php
function memory_usage($var) {
    $start_memory = memory_get_usage();
    $tmp = unserialize(serialize($var));
    return memory_get_usage() - $start_memory;
}
$file = fopen("performance.txt","a+") or exit("Unable to open file time.txt"); // Open
?>