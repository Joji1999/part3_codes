<?php

namespace BlackJack;

require_once(__DIR__ . '/../../lib/blackJack_game/Dealer.php');

use PHPUnit\Framework\TestCase;

class DealerTest extends TestCase
{
    public function testDrawCards()
    {
        $deck = new Deck();
        $dealer = new Dealer();
        $cards = $dealer->drawCard($deck, 2);
        $this->assertSame(2, count($cards));
    }

    public function testAddCard()
    {
        $deck = new Deck();
        $dealer = new Dealer();
        $card = [];
        $card[] = $dealer->addCard($deck, 1);
        $this->assertSame(1, count($card));
    }
}
