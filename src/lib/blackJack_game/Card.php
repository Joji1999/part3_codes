<?php

namespace BlackJack;

class Card
{
    private string $cardId;

    public const CARD_RANKS = [
        'A' => 1,
        '2' => 2,
        '3' => 3,
        '4' => 4,
        '5' => 5,
        '6' => 6,
        '7' => 7,
        '8' => 8,
        '9' => 9,
        '10' => 10,
        'J' => 10,
        'Q' => 10,
        'K' => 10,
    ];

    private const SUIT = [
        'H' => 'ハート',
        'C' => 'クラブ',
        'S' => 'スペード',
        'D' => 'ダイヤ',
    ];

    public function __construct(private string $suit, private string $num)
    {
        $this->cardId = $this->createId();
    }

    public function getSuit(): string
    {
        return self::SUIT[$this->suit];
    }

    public function getNumber(): string
    {
        return $this->num;
    }

    public function createId(): string
    {
        return $this->suit . '-' . $this->num;
    }

    public function getId(): string
    {
        return $this->cardId;
    }
}
