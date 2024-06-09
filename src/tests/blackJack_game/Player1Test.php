<?php

namespace BlackJack;

require_once(__DIR__ . '/../../lib/blackJack_game/Player1.php');

use PHPUnit\Framework\TestCase;

class Player1Test extends TestCase
{
    public function testDrawCards()
    {
        $deck = new Deck();
        $player = new Player1();
        $cards = $player->drawCard($deck, 2);
        $this->assertSame(2, count($cards));
    }

    public function testAddCard()
    {
        $deck = new Deck();
        $player = new Player1();
        $card = [];
        $card[] = $player->addCard($deck, 1);
        $this->assertSame(1, count($card));
    }

    public function testGetName()
    {
        $player = new player1();
        $this->assertSame('あなた', $player->getName());
    }

    public function testGetHand()
    {
        $deck = new Deck();
        $player = new Player1();
        $result = $player->drawCard($deck,2);
        $this->assertSame(2, count($result));
    }
}
