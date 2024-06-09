<?php

namespace BlackJack;

require_once(__DIR__ . '/../../lib/blackJack_game/Player3.php');

use PHPUnit\Framework\TestCase;

class Player3Test extends TestCase
{
    public function testDrawCards()
    {
        $deck = new Deck();
        $player = new Player3();
        $cards = $player->drawCard($deck, 2);
        $this->assertSame(2, count($cards));
    }

    public function testAddCard()
    {
        $deck = new Deck();
        $player = new Player3();
        $card = [];
        $card[] = $player->addCard($deck, 1);
        $this->assertSame(1, count($card));
    }

    public function testGetName()
    {
        $player = new player3();
        $this->assertSame('プレイヤー3', $player->getName());
    }

    public function testGetHand()
    {
        $deck = new Deck();
        $player = new Player3();
        $result = $player->drawCard($deck,2);
        $this->assertSame(2, count($result));
    }
}
