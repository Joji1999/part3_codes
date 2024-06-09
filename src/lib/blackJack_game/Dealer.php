<?php

namespace BlackJack;

require_once('Player.php');

class Dealer extends Player
{
    public function drawCard(Deck $deck, int $drawNum): mixed
    {
        return $deck->drawCard($drawNum);
    }

    public function addCard(Deck $deck, int $drawNum): object
    {
        return $deck->addCard($drawNum);
    }
}
