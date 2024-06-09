<?php

namespace BlackJack;

abstract class Player
{
    public function __construct()
    {
    }
    public function drawCard(Deck $deck, int $drawNum): mixed
    {
        return $deck->drawCard($drawNum);
    }

    public function addCard(Deck $deck, int $drawNum): object
    {
        return $deck->addCard($drawNum);
    }

    public function getName()
    {
    }

    //public function getHand()
    //{
    //    return $this->drawCard();
    //}
}
