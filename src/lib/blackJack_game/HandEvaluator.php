<?php

namespace BlackJack;

require_once('Card.php');
require_once('Game.php');

class HandEvaluator
{
    private const CARD_A_MAX = 11;
    private const CARD_A_MIN = 1;

    public function __construct(private mixed $hands)
    {
    }

    public function getScore(): int
    {
        $score = 0;

        foreach ($this->hands as $hand) {
            $number = $hand->getNumber();

            if ($number === 'A') {
                $score += $this->scoreOfCardA($score);
            } else {
                $score += Card::CARD_RANKS[$number];
            }
        }

        return $score;
    }

    public function scoreOfCardA(int $amountScore): int
    {
        if (($amountScore + self::CARD_A_MAX) > Game::MAX_SCORE) {
            return self::CARD_A_MIN;
        } else {
            return self::CARD_A_MAX;
        }
    }

    public function getWinner(): string
    {
        if ($this->hands[0] > $this->hands[1] || $this->hands[1] > Game::MAX_SCORE) {
            return 'あなたの勝ちです！';
        } elseif ($this->hands[0] < $this->hands[1]) {
            return 'あなたの負けです。';
        } elseif ($this->hands[0] === $this->hands[1]) {
            return '引き分けです。';
        }
        return '勝者の判定エラーです。';
    }
}
