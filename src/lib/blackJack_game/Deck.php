<?php

namespace BlackJack;

require_once('Card.php');

class Deck
{
    private const CARD_NUMBER = ['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];

    private mixed $deck = [];

    public function __construct()
    {
        foreach (['H', 'C', 'S', 'D'] as $suit) {
            foreach (self::CARD_NUMBER as $num) {
                $this->deck[] = new Card($suit, $num);
            }
        }
    }

    public function drawCard(int $drawNum): mixed
    {
        $cards = array_rand($this->deck, $drawNum);
        $hands = [];
        foreach ($cards as $cardIndex) {
            $hand = $this->deck[$cardIndex];
            $hands[] = $hand;
        }

        $handIds = array_map(function ($card) {
            return $card->getId();
        }, $hands);

        foreach ($this->deck as $key => $card) {
            if (in_array($card->getId(), $handIds)) {
                unset($this->deck[$key]);
            }
        }

        return $hands;
    }

    public function addCard(int $drawNum): object
    {
        $addCard = array_rand($this->deck, $drawNum);
        $hand = $this->deck[$addCard];

        $handId = [];
        $handId[] = $hand->getId();

        foreach ($this->deck as $key => $card) {
            if (in_array($card->getId(), $handId)) {
                unset($this->deck[$key]);
            }
        }

        return $hand;
    }
}
