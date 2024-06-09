<?php

namespace BlackJack;

require_once(__DIR__ . '/../../lib/blackJack_game/Player2.php');

use PHPUnit\Framework\TestCase;

class Player2Test extends TestCase
{
    public function testDrawCards()
    {
        $deck = new Deck();
        $player = new Player2();
        $cards = $player->drawCard($deck, 2);
        $this->assertSame(2, count($cards));
    }

    public function testAddCard()
    {
        $deck = new Deck();
        $player = new Player2();
        $card = [];
        $card[] = $player->addCard($deck, 1);
        $this->assertSame(1, count($card));
    }

    public function testGetName()
    {
        $player = new player2();
        $this->assertSame('プレイヤー2', $player->getName());
    }

    public function testGetHand()
    {
        $deck = new Deck();
        $player = new Player2();
        $result = $player->drawCard($deck,2);
        $this->assertSame(2, count($result));
    }
}
