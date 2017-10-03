<?php
$sides = 25;
$fields = array();
$fields_turned = array();

// フィールド作成
for ($i = 0; $i < $sides; $i++) {
    for ($j = 0; $j < $sides; $j++) {
        $paint = empty(rand(0, 1));
        $fields[$i][$j] = $paint;
        $fields_turned[$j][$i] = $paint;
    }
}

// フィールドを出力
foreach ($fields as $line) {
    foreach ($line as $paint) {
        echo $paint ? '■' : '□';
    }
    echo "\n";
}

// 横の数字を取得
foreach ($fields as $line) {
    $line_cnts = array();
    $line_cnts[0] = 0;
    foreach ($line as $i => $paint) {
        if ($paint) {
            $line_cnts[count($line_cnts)-1]++;
        } else {
            if (!empty(end($line_cnts))) {
                $line_cnts[count($line_cnts)] = 0;
            }
        }
    }
    echo implode(' ', array_filter($line_cnts));
    echo "\n";
}

echo "\n";

// 縦の数字を取得
foreach ($fields_turned as $line) {
    $line_cnts = array();
    $line_cnts[0] = 0;
    foreach ($line as $i => $paint) {
        if ($paint) {
            $line_cnts[count($line_cnts)-1]++;
        } else {
            if (!empty(end($line_cnts))) {
                $line_cnts[count($line_cnts)] = 0;
            }
        }
    }
    echo implode(' ', array_filter($line_cnts));
    echo "\n";
}