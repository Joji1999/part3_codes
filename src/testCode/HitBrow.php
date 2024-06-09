<?php

/**
 * 実行例：
 * judge(5678, 5678) => [4, 0]
 * judge(5678, 7612) => [1, 1]
 * judge(5678, 8756) => [0, 4]
 * judge(5678, 1234) => [0, 0]
 */

const NUMBER_LENGTH = 4;

function judge(int $correctNumber, int $imageNumber): array
{
    $correct = str_split((string)$correctNumber);
    $image = str_split((string)$imageNumber);

    $hit = 0;
    $brow = 0;

    for ($i = 0; $i < NUMBER_LENGTH; $i++) {
        if ($image[$i] === $correct[$i]) {
            $hit++;
        } elseif (in_array($image[$i], $correct, true)) {
            $brow++;
        }
    }

    return [$hit, $brow];
}
