<?php

const SIDES_DEFAULT = 5;

$sides = get_sides($argv);
list($field, $field_turned) = make_field($sides);

// 横の数列を取得
$line_cnts = get_line_cnts($field);

// 縦の数列を取得
$col_cnts = get_line_cnts($field_turned);

// 問題CSVを出力
put_question_csv($line_cnts, $col_cnts);

// 答えCSVを出力
put_answer_csv($field);


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
    if (empty($arg_sides)) return SIDES_DEFAULT;

    // 数値チェック
    if (!ctype_digit($arg_sides)) return SIDES_DEFAULT;

    // 境界値チェック
    if (100 < $arg_sides) return SIDES_DEFAULT;

    return (int)$arg_sides;
}

/**
 * フィールド要素作成
 * @param type $sides
 * @return type
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

/**
 * 答えフィールドを作成
 * @param type $field
 * @return type
 */
function put_answer_csv($field) {
    $txt = '';
    foreach ($field as $line) {
        $answer_line = array();
        foreach ($line as $paint) {
            $answer_line[] = $paint ? '■' : '□';
        }
        $txt .= implode(',', $answer_line)."\n";
    }

    // TODO answer.csvに出力する
    echo $txt;
}


/**
 * 縦横の数字カウントを取得
 * @param type $field
 * @return type
 */
function get_line_cnts($field) {
    $lines = array();
    foreach ($field as $line) {
        $line_cnts = array();
        $line_cnts[0] = 0;
        foreach ($line as $paint) {
            if ($paint) {
                $line_cnts[count($line_cnts)-1]++;
            } else {
                if (!empty(end($line_cnts))) {
                    $line_cnts[count($line_cnts)] = 0;
                }
            }
        }
        $lines[] = array_filter($line_cnts);
    }

    return $lines;
}

/**
 * 問題CSV出力
 * @param type $line_cnts
 * @param type $col_cnts
 */
function put_question_csv($line_cnts, $col_cnts) {
    // 縦横数列の最大値をそれぞれ取得し、最大値まで配列の空白を埋める
    $line_max = get_max_array_num($line_cnts);
    $col_max  = get_max_array_num($col_cnts);

    $line_padded = pad($line_cnts, $line_max);
    $col_padded  = pad($col_cnts,  $col_max);
    var_dump($line_padded);
    var_dump($col_padded);die;

    // TODO 縦数列を縦表示にするため反転させる

    // TODO CSV用配列作成

    // TODO 出力
}

/**
 * 二次元配列の最大要素数を取得
 * @param type $cnts
 * @return type
 */
function get_max_array_num($cnts) {
    $max = 0;
    foreach ($cnts as $cnt) {
        $max = max($max, count($cnt));
    }

    return $max;
}

/**
 * 二次元配列の全ての行に空白文字列を埋めて同じ要素数にする
 * @param type $cnts
 * @param type $max
 * @return type
 */
function pad($cnts, $max) {
    $pads = array();
    foreach ($cnts as $cnt) {
        $pad_num = $max - count($cnt);
        $pads[]  = array_merge(array_fill(0, $pad_num, ''), $cnt);
    }

    return $pads;
}