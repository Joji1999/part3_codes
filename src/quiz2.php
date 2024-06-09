<?php

/**
 * パンの金額(税抜) ①100 ②120 ③150 ④250 ⑤80 ⑥120 ⑦100 ⑧180 ⑨50 ⑩300
 * 求めること： 1日の売上合計金額(税込) 販売個数の多い商品番号 販売個数の少ない商品番号
 * インプット： 「販売した商品番号 販売個数 販売した商品番号 販売個数 ...」
 * アウトプット：
 * 売上の合計(税率は10％)
 * 販売個数の最も多い商品番号
 * 販売個数の最も少ない商品番号
 * ※販売個数が同数の場合は該当するすべての商品番号を記載する
 * 実行コマンド例
 * docker-compose exec app php quiz2.php 1 10 2 3 5 1 7 5 10 1
 * 出力例
 * 2464
 * 1
 * 5 10
 */

const SPLIT_LENGTH = 2;
const BREADS = [
    1 => 100,
    2 => 120,
    3 => 150,
    4 => 250,
    5 => 80,
    6 => 120,
    7 => 100,
    8 => 180,
    9 => 50,
    10 => 300,
];
const TAX = 10;

/**
 * @param array<int> $argv
 * @return array<int,int>
 */

function getInput(array $argv): array
{
    $inputs = array_slice($argv, 1);
    $getInputs = array_chunk($inputs, SPLIT_LENGTH);
    $breadData = [];
    foreach ($getInputs as $input) {
        $breadData[$input[0]] = (int) $input[1];
    }
    return $breadData;
}

// 売上個数から一日の売上額を求める関数

/**
 * @param array<int,int> $getInput
 * @return int
 */

function calculateSalesAmount(array $getInput): int
{
    $sum = 0;
    foreach ($getInput as $breadNumber => $salesNumber) {
        $sum += BREADS[$breadNumber] * $salesNumber;
    }
    return $sum * (100 + TAX) / 100;
}

// 一日で一番売れているパンの商品番号を求める関数

/**
 * @param array<int,int> $getInput
 * @return array<int,int>
 */

function maxSalesBread(array $getInput): array
{
    $max = max(array_values($getInput));
    return array_keys($getInput, $max);
}

// 一日で一番売れていないパンの商品番号を求める関数

/**
 * @param array<int,int> $getInput
 * @return array<int,int>
 */

function minSalesBread(array $getInput): array
{
    $min = min(array_values($getInput));
    return array_keys($getInput, $min);
}
// データを表示させる関数

/**
 * @param int|array<int,int>...$results
 */

function display(...$results): void
{
    foreach ($results as $result) {
        echo implode(' ', $result) . PHP_EOL;
    }
}

// 関数の呼び起こし一覧
$getInput = getInput($_SERVER['argv']);
$breadAmount = calculateSalesAmount($getInput);
$breadMaxSales = maxSalesBread($getInput);
$breadMinSales = minSalesBread($getInput);
display([$breadAmount], $breadMaxSales, $breadMinSales);
