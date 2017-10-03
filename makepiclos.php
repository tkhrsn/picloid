<?php
$sides = 25;
$fields = array();

for ($i = 0; $i < $sides; $i++) {
    for ($j = 0; $j < $sides; $j++) {
        $fields[$i][$j] = empty(rand(0, 1));
    }
}

// フィールドを出力
foreach ($fields as $line) {
    foreach ($line as $paint) {
        echo $paint ? '■' : '□';
    }
    echo "\n";
}