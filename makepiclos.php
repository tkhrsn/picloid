<?php

const SIDES_DEFAULT = 5;

$sides = get_sides($argv);
list($field, $field_turned) = make_field($sides);

// フィールドを出力
foreach ($field as $line) {
    foreach ($line as $paint) {
        echo $paint ? '■' : '□';
    }
    echo "\n";
}

// 横の数字を取得
foreach ($field as $line) {
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
foreach ($field_turned as $line) {
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

// methods
// ---------------------------------------------------------------

/**
 * 幅を取得
 * @param type $argv
 * @return type
 */
function get_sides($argv) {
    $arg_sides = $argv[1];
    // 空チェック
    if (empty($arg_sides)) {
        return SIDES_DEFAULT;
    }

    // 数値チェック
    if (!ctype_digit($arg_sides)) {
        return SIDES_DEFAULT;
    }

    // 境界値チェック
    if (100 < $arg_sides) {
        return SIDES_DEFAULT;
    }

    return (int)$arg_sides;
}

/**
 * フィールド作成
 */
function make_field($sides) {
    $field = array();
    $field_turned = array();
    for ($i = 0; $i < $sides; $i++) {
        for ($j = 0; $j < $sides; $j++) {
            $paint = empty(rand(0, 1));
            $field[$i][$j] = $paint;
            $field_turned[$j][$i] = $paint;
        }
    }

    return array($field, $field_turned);
}