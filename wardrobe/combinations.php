<?php
$other_clothes = array('hats', 'bags', 'scarfs');
$possible_combinations = pow(2, count($other_clothes));
for ($i = 0; $i < $possible_combinations; $i++) {
    $main_clothes = array('tops');
    foreach ($other_clothes as $j => $item) {
        if ($i & pow(2, $j)) {
            $main_clothes[] = $item;
        }
    }
    echo implode(' + ', $main_clothes) . "\n";
}