<?php

namespace BlackJack;

require_once(__DIR__ . '/../../lib/blackJack_game/Deck.php');

use PHPUnit\Framework\TestCase;

class DeckTest extends TestCase
{
    public function testDrawCard()
    {
        $deck = new Deck();
        $cards = $deck->drawCard(2);
        $this->assertSame(2, count($cards));
    }

    public function testAddCard()
    {
        $deck = new Deck();
        $card = [];
        $card[] = $deck->addCard(1);
        $this->assertSame(1, count($card));
    }
}
