<?php

const CARDS = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];
define('CARD_RANK', (function () {
    $cardRanks = [];
    foreach (CARDS as $index => $card) {
        $cardRanks[$card] = $index;
    }
    return $cardRanks;
})());

const HIGH_CARD = 'high card';
const PAIR = 'pair';
const STRAIGHT = 'straight';

const HAND_RANK = [
    HIGH_CARD => 0,
    PAIR => 1,
    STRAIGHT => 2,
];

/**
 * @param string$card11
 * @param string$card12
 * @param string$card21
 * @param string$card22
 * @return array<mixed>
 */

function showDown(string $card11, string $card12, string $card21, string $card22): array
{
    $cardRanks = convertToCardRanks([$card11, $card12, $card21, $card22]);
    $playerCardRanks = array_chunk($cardRanks, 2);
    $hands = array_map(fn ($playerCardRank) => checkHand($playerCardRank[0], $playerCardRank[1]), $playerCardRanks);
    $winner = decideWinner($hands[0], $hands[1]);
    return [$hands[0]['name'], $hands[1]['name'], $winner];
}

/**
 * @param array<string>$cards
 * @return array<int>
 */

function convertToCardRanks(array $cards): array
{
    return array_map(fn ($card) => CARD_RANK[substr($card, 1, strlen($card) - 1)], $cards);
}

/**
 * @param int$cardRank1
 * @param int$cardRank2
 * @return array<mixed>
 */

function checkHand(int $cardRank1, int $cardRank2): array
{
    $primary = max($cardRank1, $cardRank2);
    $secondary = min($cardRank1, $cardRank2);
    $name = HIGH_CARD;

    if (isStraight($cardRank1, $cardRank2)) {
        $name = STRAIGHT;
        if (isMinMax($cardRank1, $cardRank2)) {
            $primary = min($cardRank1, $cardRank2);
            $secondary = max($cardRank1, $cardRank2);
        }
    } elseif (isPair($cardRank1, $cardRank2)) {
        $name = PAIR;
    }

    return [
        'name' => $name,
        'rank' => HAND_RANK[$name],
        'primary' => $primary,
        'secondary' => $secondary,
    ];
}

/**
 * @param int$cardRank1
 * @param int$cardRank2
 * @param bool
 */

function isStraight(int $cardRank1, int $cardRank2): bool
{
    return abs($cardRank1 - $cardRank2) === 1 || isMinMax($cardRank1, $cardRank2);
}

/**
 * @param int$cardRank1
 * @param int$cardRank2
 * @param bool
 */

function isMinMax(int $cardRank1, int $cardRank2): bool
{
    return abs($cardRank1 - $cardRank2) === (max(CARD_RANK) - min(CARD_RANK));
}

/**
 * @param int$cardRank1
 * @param int$cardRank2
 * @param bool
 */

function isPair(int $cardRank1, int $cardRank2): bool
{
    return $cardRank1 === $cardRank2;
}

/**
 * @param array$hand1
 * @param array$hand2
 * @return int
 */

function decideWinner(array $hand1, array $hand2): int
{
    foreach (['rank', 'primary', 'secondary'] as $k) {
        if ($hand1[$k] > $hand2[$k]) {
            return 1;
        }
        if ($hand1[$k] < $hand2[$k]) {
            return 2;
        }
    }

    return 0;
}
