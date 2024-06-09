<?php

/**
 * 入力：購入時刻 商品番号 商品番号 商品番号・・・
 * CLIコピー用：php lib/SalesAmount.php 21:00 1 1 1 3 5 7 8 9 10
 * 出力：合計金額（税込）
 * 条件：
 * a.玉ねぎ（1）は3つ買うと50円引き
 * b.玉ねぎ（1）は5つ買うと100円引き
 * c.弁当（7,8）と飲み物（9,10）を一緒に買うと20円引き（適用は1組ごと）
 * d.お弁当（7,8）は20〜23時はタイムセールで半額
 */

const ONION_NUMBER = 1;
const FIRST_ONION_NUMBER = 3;
const FIRST_ONION_PRICE = 50;
const SECOND_ONION_NUMBER = 5;
const SECOND_ONION_PRICE = 100;

const SET_DISCOUNT_PRICE = 20;

const TAX = 10;

const SALES_LIST = [
    1 => ['price' => 100, 'type' => ''],
    2 => ['price' => 150, 'type' => ''],
    3 => ['price' => 200, 'type' => ''],
    4 => ['price' => 350, 'type' => ''],
    5 => ['price' => 180, 'type' => 'drink'],
    6 => ['price' => 220, 'type' => ''],
    7 => ['price' => 440, 'type' => 'bento'],
    8 => ['price' => 380, 'type' => 'bento'],
    9 => ['price' => 80, 'type' => 'drink'],
    10 => ['price' => 100, 'type' => 'drink'],
];

function calc(string $time, array $numbers): int
{
    $totalAmount = 0;
    $bento = 0;
    $drink = 0;
    $bentoAmount = 0;

    foreach ($numbers as $number) {
        $totalAmount += SALES_LIST[$number]['price'];

        if (SALES_LIST[$number]['type'] === 'bento') {
            $bento ++;
            $bentoAmount += SALES_LIST[$number]['price'];
        }
        if (SALES_LIST[$number]['type'] === 'drink') {
            $drink++;
        }
    }

    $totalAmount -= discountOnionPrice($numbers);
    $totalAmount -= min([$bento, $drink]) * SET_DISCOUNT_PRICE;
    $totalAmount -= bentoTimeSaleAmount($bentoAmount, $time);

    return (int) $totalAmount * (100 + TAX) / 100;
}

function discountOnionPrice(array $numbers): int
{
    $discountOnionPrice = 0;
    $salesOnion = array_count_values($numbers);

    if (SECOND_ONION_NUMBER <= $salesOnion[ONION_NUMBER]) {
        $discountOnionPrice = SECOND_ONION_PRICE;
    } elseif (FIRST_ONION_NUMBER <= $salesOnion['1']) {
        $discountOnionPrice = FIRST_ONION_PRICE;
    }

    return $discountOnionPrice;
}

function bentoTimeSaleAmount(int $bentoAmount, string $time): int
{
    if (strtotime('21:00') <= strtotime($time)) {
        return $bentoAmount / 2;
    }
}
