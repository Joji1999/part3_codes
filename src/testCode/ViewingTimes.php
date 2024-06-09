<?php

/**
 * タスク分解一覧表
 * 1.データ構造を決める
 * [ch => [min, min], ch => [min, min], ...]
 * [1 => [30, 15], 2 => [30], ...]
 * 2.データを処理しやすい形に変換する
 * 3.入力値を取得する
 * 4.合計時間を算出する
 * 5.チャンネルごとの視聴分数と視聴回数を算出する
 * 6.表示する
 */

const SPLIT_LENGTH = 2;

/**
 * @param array<int> $argv
 * @return array<int, array<int, int>>
 */

function getInput(array $argv): array
{
    $argument = array_slice($argv, 1);
    return array_chunk($argument, SPLIT_LENGTH);
}

/**
 * @param array<int, array<int, int>> $inputs
 * @return array<int, array<int, int>> $viewingPeriods
 */

function groupChannelViewingPeriods(array $inputs): array
{
    $viewingPeriods = [];
    foreach ($inputs as $input) {
        $chan = $input[0];
        $min = $input[1];
        $mins = [$min];

        if (array_key_exists($chan, $viewingPeriods)) {
            $mins = array_merge($viewingPeriods[$chan], $mins);
        }

        $viewingPeriods[$chan] = $mins;
    }
    return $viewingPeriods;
}

/**
 * @param array<int, array<int, int>> $viewingPeriods
 * @return float
 */

function calculateTotalHour(array $viewingPeriods): float
{
    $viewingTimes = [];
    foreach ($viewingPeriods as $period) {
        $viewingTimes = array_merge($viewingTimes, $period);
    }
    $totalMin = array_sum($viewingTimes);

    // 上記5行は以下1行でまとめることができる
    // $totalMin = array_sum(array_merge(...$channelViewingPeriods));

    return round($totalMin / 60, 1);
}

/**
 * @param array<int, array<int, int>> $viewingPeriods
 */

function display(array $viewingPeriods): void
{
    $totalHour = calculateTotalHour($viewingPeriods);
    echo $totalHour . PHP_EOL;
    foreach ($viewingPeriods as $chan => $mins) {
        echo $chan . ' ' . array_sum($mins) . ' ' . count($mins) . PHP_EOL;
    }
}

$inputs = getInput($_SERVER['argv']);
$viewingPeriods = groupChannelViewingPeriods($inputs);
display($viewingPeriods);
